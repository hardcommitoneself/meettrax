<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nnjeim\World\Models\City;
use Str;

class MeetEntry extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $toClean = ['seed', 'school', 'grade', 'name'];
            foreach ($toClean as $clean) {
                if (Str::is($model->$clean, 'www.RunnerCard.com')) {
                    $model->$clean = null;
                }
            }
        });
    }

    public function section()
    {
        return $this->belongsTo(MeetSection::class, 'meet_section_id');
    }

    public function event()
    {
        return $this->belongsToThrough(MeetEvent::class, MeetSection::class);
    }
}
