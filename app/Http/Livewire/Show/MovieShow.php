<?php

namespace App\Http\Livewire\Show;

use App\Models\Movie;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Str;
use Livewire\Component;

class MovieShow extends Component
{
    public $movie;
    public $latest = [];

    public function mount($slug)
    {

        $this->movie = Movie::where('slug', $slug)->first();

        SEOMeta::setTitle(Str::limit( $this->movie->title. ' me Titra Shqip filma24.pw', 68, '.'));
        SEOMeta::setDescription(Str::limit($this->movie->title .' me titra shqip filma24.pw '.$this->movie->overview, 150));
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $this->movie->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', $this->movie->genres->first()->title, 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription(Str::limit($this->movie->title .' me titra shqip filma24.pw '.$this->movie->overview, 150));
        OpenGraph::setTitle(Str::limit( $this->movie->title. ' me Titra Shqip filma24.pw', 68, '.'));
        OpenGraph::addImage(url(asset('storage/movie/'. $this->movie->poster_path)));
        OpenGraph::addImage(url(asset('storage/movie/'. $this->movie->poster_path)), ['height' => 290, 'width' => 185]);
    }

    public function render()
    {
        $this->latest = Movie::orderBy('created_at', 'desc')->published(true)->take(12)->get();
        return view('livewire.show.movie-show', [
            'latest' => $this->latest
        ])
            ->extends('layouts.show')
            ->section('content');
    }
}
