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

    <form method="post" action="{{ route('articles.destroy', $article) }}">
        @csrf
        @method('DELETE')
        <button type="submit"> Delete </button>
    </form>
@endsection

@section('comments')
    <h4>Comments Section: </h4>
    @if ($article->parentComments->count() > 0)
        @include('comments.partials.display-comments', ['comments' => $article->parentComments])
    @else
        <p> No comments yet! </p>
    @endif
@endsection