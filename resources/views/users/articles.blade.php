@extends('layouts.default')

@section('title', 'User Articles')

@section('content')
    <h3> Articles by {{ $user->name }}: </h3>
    <ul>
    @forelse($user->articles as $article)
        <li><div class="article">
            <h4><a href="{{ route('articles.show', $article) }}" wire:navigate> {{ $article->title }}</a></h4>
            <p>{{ $article->content }}</p>
        </div></li>
    @empty
        <p>No articles by this user</p>
    @endforelse
    </ul>
@endsection