<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class UserFollowController extends Controller
{
    /**
     * Show a user's followers.
     */
    public function showFollowers(User $user)
    {
        return view('profile.followers', ['user' => $user]);
    }

    /**
     * Show who user follows.
     */
    public function showFollowing(User $user)
    {
        return view('profile.following', ['user' => $user]);
    }
}
