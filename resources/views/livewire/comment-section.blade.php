<div class="max-w-4xl mx-auto p-6">
    <form wire:submit="submitComment" class="mb-6">
        @csrf
        <div class="flex flex-col space-y-4">
            <input wire:model="commentContent" type="text" name="content" placeholder="Add a comment..." required class="p-3 border rounded-lg shadow-sm w-full" />    
            <input type="hidden" wire:model="commentableType" value="{{ $commentableType }}">
            <input type="hidden" wire:model="commentableId" value="{{ $commentableId }}">
            <input type="hidden" wire:model="parent_id" value="{{ $parent_id }}">

            @error('commentContent') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <input type="submit" value="Submit" class="bg-orange-500 px-4 py-2 rounded-lg cursor-pointer hover:bg-orange-600 shadow-sm">
        </div>
    </form>

    @if (session()->has('message'))
        <p class="text-green-500 mb-4">{{ session('message') }}</p>
    @endif

    @if ($comments->isEmpty())
        <p class="text-gray-500">No comments yet!</p>
    @else
        <div class="space-y-4">
            @foreach ($comments as $comment)
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <p class="text-gray-700">{{ $comment->content }}</p>

                    <a href="{{ route('profiles.show', $comment->author) }}" wire:navigate class="text-orange-600 hover:text-orange-800 underline">
                          {{ $comment->author->name ?? 'Anonymous' }}
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    @if ($loadedCommentsCount < $totalCommentsCount)
        <button wire:click="loadMore" class="mt-4 bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">Show More</button>
    @endif
</div>