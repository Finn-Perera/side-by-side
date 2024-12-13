@extends('layouts.default')

@section('title', 'Topic Details')

@section('content')
<div class="container mx-auto p-6 flex flex-row lg:flex-row gap-20">
        
        <div class=" flex-1 bg-white p-8 rounded-lg shadow-lg">
            <div class="text-2xl font-semibold mb-4">Title: {{ $topic->title }}</div>
            <div class="text-lg mb-4"> 
                Author: 
                <a href="{{ route('profiles.show', $topic->author) }}" wire:navigate class="font-bold text-blue-600 hover:text-blue-800 underline">
                    {{ $topic->author->name ?? 'Unknown' }} 
                </a>
            </div>
            <div class="text-lg mb-4"> 
                Date of Topic: {{ $topic->date ?? 'Unknown' }}
            </div>
            
            <h3 class="text-xl font-semibold mt-4 mb-2">Content:</h3>
            <p class="text-lg">{{ $topic->content }}</p>
        </div>
        
        <!-- Sidebar with Articles -->
        <div class="bg-white p-8 rounded-lg shadow-lg lg:w-2/3 flex-1">
            <h3 class="text-xl font-semibold mb-4">Articles on the topic:</h3>
            <ul class="space-y-2">
                @foreach ($topic->articles as $article)
                    <li class="p-4 border-b border-gray-300">
                        <div class="flex flex-col space-x-4">
                            <a href="{{ route('articles.show', $article) }}" wire:navigate class="text-blue-600 hover:text-blue-800 underline font-bold">
                                {{ $article->title }}
                            </a>
                            <a href="{{ route('profiles.show', $article->author) }}" wire:navigate class="text-blue-600 hover:text-blue-800 underline">
                                Author: {{ $article->author->name }}
                            </a>
                        </div>  
                     </li>
                @endforeach
            </ul>
        </div>

    </div>
@endsection

@section('comments')
    @livewire('comment-section', ['commentable' => $topic])
@endsection