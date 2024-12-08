<ul>
@foreach ($comments as $comment)
    <div class="comment">
        <li> {{ $comment->content }}</li>
    </div>

    @if ($comment->replies->count())
        <div class="replies"> 
            @include('comments.partials.display-comments', ['comments' => $comment->replies])
        </div>
    @endif
@endforeach
</ul>