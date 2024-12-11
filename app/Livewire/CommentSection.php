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
    public $loadedCommentsCount = 10;
    public $totalCommentsCount = 0;
    public $parent_id = null;

    public function submitComment() {
        
        if (!auth()->check()) {
            session()->put('url.intended', url()->previous());
            session()->put('content', $this->commentContent);
            session()->flash('message', 'You must be logged in to comment.');
    
            return redirect()->route('login');
        }

        $this->validate([
            'commentContent' => 'required|string|max:1000',
            'parent_id' => 'nullable|integer|exists:comments,id',
            'commentableType' => 'required|string',
            'commentableId' => 'required|integer',
        ]);

        Comment::create([
            'content' => $this->commentContent,
            'commentable_id' => $this->commentableId,
            'commentable_type' => $this->commentableType,
            'parent_id' => $this->parent_id,
            'author_id' => Auth::user()->id,
        ]);

        $this->reset('commentContent', 'parent_id');
        $this->loadComments();
    }
    
    public function loadComments() {
        $this->updateTotalComments();

        $this->comments = Comment::where('commentable_type',$this->commentableType)
            ->where('commentable_id', $this->commentableId)
            ->whereNull('parent_id')
            ->with('replies')
            ->take($this->loadedCommentsCount)
            ->get();
    }

    public function loadMore() {
        $this->loadedCommentsCount += 10;
        $this->loadComments();
    }

    public function updateTotalComments() {
        $this->totalCommentsCount = Comment::where('commentable_type',$this->commentableType)
            ->where('commentable_id', $this->commentableId)
            ->whereNull('parent_id')
            ->count();
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
