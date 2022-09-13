<?php

namespace App\Models;

use App\Events\MeetEventUpdateCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class MeetEventUpdate extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'body' => 'json',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            MeetEventUpdateCreatedEvent::dispatch($model);
        });
    }

    public function meetEvent()
    {
        return $this->belongsTo(MeetEvent::class);
    }

//    public function getMarkAttribute()
//    {
//        if ($this->meetEvent->hasMakesAndMisses) {
//            $status = explode(' ', $this->body['results'][0]['mark_converted']);
//            $status = $status[1] ?? '';
//            return str_replace(' ', '', $this->body['results'][0]['mark']) . ' ' . $status;
//        } else {
//            return str_replace(' ',
//                '', $this->body['results'][0]['mark']);
//        }
//    }

    public function getMarkSuffixHtmlAttribute()
    {
        $suffix = $this->markSuffix;
        $letters = str_split($suffix);
        $str = '';
        foreach ($letters as $letter) {
            $str .= "<span class='text-" . self::getColor($letter) . "-500'>" . $letter . "</span>";
        }
        return $str;
    }

    public static function getColor($letter)
    {
        if (in_array($letter, ['X', 'F'])) {
            return 'red';
        }

        if (in_array($letter, ['O'])) {
            return 'green';
        }

        return 'gray';
    }

    public function getImpericalMarkAttribute()
    {
        $mark = $this->body['results'][0]['mark'];
        $mark_converted = $this->body['results'][0]['mark_converted'];

        if (ctype_alnum($mark)) {
            return;
        }

        if (Str::contains($mark, ["'", '"'])) {
            return str_replace(' ', '', $mark);
        } else {
            $status = explode(' ', $mark_converted);
            return $status[0] ?? '';
        }
    }

    public function getMetricMarkAttribute()
    {
        $mark = $this->body['results'][0]['mark'];
        $mark_converted = $this->body['results'][0]['mark_converted'];

        if (ctype_alnum($mark)) {
            return;
        }

        if (Str::contains($mark, ["'", '"'])) {
            return str_replace(' ', '', $mark_converted);
        } else {
            $status = explode(' ', $mark);
            return $status[0] ?? '';
        }
    }

    public function getMarkSuffixAttribute()
    {
        $mark = $this->body['results'][0]['mark'];
        $mark_converted = $this->body['results'][0]['mark_converted'];

        if (ctype_alnum($mark)) {
            return $mark;
        }

        if (Str::contains($mark, ["'", '"'])) {
            $status = explode(' ', $this->body['results'][0]['mark_converted']);
            return $status[1] ?? '';
        } else {
            $status = explode(' ', $this->body['results'][0]['mark']);
            return $status[1] ?? '';
        }
    }

    public function getFormattedAttribute()
    {
        return $this->body['results'][0]['name'] . ' / ' . $this->body['results'][0]['affiliation'] . ': ' . $this->impericalMark . ($this->impericalMark . $this->markSuffix ? '&nbsp; ' . $this->markSuffixHtml : '');
    }
}
