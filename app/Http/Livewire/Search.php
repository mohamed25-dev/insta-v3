<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Arr;
use Livewire\Component;

class Search extends Component
{
    public $profiles = null;
    public $results = null;
    public $search;

    public function findProfile ($search) {
        if ($search != null) {
            $this->profiles =
                User::where('username', 'LIKE', '%' . $search . '%')
                    ->where('id', '<>', auth()->id())
                    ->take(5)
                    ->get();
        } else {
            $this->results = null;
            $this->profiles = null;
        }

        if ($this->profiles != null) {
            $fields = array();
            $filtered = array();

            foreach ($this->profiles as $profile) {
                $fields['username'] = $profile->username;
                $fields['profile_photo_url'] = $profile->profile_photo_url;
                
                $filtered[] = $fields;
            }

            $this->results = $filtered;
        }
    }

    public function render()
    {
        return view('livewire.search');
    }
}
