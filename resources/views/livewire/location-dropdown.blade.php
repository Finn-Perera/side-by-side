<div>
    @if (session()->has('message'))
        <p>{{ session('message') }}</p>
    @endif
    <div class="font-bold">Select Location:</div>
    
    <input wire:model.live.debounce.500ms="query" type="text" placeholder="Search locations">
    <select wire:model.live="selectedLocation" class="form-select">
        <option value="" >Select a location</option>
        @if(!empty($locations))
            @foreach($locations as $location)
                <option value="{{ $location['geonameId'] }}">
                    {{ $location['city'] }}, {{ $location['country'] ?? 'Unknown' }}
                </option>                  
            @endforeach
        @endif
    </select>
    <button wire:click="updateSelectedLocation" class="mt-4 bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">Click to confirm selection</button>
</div>