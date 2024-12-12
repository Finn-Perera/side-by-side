<div>
    @if ($user->following->contains($target))
        @can('unfollow', $target)
            <button wire:click="unfollow" type="button" class="unfollow-button">Unfollow</button>
        @endcan
    @else
        @can('follow', $target)
            <button wire:click="follow" type="button" class="follow-button">Follow</button>
        @endcan
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>
