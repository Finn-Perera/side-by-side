@extends('layouts.default')

@section('title', 'Article Details')


@section('content')
    <ul>
        <li> Topic: {{ $article->topic->title ?? 'Unknown' }} </li>
        <li> Title: {{ $article->title }}</li>
        <li> Author: {{ $article->author->name ?? 'Unkown' }} </li>
        <li> Date of Article: {{ $article->created_at }}</li>
        @if($article->edited == 1) <li> Updated: {{ $article->updated_at }}</li> @endif
    </ul>
    <h4>Content: </h4>
    <p>{{ $article->content }}</p>
@endsection

@section('comments')
    <h4>Comments Section: </h4>
    @if ($article->parentComments)
        @include('partials.comments', ['comments' => $article->parentComments])
    @else
        <p> No comments yet! </p>
    @endif
@endsection