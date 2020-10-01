<?php

namespace App\Http\Livewire\Show;

use App\Models\Serie;
use Livewire\Component;

class WelcomeSerie extends Component
{
    public function render()
    {
        $series = Serie::orderBy('updated_at', 'desc')->take(12)->get();
        return view('livewire.show.welcome-serie', [
            'series' => $series
        ]);
    }
}
