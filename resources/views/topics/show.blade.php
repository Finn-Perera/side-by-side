@extends('layouts.default')

@section('title', 'Topic Details')

@section('content')
    <ul>
        <li> Title: {{ $topic->title }}</li>
        <li> Author: <a href="{{ route('profiles.show', $topic->author) }}" wire:navigate> {{ $topic->author->name ?? 'Unkown' }} </a></li>
        <li> Date of Topic: {{ $topic->date ?? 'Unkown' }}</li>
    </ul>
    <h3>Content:</h3>
    <p>{{ $topic->content }}</p>
    
    @can('delete', $topic)
        @livewire('delete-topic', ['topic' => $topic])
    @endcan

    <p> Articles on the topic: </p>
    <ul>
        @foreach ($topic->articles as $article)
            <li>
                <a href=" {{ route('articles.show', $article) }}" wire:navigate>
                    {{ $article->title }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection

@section('comments')
    @livewire('comment-section', ['commentable' => $topic])
@endsection