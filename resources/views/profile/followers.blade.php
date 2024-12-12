@extends('layouts.default')

@section('title', 'Followers')

@section('content')
    <ul>
        @foreach ($user->followers as $follower)
            <li>
                <a href="{{ route('profiles.show', $follower) }}" wire:navigate>{{ $follower->name }}</a>
                    @livewire('follow-user', ['target' => $follower])
            </li>
        @endforeach
    </ul>
@endsection