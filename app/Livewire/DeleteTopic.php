<?php

namespace App\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;

class DeleteTopic extends Component
{
    public $topic;

    public function deleteTopic() {
        try { 
            $this->authorize('delete', $this->topic);

            $this->topic->delete();
            session()->flash('success', 'Topic deleted successfully');
            $this->redirect(route('topics.index'), navigate:true);
        }
        catch (AuthorizationException $e) {
            session()->flash('error', 'You do not have permission to delete this topic.');
        }
    } 

    public function render()
    {
        return view('livewire.delete-topic');
    }
}
