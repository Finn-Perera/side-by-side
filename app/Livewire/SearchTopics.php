<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Topic;

class SearchTopics extends Component
{   
    use WithPagination;
 
    public $query = '';
    public function search()
    {
        $this->resetPage();
    }
 
    public function render()
    { 
        $topics = Topic::where('title', 'like', '%'.$this->query.'%')->paginate(4);

        return view('livewire.search-topics', [
            'topics' => $topics->appends(['query' => $this->query]), 
        ]);
    }
}