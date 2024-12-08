@extends('layouts.default')

@section('title', 'User Comments')

@section('content')
    <h3> Comments by {{ $user->name }}: </h3>
    <ul>
    @forelse($comments as $comment)
        <li><div class="comment">
            <p>{{ $comment->content }}</p>    

            @if ($comment->commentable instanceof \App\Models\Article)
                <p>Comment on article: <a href="{{ route('articles.show', $comment->commentable)}}">
                    {{ $comment->commentable->title }}
                </a></p>
            @elseif ($comment->commentable instanceof \App\Models\Topic)
                <p>Comment on topic: <a href="{{ route('topics.show', $comment->commentable)}}">
                    {{ $comment->commentable->title }}
                </a></p>
            @endif
        </div></li>
    @empty
        <p>No articles by this user</p>
    @endforelse
    </ul>
@endsection