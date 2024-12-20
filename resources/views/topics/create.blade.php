@extends('layouts.default')

@section('title', 'Create Topic')

@section('content')
    <form method="post" action="{{ route('topics.store') }}">
        @csrf
        <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>
        <p>Date of Topic: <input type="date" name="date" value="{{ old('date') }}"></p>
        <p>Content: <input type="text" name="content" value="{{ old('content') }}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('topics.index') }}" wire:navigate>Cancel</a>
    </form>

@endsection