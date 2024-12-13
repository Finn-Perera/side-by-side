<div>
    @if ($isEditing)
        <form wire:submit="updateComment">
            <textarea wire:model.live="content" required class="w-full p-2 border rounded none"></textarea>
            @error('content') <span class="error">{{ $message }}</span> @enderror

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
