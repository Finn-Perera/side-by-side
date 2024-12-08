@extends('layouts.default')

@section('title', 'Topic Details')

@section('content')
    <ul>
        <li> Title: {{ $topic->title }}</li>
        <li> Author: {{ $topic->author->name ?? 'Unkown' }} </li>
        <li> Date of Topic: {{ $topic->date ?? 'Unkown' }}</li>
    </ul>
    
    <p> Articles on the topic: </p>
    <ul>
        @foreach ($topic->articles as $article)
            <li><a href=" {{route('articles.show', $article)}}">{{ $article->title }}</a></li>
        @endforeach
    </ul>
@endsection

@section('comments')
    <h4>Comments Section: </h4>
    @if ($topic->parentComments->count() > 0)
        @include('comments.partials.display-comments', ['comments' => $topic->parentComments])
    @else
        <p> No comments yet! </p>
    @endif
@endsection