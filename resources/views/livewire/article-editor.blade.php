<div>
    @if ($isEditing)
        <form wire:submit="updateArticle">
            <div>
                <input type="text" wire:model.live="title" required>
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>    

            <div>
                <textarea wire:model.live="content" required></textarea>
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit">Save</button>
            <button type="button" wire:click="cancelEditing">Cancel</button>
        </form>
    @else
        @include('articles.partials.content', ['article' => $article])

        @can('update', $article)
        <button type="button" wire:click="startEditing">Edit Article</button>
    @endcan
    @endif

    
</div>
