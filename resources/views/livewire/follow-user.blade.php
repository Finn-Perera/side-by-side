<div>
    @if ($user->following->contains($target))
        <button wire:click="unfollow" type="button" class="unfollow-button">Unfollow</button>
    @else
        <button wire:click="follow" type="button" class="follow-button">Follow</button>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>
