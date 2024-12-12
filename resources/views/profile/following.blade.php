@extends('layouts.default')

@section('title', 'Following')

@section('content')
    <ul>
        @foreach ($user->following as $follow)
            <li>
                <a href="{{ route('profiles.show', $follow) }}" wire:navigate>{{ $follow->name }}</a>
                    @livewire('follow-user', ['target' => $follow])
            </li>
        @endforeach
    </ul>
@endsection