<div>
    @if ($user->following->contains($target))
        @can('unfollow', $target)
            <button wire:click="unfollow" type="button" class="unfollow-button mt-4 bg-gray-100 px-4 py-2 rounded-lg hover:bg-gray-200">Unfollow</button>
        @endcan
    @else
        @can('follow', $target)
            <button wire:click="follow" type="button" class="follow-button mt-4 bg-orange-500 px-4 py-2 rounded-lg hover:bg-orange-600">Follow</button>
        @endcan
    @endif

    
</div>
