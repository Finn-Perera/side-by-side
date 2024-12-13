<div>
    @if ($isEditing)
        <form wire:submit="updateProfile">
            <div>
                <div>Bio:</div>
                <textarea wire:model.live="bio"></textarea>
                @error('bio') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Current Location</label>
                <livewire:location-dropdown :country="$location" key="{{ now() }}" />
            </div>


            <button type="submit">Save</button>
            <button type="button" wire:click="cancelEditing">Cancel</button>
        </form>
    @else
        <h2> {{ $user->name }} </h2>
        <p>{{ $user->profile->bio }}</p>
        <p><b>Location: </b>{{ $location }}</p>


        @can('update', $profile)
            <button type="button" wire:click="startEditing">Edit Profile</button>
        @endcan
    @endif
</div>
