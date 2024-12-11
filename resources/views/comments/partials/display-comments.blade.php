<ul>
@foreach ($comments as $comment)
    <li class="comment">
        @livewire('comment-editor', ['comment' => $comment], key($comment->id))
        <p><em>By {{ $comment->author->name }}</em></p>
        <!-- could add reply button here -->        

        @if ($comment->replies->count())
            <ul class="replies"> 
                @include('comments.partials.display-comments', ['comments' => $comment->replies])
            </ul>
        @endif
    </li>
@endforeach
</ul>