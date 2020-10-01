<?php

namespace App\View\Components\show;

use App\Models\Genre;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.show.navbar');
    }

    public function genres()
    {
        $genres = Genre::all();
        return $genres;
    }
}
