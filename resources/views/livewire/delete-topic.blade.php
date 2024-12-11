<div>
    <button wire:click="deleteTopic" class="btn btn-danger">Delete Topic</button>
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>
