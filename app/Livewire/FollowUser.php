<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class FollowUser extends Component
{
    public $user;
    public $target;

    public function follow() {
        $this->authorize('follow', $this->target);

        $this->user->follow($this->target);
        session()->flash('message', 'You are now following ' . $this->target->name);
    }

    public function unfollow() {
        $this->authorize('unfollow', $this->target);

        $this->user->following()->detach($this->target->id);
        session()->flash('message', 'You have unfollowed ' . $this->target->name);
    }

    public function render()
    {
        return view('livewire.follow-user');
    }

    public function mount($target) {
        $this->user = Auth::user();
        $this->target = $target;
    }
}
