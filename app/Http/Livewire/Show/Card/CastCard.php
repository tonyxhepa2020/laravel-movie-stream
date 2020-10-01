<?php

namespace App\Http\Livewire\Show\Card;

use Livewire\Component;

class CastCard extends Component
{
    public $name;
    public $slug;
    public $poster;
    public $movies = [];

    public function mount($cast)
    {
        $this->name = $cast->name;
        $this->slug = $cast->slug;
        $this->movies = $cast->movies;
        if ($cast->poster_path){
            $this->poster = $cast->poster_path;
        }

    }
    public function render()
    {
        return view('livewire.show.card.cast-card');
    }
}
