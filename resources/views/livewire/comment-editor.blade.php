<div>
    @if ($isEditing)
        <form wire:submit="updateComment">
            <div>
                <textarea wire:model.live="content" required></textarea>
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit">Save</button>
            <button type="button" wire:click="cancelEditing">Cancel</button>
        </form>
    @else
        <p>{{ $comment->content }}</p>
        @if ($comment->edited)
            <p><i>Edited</i></p>
        @endif
        @can('update', $comment)
            <button type="button" wire:click="startEditing">Edit</button>
        @endcan
    @endif
    
</div>
