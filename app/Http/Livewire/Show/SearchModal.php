<?php

namespace App\Http\Livewire\Show;

use App\Models\Cast;
use App\Models\Movie;
use App\Models\Serie;
use Livewire\Component;
use Spatie\Searchable\Search;

class SearchModal extends Component
{

    public $search;

    public function resetAll()
    {
        $this->search = '';
    }

    public function render()
    {
        $searchResults = [];
        if ($this->search){
            $get_movies = Movie::search($this->search)->where('is_public', true)->get()
                ->map(function (Movie $movie){
                    $movie->slug = route('movies.show', $movie->slug);
                    $movie->poster_path = asset('storage/movie/'. $movie->poster_path);
                    $movie['type'] = 'Film';
                    return $movie;
                });
            $get_series = Serie::search($this->search)->get()
                ->map(function (Serie $serie){
                    $serie->slug = route('series.show', $serie->slug);
                    $serie->poster_path = asset('storage/serie/'. $serie->poster_path);
                    $serie['title'] = $serie->name;
                    $serie['type'] = 'Serial';
                    return $serie;
                });
            $get_actors = Cast::search($this->search)->get()
                ->map(function (Cast $cast){
                    $cast->slug = route('casts.show', $cast->slug);
                    $cast->poster_path = asset('storage/cast/'. $cast->poster_path);
                    $cast['title'] = $cast->name;
                    $cast['type'] = 'Aktor';
                    return $cast;
                });
            $searchResults = $get_movies->merge($get_series)->merge($get_actors);
        }

        return view('livewire.show.search-modal', [
            'searchResults' => collect($searchResults)->take(7)
        ]);
    }
}
