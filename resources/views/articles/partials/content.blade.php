<ul>
    <li> Topic: {{ $article->topic->title ?? 'Unknown' }} </li>
    <li> Title: {{ $article->title }}</li>
    <li> Author: <a href="{{ route('profiles.show', $article->author) }}" wire:navigate> {{ $article->author->name ?? 'Unkown' }} </a></li>
    <li> Date of Article: {{ $article->created_at }}</li>
    @if($article->edited == 1) <li> Updated: {{ $article->updated_at }}</li>@endif
</ul>
<h4>Content: </h4>
<p>{{ $article->content }}</p>