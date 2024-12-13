@extends('layouts.default')

@section('title', 'User Profile')

@section('content')
    
<div class="w-full bg-white p-8 rounded-lg shadow-lg border border-gray-200 max-w-md mx-auto hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
        @can('update', $user->profile)
            <div class="p-2">
                @livewire('profile-editor', ['profile' => $user->profile, 'user' => $user])

            </div>
        @endcan

        <div class="p-2">
            <a href="{{ route('profiles.followers', ['user' => $user]) }}" wire:navigate class="mt-4 bg-gray-100 px-6 py-2 hover:bg-gray-200">
             Followers</a>
            <a href="{{ route('profiles.following', ['user' => $user]) }}" wire:navigate class="mt-4 bg-gray-100 px-6 py-2 hover:bg-gray-200">
             Following</a>
        </div>
        @livewire('follow-user', ['target' => $user])
        <ul class="flex space-x-6 p-4 gap-8">
            <li>
                <a href="{{ route('users.articles', $user) }}" wire:navigate 
                    class="inline-block bg-gray-100 px-6 py-2 rounded-lg hover:bg-gray-100">
                    Articles
                </a>
            </li>
            <li>
                <a href="{{ route('users.topics', $user) }}" wire:navigate 
                    class="inline-block bg-gray-100 px-6 py-2 rounded-lg hover:bg-gray-100">
                    Topics
                </a>
            </li>
            <li>
                <a href="{{ route('users.comments', $user) }}" wire:navigate 
                    class="inline-block bg-gray-100 px-6 py-2 rounded-lg hover:bg-gray-100">
                    Comments
                </a>
            </li>
        </ul>

    </div>

@endsection