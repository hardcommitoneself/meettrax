<?php

namespace App\Http\Livewire;

use App\Models\Meet;
use Livewire\Component;

class SearchMeets extends Component
{

    public $search;
    protected $meets;

    public function fetchMeets()
    {
        $meets_query = Meet::query();

        if ($this->search) {
            $search_string = preg_replace('/[^A-Za-z0-9 ]/', '', $this->search);
            if ($search_string) {
                $q = '%' . $search_string . '%';
                $meets_query->where('meets.name', 'like', $q);
            }
        }

        return $meets_query->orderByDesc('id')->get();
    }

    public function render()
    {
        return view('livewire.search-meets', ['meets' => $this->fetchMeets()]);
    }
}
