<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AcceptFollow extends Component
{
    public $profileId;
    public $status;
    private $profile;

    public function mount ($profileId) {
        $this->profile = User::find($profileId);

        if ($this->profile != null && auth()->user() != null) {
            if (auth()->user()->accepted($this->profile)) {
                $this->status = 'Accepted';
            } else {
                $this->status = 'Accept';
            }
        }
    }

    public function toggleAccept (User $profileId) {
        $this->profile = User::find($this->profileId);

        if ($this->profile != null && auth()->user() != null) {
            if (auth()->user()->accepted($this->profile)) {
                auth()->user()->toggleAccepted($this->profile, false);
                $this->status = 'Accept';

            } else {
                auth()->user()->toggleAccepted($this->profile, true);
                $this->status = 'Accepted';
            }
        }
    }

    public function render()
    {
        return view('livewire.accept-follow');
    }
}
