<?php

namespace App\Http\Livewire\Show;

use App\Models\Genre;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;
use Livewire\WithPagination;

class GenreShow extends Component
{
    use WithPagination;

    public $genre;

    public function mount($slug)
    {
        $this->genre = Genre::where('slug', $slug)->first();
    }
    public function render()
    {
        SEOMeta::setTitle('Filma '.$this->genre->title. ' me Titra Shqip filma24.pw');
        SEOMeta::setDescription('Filma '.$this->genre->title. ' me Titra Shqip Filma24.pw Shiko dhe shkarko filma Aksion. Filma dhe serialet e fundit, seriale turke me titra shqip. Faqe per filma.');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $this->genre->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', $this->genre->title, 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription('Filma '.$this->genre->title. ' me Titra Shqip Filma24.pw Shiko dhe shkarko filma Aksion. Filma dhe serialet e fundit, seriale turke me titra shqip. Faqe per filma.');
        OpenGraph::setTitle('Filma '.$this->genre->title. ' me Titra Shqip HD - Filma me titra shqip HD!');
        OpenGraph::addImage(url(asset('/img/logo.png')));
        OpenGraph::addImage(url(asset('/img/logo.png')), ['height' => 290, 'width' => 185]);

        $movies = $this->genre->movies()->published(true)->paginate(18);
        return view('livewire.show.genre-show', [
            'movies' => $movies
        ])->extends('layouts.show')
            ->section('content');
    }
}
