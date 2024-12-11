<?php

namespace App\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ArticleEditor extends Component
{
    public $article;
    public $isEditing = false;
    #[Validate('required|min:3|max:255')] 
    public $title;
    #[Validate('required|string|max:2000')]
    public $content;

    public function startEditing() {
        try {
            $this->authorize('update', $this->article);
            $this->isEditing = true;
        } catch (AuthorizationException $e) {
            session()->flash('error', 'You do not have permission to edit this article.');
        }
    }

    public function cancelEditing() {
        $this->isEditing = false;
    }

    public function updateArticle() {
        $this->validate();

        $this->article->update([
            'title'=>$this->title,
            'content'=>$this->content,
            'edited' => true,
        ]);

        $this->isEditing = false;
        
        session()->flash('message', 'Article successfully updated.');
    }

    public function mount($article) {
        $this->article = $article;
        $this->title = $article->title;
        $this->content = $article->content;
    }

    public function render(){
        return view('livewire.article-editor');
    }
}
