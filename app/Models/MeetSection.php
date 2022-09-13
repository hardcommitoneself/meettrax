<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetSection extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function event() {
        return $this->belongsTo(MeetEvent::class);
    }

    public function entries() {
        return $this->hasMany(MeetEntry::class);
    }

    public function entriesFromSearch($search = null, $highlighted = null, $hideOthers = false) {
            $query = preg_replace('/[^A-Za-z0-9 ]/', '', $search);
            $entries = $this->entries();
            if ($query) {
                $q = '%'.$query.'%';
                $entries->where('name', 'like', $q);
            }

            if ($highlighted && $hideOthers) {
                    $entries->where('school', $highlighted);
            }
        return $entries->get();
    }

}
