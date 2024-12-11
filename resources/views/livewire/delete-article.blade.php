<div>
    <button wire:click="deleteArticle" class="btn btn-danger">Delete Article</button>
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>
