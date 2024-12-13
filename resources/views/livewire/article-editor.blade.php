<div>
    @if ($isEditing)
        <form wire:submit="updateArticle">
            <div>
                <b>Title</b>
                <input type="text" wire:model.live="title" required class="w-full p-2 border rounded">
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>    

            <div>
                <b>Content</b>
                <textarea wire:model.live="content" required class="w-full p-3 border rounded resize"></textarea>
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="mt-4 bg-orange-500 px-6 py-2 rounded-lg hover:bg-orange-600">
                Save
            </button>
            <button type="button" wire:click="cancelEditing" class="mt-4 bg-gray-100 px-6 py-2 rounded-lg hover:bg-gray-200">
                Cancel
            </button>
        </form>
    @else
        @include('articles.partials.content', ['article' => $article])

        @can('update', $article)
            <button type="button" wire:click="startEditing" class="mt-4 bg-orange-500 px-6 py-2 rounded-lg hover:bg-orange-600">
                Edit Article
            </button>
        @endcan
    @endif

    
</div>
