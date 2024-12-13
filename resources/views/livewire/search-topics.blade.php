<div>
    <form wire:submit="search">
        <input type="text" wire:model="query">

        <button type="submit">Search posts</button>
    </form>

    <p> The current topics in The World: </p>
    <ul>
        @foreach ($topics as $topic)
            <li><a href="{{ route('topics.show', $topic)}}" wire:navigate>{{ $topic->title }}</a></li>
        @endforeach
    </ul>

    <div>

        {{ $topics->links() }}
        
    </div>
</div>

