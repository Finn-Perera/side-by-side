@extends('layouts.default')

@section('title', 'Topics')

@section('content')
    <p> The current topics in The World: </p>
    <ul>
        @foreach ($topics as $topic)
            <li><a href="{{ route('topics.show', ['id' => $topic->id])}}">{{ $topic->title }}</a></li>
        @endforeach
    </ul>
@endsection