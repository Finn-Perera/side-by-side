@extends('layouts.default')

@section('title', 'User Profile')

@section('content')
    

    @can('update', $user->profile)
        @livewire('profile-editor', ['profile' => $user->profile, 'user' => $user])
    @endcan

    <div>
        <a href="{{ route('profiles.followers', ['user' => $user]) }}" wire:navigate>Followers</a>
        <a href="{{ route('profiles.following', ['user' => $user]) }}" wire:navigate>Following</a>
    </div>
    @livewire('follow-user', ['target' => $user])
    <ul>
        <li><a href="{{ route('users.articles', $user) }}" wire:navigate>Articles</a> </li>
        <li><a href="{{ route('users.topics', $user) }}" wire:navigate>Topics</a></li>
        <li><a href="{{ route('users.comments', $user) }}" wire:navigate>Comments</a></li>
    </ul>
@endsection