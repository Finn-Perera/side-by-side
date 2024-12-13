<?php

namespace App\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;

class DeleteArticle extends Component
{
    public $article;
    
    public function deleteArticle() {
        try { 
            $this->authorize('delete', $this->article);
            $parent_topic = $this->article->topic;
            $route = $parent_topic ? route('topics.show', $parent_topic) : route('topics.index');
            $this->article->delete();

            session()->flash('success', 'Article deleted successfully');
            session()->save();
            $this->redirect($route);
        }
        catch (AuthorizationException $e) {
            session()->flash('error', 'You do not have permission to delete this article.');
        }
    } 

    public function render()
    {
        return view('livewire.delete-article');
    }
}
