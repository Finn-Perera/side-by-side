@extends('layouts.default')

@section('title', 'User Profile')

@section('content')
    <h2> {{ $user->name }} </h2>
    <ul>
        <li><a href="{{ route('users.articles', $user) }}">Articles</a> </li>
        <li><a href="{{ route('users.topics', $user) }}">Topics</a></li>
        <li><a href="{{ route('users.comments', $user) }}">Comments</a></li>
    </ul>
@endsection