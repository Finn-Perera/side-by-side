@extends('layouts.default')

@section('title', 'User Comments')

@section('content')
    <h3> Comments by {{ $user->name }}: </h3>
    <ul>
    @forelse($user->comments as $comment)
        <li><div class="bg-gray-100 p-4 rounded-lg shadow-md">
            <p>{{ $comment->content }}</p>    
            <p><em>By <a href="{{ route('profiles.show', $comment->author) }}" wire:navigate class="underline">{{ $comment->author->name }} </a></em></p>

            @if ($comment->commentable instanceof \App\Models\Article)
                <p>Comment on article: <a href="{{ route('articles.show', $comment->commentable)}}" wire:navigate class="underline">
                    {{ $comment->commentable->title }}
                </a></p>
            @elseif ($comment->commentable instanceof \App\Models\Topic)
                <p>Comment on topic: <a href="{{ route('topics.show', $comment->commentable)}}" wire:navigate>
                    {{ $comment->commentable->title }}
                </a></p>
            @endif
        </div></li>
    @empty
        <p>No comments by this user</p>
    @endforelse
    </ul>
@endsection