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

            $this->article->delete();
            $parent_topic = $this->article->topic;
            $route = $parent_topic == null ? route('topics.index') : route('topics.show', $parent_topic);
            session()->flash('success', 'Article deleted successfully');
            $this->redirect($route, navigate:true);
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
