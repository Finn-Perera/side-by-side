<ul>
@foreach ($comments as $comment)
    <li class="comment">
        @livewire('comment-editor', ['comment' => $comment], key($comment->id))
        <p><em>By <a href="{{ route('profiles.show', $comment->author) }}" wire:navigate>{{ $comment->author->name }} </a></em></p>
        <!-- could add reply button here -->        

        @if ($comment->replies->count())
            <ul class="replies"> 
                @include('comments.partials.display-comments', ['comments' => $comment->replies])
            </ul>
        @endif
    </li>
@endforeach
</ul>