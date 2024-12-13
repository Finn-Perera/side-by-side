<?php

namespace App\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfileEditor extends Component
{
    public $user;
    public $profile;
    #[Validate('string:max255')]
    public $bio;
    public $location;
    public $country;
    public $latitude;
    public $longitude;
    public $isEditing = false;

    #[On('location-selected')]
    public function handleLocationSelected($location)
    {
        $this->isEditing = true;

        $this->location = $location['city'] . ', ' . $location['country'];
        $this->country = $location['country'];
        $this->latitude = $location['latitude'];
        $this->longitude = $location['longitude']; 


        session()->flash('message', 'Location found.');
    }

    public function startEditing() {
        try{
            $this->authorize('update', $this->profile);
            $this->isEditing = true;

        } catch(AuthorizationException $e) {
            session()->flash('error', 'You do not have permission to edit this profile.');
        }
    }

    public function cancelEditing() {
        $this->isEditing = false;
    }

    public function updateProfile() {
        $this->validate();
        $this->profile->update([
            'bio'=>$this->bio,
            'location' => $this->country,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->isEditing = false;
        session()->flash('message', 'Profile successfully updated.');
    }

    public function mount($user, $profile) {
        $this->user = $user;
        $this->profile = $profile;
        $this->bio = $profile->bio;
        $this->location = $profile->location;
    }

    public function render()
    {
        return view('livewire.profile-editor');
    }
}
