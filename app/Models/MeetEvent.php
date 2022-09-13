<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class MeetEvent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }

    public function sections()
    {
        return $this->hasMany(MeetSection::class);
    }

    public function updates()
    {
        return $this->hasMany(MeetEventUpdate::class);
    }

    public function latestUpdate()
    {
        return $this->hasOne(MeetEventUpdate::class)->latest();
    }

    public function countOfSections()
    {
        return MeetSection::where('meet_event_id', $this->id)->count();
    }

    public function getGenderAttribute()
    {
        if (Str::startsWith($this->name, ["Boy's", "Men's"])) {
            return 'male';
        }
        if (Str::startsWith($this->name, ["Girl's", "Women's"])) {
            return 'female';
        }
        if (Str::startsWith($this->name, ["Coed"])) {
            return 'coed';
        }

        return null;
    }

    public function getTextColorAttribute()
    {
        if ($this->gender === 'male') {
            return 'blue-500';
        }

        if ($this->gender === 'female') {
            return 'pink-500';
        }

        if ($this->gender === 'coed') {
            return 'green-500';
        }

        return 'gray-700';
    }

    public function getIsFieldAttribute()
    {
        if (Str::contains(Str::lower($this->name), ["vault", "jump", "javelin", "discus", "shot"])) {
            return true;
        }
        return false;
    }

    public function getIsThrowAttribute()
    {
        if (Str::contains(Str::lower($this->name), ["javelin", "discus", "shot"])) {
            return true;
        }
        return false;
    }

    public function getIsJumpAttribute()
    {
        if (Str::contains(Str::lower($this->name), ["vault", "jump"])) {
            return true;
        }
        return false;
    }

    public function getHasMakesAndMissesAttribute()
    {
        if (Str::contains(Str::lower($this->name), ["vault", "high jump"])) {
            return true;
        }
        return false;
    }

    public function getIsVaultAttribute()
    {
        if (Str::contains(Str::lower($this->name), ["vault"])) {
            return true;
        }
        return false;
    }

    public function getIsHighJumpAttribute()
    {
        if (Str::contains(Str::lower($this->name), ["high jump"])) {
            return true;
        }
        return false;
    }

    public function getIsJavelinAttribute()
    {
        if (Str::contains(Str::lower($this->name), ["javelin"])) {
            return true;
        }
        return false;
    }

    public function getIsDiscusAttribute()
    {
        if (Str::contains(Str::lower($this->name), ["discus"])) {
            return true;
        }
        return false;
    }

    public function getIsShotPutAttribute()
    {
        if (Str::contains(Str::lower($this->name), ["shot"])) {
            return true;
        }
        return false;
    }

    public function getIsLongJumpAttribute()
    {
        if (Str::contains(Str::lower($this->name), ["long jump"])) {
            return true;
        }
        return false;
    }
}
