<?php

namespace App\Http\Livewire\Show;

use App\Models\Movie;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public function resetAll()
    {
        $this->search = '';

    }

    public function render()
    {


        return view('livewire.show.search');
    }
}
