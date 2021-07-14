<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
    public $profileId;
    public $followText;

    public function mount($profileId)
    {
        $user = User::find(auth()->id());
        $profile = User::find($profileId);

        if ($user == null) {
            return redirect(route('login'));
        }

        if ($profile == null) {
            return redirect(route('home'));
        }

        $this->followText = $user->following($profile) ? "unfollow" : "follow";
    }

    public function toggleFollowing($profileId)
    {
        $user = User::find(auth()->id());
        $profile = User::find($profileId);

        if ($user == null) {
            return redirect(route('login'));
        }

        if ($profile == null) {
            return redirect(route('home'));
        }

        $user->toggle($profile);

        $this->followText = $user->following($profile) ? "unfollow" : "follow";
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
