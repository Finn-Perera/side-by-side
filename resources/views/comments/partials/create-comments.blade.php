<form method="post" action="{{ route('comments.store', $commentable) }}">
    @csrf
    <div>
        <input type="text" name="content" placeholder="Add a comment..." required value="{{ old('content') }}"></input>
    </div>
    <input type="hidden" name="commentable_type" value="{{ get_class($commentable) }}">
    <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">
    
    <input type="submit" value="Submit">
</form>