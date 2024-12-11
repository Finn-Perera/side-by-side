<div>
    <form wire:submit.prevent="submitComment">
        @csrf
        <input wire:model="commentContent" type="text" name="content" placeholder="Add a comment..." required></input>    
        <input type="hidden" wire:model="commentableType" value="{{ $commentableType }}">
        <input type="hidden" wire:model="commentableId" value="{{ $commentableId }}">

        @error('commentContent') 
            <p class="error">{{ $message }}</p>
        @enderror

        <input type="submit" value="Submit">
    </form>

    @if (session()->has('message'))
        <p>{{ session('message') }}</p>
    @endif

    @if ($comments->isEmpty())
        <p>No comments yet!</p>
    @else
        @include('comments.partials.display-comments', ['comments' => $comments])
    @endif
</div>
