@extends('layouts.default')

@section('title', 'User Topics')

@section('content')
    <h3> Topics by {{ $user->name }}: </h3>
    <ul>
    @forelse($user->topics as $topic)
        <li><div class="topic">
            <h4><a href="{{ route('topics.show', $topic) }}" wire:navigate> {{ $topic->title }}</a></h4>
            <p>{{ $topic->content }}</p>
        </div></li>
    @empty
        <p>No topics by this user</p>
    @endforelse
    </ul>
@endsection