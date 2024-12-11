@extends('layouts.default')

@section('title', 'User Profile')

@section('content')
    <h2> {{ $user->name }} </h2>
    <p>{{ $user->profile->bio }}</p>
    <p><b>Location: </b>{{ $user->profile->location }}</p>
    <ul>
        <li><a href="{{ route('users.articles', $user) }}" wire:navigate>Articles</a> </li>
        <li><a href="{{ route('users.topics', $user) }}" wire:navigate>Topics</a></li>
        <li><a href="{{ route('users.comments', $user) }}" wire:navigate>Comments</a></li>
    </ul>
@endsection