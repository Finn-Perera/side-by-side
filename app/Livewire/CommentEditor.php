<?php

namespace App\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentEditor extends Component
{
    public $comment;
    public $isEditing = false;
    #[Validate('required|string|max:1000')]
    public $content;

    public function startEditing() {
        try {
            $this->authorize('update', $this->comment);
            $this->isEditing = true;
        } catch (AuthorizationException $e) {
            session()->flash('error', 'You do not have permission to edit this article.');
        }
    }

    public function cancelEditing() {
        $this->isEditing = false;
    }

    public function updateComment() {
        $this->validate();

        $this->comment->update([
            'content'=>$this->content,
            'edited' => true,
        ]);

        $this->isEditing = false;
        
        session()->flash('message', 'Comment successfully updated.');
    }

    public function mount($comment) {
        $this->comment = $comment;
        $this->content = $comment->content;
    }

    public function render(){
        return view('livewire.comment-editor');
    }
}