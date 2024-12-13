<div>
    @if ($isEditing)
        <form wire:submit="updateProfile">
            <div>
                <div>Bio:</div>
                <textarea wire:model.live="bio" class="w-full p-3 border rounded resize"></textarea>
                @error('bio') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <livewire:location-dropdown :country="$location" key="{{ now() }}" />
            </div>


            <button type="submit" class="mt-4 bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">Save</button>
            <button type="button" wire:click="cancelEditing" class="mt-4 bg-gray-100 text-white px-6 py-2 rounded-lg hover:bg-gray-200">Cancel</button>
        </form>
    @else 
            <h1 class="font-extrabold text-3xl mb-4">{{ $user->name }}</h1>
            <p class="text-lg mb-4">{{ $user->profile->bio }}</p>
            <p class="text-sm "><b>Location: </b>{{ $location }}</p>

            @can('update', $profile)
                <button type="button" wire:click="startEditing" class="mt-4 bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    Edit Profile
                </button>
            @endcan
    @endif
</div>
