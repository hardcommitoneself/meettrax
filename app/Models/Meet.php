<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Smalot\PdfParser\Config;
use Smalot\PdfParser\Parser;
use Str;

class Meet extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $guarded = [];

    public function events()
    {
        return $this->hasMany(MeetEvent::class);
    }

    public function sections()
    {
        return $this->hasManyThrough(MeetSection::class, MeetEvent::class);
    }

    public function updates()
    {
        return $this->hasManyThrough(MeetEventUpdate::class, MeetEvent::class);
    }

    public function entries()
    {
        return $this->hasManyDeep(MeetEntry::class, [MeetEvent::class, MeetSection::class]);
    }

    public function schools()
    {
        //return $this->entries->whereNotNull('school')->sortBy('school')->unique('school')->pluck('school');
        return $this->builderEntries()
            ->groupBy('meet_entries.school')
            ->whereNotNull('meet_entries.school')
            ->orderBy('meet_entries.school')
            ->select('meet_entries.school')
            ->pluck('meet_entries.school');
    }

    public function cacheStats()
    {
        Cache::forever('meets.' . $this->id . '.schools', $this->schools()->count());
        Cache::forever('meets.' . $this->id . '.athletes',
            $this->entries->whereNotNull('name')->unique('name')->count());
        Cache::forever('meets.' . $this->id . '.entries',
            $this->entries->count());
    }

    public function builderEntries()
    {
        return MeetEntry::query()
            ->join('meet_sections', 'meet_sections.id', '=',
                'meet_entries.meet_section_id')
            ->join('meet_events', 'meet_events.id', '=', 'meet_sections.meet_event_id')
            ->where([
                ['meet_events.meet_id', $this->id],
            ]);
    }

    public function builderSections()
    {
        return MeetSection::query()
            ->join('meet_events', 'meet_events.id', '=', 'meet_sections.meet_event_id')
            ->where([
                ['meet_events.meet_id', $this->id],
            ]);
    }

    public static function createFromPdf($pdf)
    {
        // create config
        $config = new Config();
        //$config->setDataTmFontInfoHasToBeIncluded(true);

        // use config and parse file
        $parser = new Parser([], $config);
        $pdf = $parser->parseFile(storage_path('app/' . $pdf));

        $data = collect([]);

        foreach ($pdf->getPages() as $page) {
            $data = $data->concat($page->getTextArray());
        }

        // trim all values
        $data = $data->map(function ($item) {
            return trim($item);
        });

        //dd($data);

        $meet_data = $data->shift(5);
        if ($meet_data[0] !== 'www.RunnerCard.com') {
            throw new \Exception('Not a valid RunnerCard PDF');
        }

        $exists = self::where([
            ['name', $meet_data[1]],
            ['location', $meet_data[2]],
            ['when', $meet_data[3]],
        ])->first();

        if ($exists) {
            if ($exists->prevent_updates) {
                throw new \Exception('Updates are not allowed for this meet');
            }
            $meet = $exists;
            $meet->events()->delete();
            $meet->update(['updated_at' => now()]);
        } else {
            $meet = self::create([
                'name'     => $meet_data[1],
                'location' => $meet_data[2],
                'when'     => $meet_data[3],
            ]);
        }

        $skips = 0;
        foreach ($data as $str) {
            if ($skips > 0) {
                $skips--;
                continue;
            }

            if (Str::is($str, 'www.RunnerCard.com')) {
                continue;
            }

            if (Str::startsWith($str, ["Boy's", "Girl's", "Men's", "Women's", "Coed"])) {
                $data->shift();
                $description = $data->shift();

                $event = MeetEvent::create([
                    'name'        => $str,
                    'meet_id'     => $meet->id,
                    'description' => $description,
                ]);
                $is_relay = Str::contains($str, ["4x", "Relay", "Medley"]);
                $skips = 1;
                $expect_section = true;
                continue;
            }

            if (Str::startsWith($str, ["Heat ", "Section ", "Flight "]) || $expect_section) {
                $expect_section = false;
                if (Str::startsWith($str, ["Heat ", "Section ", "Flight "])) {
                    $section_data = $data->shift();
                    $section_array = explode(' ', $section_data);
                    $section = MeetSection::create([
                        'name'          => $section_array[0],
                        'num'           => $section_array[1],
                        'of'            => $section_array[3],
                        'meet_event_id' => $event->id,
                    ]);
                    continue;
                } else {
                    $section = MeetSection::create([
                        'name'          => 'Unseeded Group',
                        'num'           => 1,
                        'of'            => 1,
                        'meet_event_id' => $event->id,
                    ]);
                }
            }

            $is_entry_number = preg_match('/^\d*[\),\.]$/', $str) === 1;
            if ($is_entry_number) {
                $entry_data = [];
                $skips = 0;
                $data->shift();
                $entry_data[] = preg_replace('/[^0-9]/', '', $str);
                $data_tmp = $data;
                foreach ($data_tmp as $next_data) {
                    $should_stop = (preg_match('/^\d*[\),\.]$/', $next_data) === 1 || Str::startsWith($next_data,
                            ["Heat ", "Section ", "Flight "]) || Str::startsWith($next_data,
                            ["Boy's", "Girl's", "Men's", "Women's", "Coed"]));
                    if (!$should_stop) {
                        $entry_data[] = $next_data;
                        $data->shift();
                        $skips++;
                    } else {
                        if (count($entry_data) >= 5 && !$is_relay) {
                            $entry = MeetEntry::create([
                                'meet_section_id' => $section->id,
                                'num'             => $entry_data[0],
                                'name'            => $entry_data[1],
                                'grade'           => $entry_data[2],
                                'school'          => $entry_data[3],
                                'seed'            => $entry_data[4],
                            ]);
                        } elseif ($is_relay) {
                            $entry = MeetEntry::create([
                                'meet_section_id' => $section->id,
                                'num'             => $entry_data[0],
                                'name'            => $entry_data[1],
                                'grade'           => null,
                                'school'          => null,
                                'seed'            => null,
                            ]);
                        } elseif (count($entry_data) === 4) {
                            $entry = MeetEntry::create([
                                'meet_section_id' => $section->id,
                                'num'             => $entry_data[0],
                                'name'            => $entry_data[1],
                                'grade'           => $entry_data[2],
                                'school'          => $entry_data[3],
                            ]);
                        }
                        continue(2);
                    }
                }
            }
            $data->shift();
        } // end foreach
        $meet->cacheStats();
        return $meet;
    }

}
