@extends('layouts.default')

@section('title', 'Article Details')


@section('content')
    @livewire('article-editor', ['article' => $article])
    @can('delete', $article)
        @livewire('delete-article', ['article' => $article])
    @endcan
@endsection

@section('comments')
    @livewire('comment-section', ['commentable' => $article])
@endsection