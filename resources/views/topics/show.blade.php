@extends('layouts.default')

@section('title', 'Topic Details')

@section('content')
    <ul>
        <li> Title: {{ $topic->title }}</li>
        <li> Author: <a href="{{ route('profiles.show', $topic->author) }}"> {{ $topic->author->name ?? 'Unkown' }} </a></li>
        <li> Date of Topic: {{ $topic->date ?? 'Unkown' }}</li>
    </ul>
    <h3>Content:</h3>
    <p>{{ $topic->content }}</p>
    
    <p> Articles on the topic: </p>
    <ul>
        @foreach ($topic->articles as $article)
            <li><a href=" {{ route('articles.show', $article) }}">{{ $article->title }}</a></li>
        @endforeach
    </ul>
@endsection

@section('comments')
    <h4>Comments Section: </h4>
    @include('comments.partials.create-comments', ['commentable' => $topic])

    @if ($topic->parentComments->count() > 0)
        @include('comments.partials.display-comments', ['comments' => $topic->parentComments])
    @else
        <p> No comments yet! </p>
    @endif
@endsection