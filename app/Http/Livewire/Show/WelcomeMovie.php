<?php

namespace App\Http\Livewire\Show;

use App\Models\Movie;
use App\Models\Serie;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;

class WelcomeMovie extends Component
{
    public function render()
    {
        SEOMeta::setTitle('Filma24 Filma me Titra Shqip - Filma Aksion - Filma Erotik');
        SEOMeta::setDescription('Filma24 filma me titra shqip, Shikoni dhe shkakroni Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        OpenGraph::setDescription('Shiko dhe shkarko filma me titra shqip FALAS!, Shiko Seriale Turke Me Titra Shqip');
        OpenGraph::setTitle('Filma24 Filma me Titra Shqip - Filma Aksion - Filma Erotik');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage(url(asset('/img/logo.png')));
        OpenGraph::addImage(url(asset('/img/logo.png')), ['height' => 290, 'width' => 185]);

        TwitterCard::setTitle('Filma24 Filma me Titra Shqip - Filma Aksion - Filma Erotik');
        $movies = Movie::published(true)->orderBy('updated_at', 'desc')->take(12)->get();
        $series = Serie::orderBy('updated_at', 'desc')->take(12)->get();
        return view('livewire.show.welcome-movie', [
            'movies' => $movies,
            'series' => $series
        ]) ->extends('layouts.show')
            ->section('content');
    }
}
