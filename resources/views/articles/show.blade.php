@extends('layouts.default')

@section('title', 'Article Details')


@section('content')
    <ul>
        <li> Topic: {{ $article->topic->title ?? 'Unknown' }} </li>
        <li> Title: {{ $article->title }}</li>
        <li> Author: <a href="{{ route('profiles.show', $article->author) }}" wire:navigate> {{ $article->author->name ?? 'Unkown' }} </a></li>
        <li> Date of Article: {{ $article->created_at }}</li>
        @if($article->edited == 1) <li> Updated: {{ $article->updated_at }}</li>@endif
    </ul>
    <h4>Content: </h4>
    <p>{{ $article->content }}</p>

    <form method="post" action="{{ route('articles.destroy', $article) }}" wire:navigate>
        @csrf
        @method('DELETE')
        <button type="submit"> Delete </button>
    </form>
@endsection

@section('comments')
    @livewire('comment-section', ['commentable' => $article])
@endsection