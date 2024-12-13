<div class="w-full bg-white p-8 rounded-lg shadow-md">
    <ul class="space-y-4">
        <li class="text-lg font-semibold">
            Topic: 
            <a wire:navigate href="{{ route('topics.show', $article->topic) }}"  class="text-orange-600 hover:text-orange-800 underline">
                {{ $article->topic->title ?? 'Unknown' }}
            </a>        
        </li>

        <li class="text-lg font-semibold">
            Title: 
            <span class="font-normal">{{ $article->title }}</span>
        </li>

        <li class="text-lg font-semibold">
            Author: 
            <a href="{{ route('profiles.show', $article->author) }}" wire:navigate class="text-orange-600 hover:text-orange-800 underline">
                {{ $article->author->name ?? 'Unknown' }}
            </a>
        </li>

        <li class="text-lg font-semibold">
            Date of Article: 
            <span class="font-normal">{{ $article->created_at->format('F j, Y') }}</span>
        </li>

        @if($article->edited == 1)
            <li class="text-lg font-semibold">
                Updated: 
                <span class="font-normal">{{ $article->updated_at->format('F j, Y') }}</span>
            </li>
        @endif
    </ul>

    <h3 class="text-xl font-semibold mt-4 mb-2">Content:</h3>
    <p class="mt-4 text-gray-700 leading-relaxed">{{ $article->content }}</p>
</div>
