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
        return view('livewire.search-topics', [
            'topics' => Topic::where('title', 'like', '%'.$this->query.'%')->paginate(10),
        ]);
    }
}
