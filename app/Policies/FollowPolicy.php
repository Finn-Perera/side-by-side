<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;


class FollowPolicy
{
    public function follow(User $user, User $target) {
        if ($user->id === $target->id) {
            return Response::deny('You cannot follow yourself');
        }
        
        if ($user->following()->where('following_id', $target->id)->exists()) {
            return Response::deny('You are already following this user');
        }

        return Response::allow();
    }

    public function unfollow(User $user, User $target) {
        if (!$user->following()->where('following_id', $target->id)->exists()) {
            return Response::deny('You are not following this user');
        }

        return Response::allow();
    }
}
