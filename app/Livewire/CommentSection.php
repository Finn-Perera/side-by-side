<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentSection extends Component
{
    public $commentContent = '';
    public $commentableId;
    public $commentableType;
    public $comments;

    public function submitComment() {
        
        if (!auth()->check()) {
            session()->put('url.intended', url()->previous());
            session()->put('content', $this->commentContent);

            return redirect()->route('login');
        }

        $this->validate([
            'commentContent' => 'required',
            'commentableId' => 'required',
            'commentableType' => 'required',
        ]);

        $comment = Comment::create([
            'content' => $this->commentContent,
            'commentable_id' => $this->commentableId,
            'commentable_type' => $this->commentableType,
            'parent_id' => null,
            'author_id' => Auth::user()->id,
        ]);

        $this->reset('commentContent');
        $this->loadComments();
    }

    public function loadComments() {
        $this->comments = Comment::where('commentable_type',$this->commentableType)
            ->where('commentable_id', $this->commentableId)
            ->whereNull('parent_id')
            ->with('replies')
            ->get();
    }

    public function mount($commentable) {
        if (session()->has('content')) {
            $this->commentContent = session('content');
        }
        $this->commentableId = $commentable->id;
        $this->commentableType = get_class($commentable);
        $this->loadComments();
    }

    public function render()
    {   
        return view('livewire.comment-section');
    }
}
