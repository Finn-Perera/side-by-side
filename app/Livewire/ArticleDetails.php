<?php

namespace App\Livewire;

use Livewire\Component;

class ArticleDetails extends Component
{
    public $article;

    public function render()
    {
        return view('livewire.article-details');
    }
}
