<div>
    @if ($isEditing)
        <form wire:submit="updateProfile">
            <div>
                <div>Bio:</div>
                <textarea wire:model.live="bio"></textarea>
                @error('bio') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <div>Location:</div>
                <input type="search" wire:model.live="location">
                @error('location') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit">Save</button>
            <button type="button" wire:click="cancelEditing">Cancel</button>
        </form>
    @else
        <!-- Include viewing profile here -->    
        <h2> {{ $user->name }} </h2>
        <p>{{ $user->profile->bio }}</p>
        <p><b>Location: </b>{{ $user->profile->location }}</p>


        @can('update', $profile)
            <button type="button" wire:click="startEditing">Edit Profile</button>
        @endcan
    @endif
</div>
