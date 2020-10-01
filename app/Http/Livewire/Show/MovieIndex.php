<?php

namespace App\Http\Livewire\Show;

use App\Models\Movie;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;
use Livewire\WithPagination;

class MovieIndex extends Component
{
    use WithPagination;

    public function render()
    {
        SEOMeta::setTitle('Filmat e fundit me Titra Shqip - Filma Aksion - Filma Erotik Filma24');
        SEOMeta::setDescription('Filmat e fundit me titra shqip, Shikoni dhe shkakroni Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip Filma24.');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        OpenGraph::setDescription('Filma24.pw filma me titra shqip, Shikoni dhe shkakroni Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip');
        OpenGraph::setTitle('Filma24.pw Filma me Titra Shqip - Filma Aksion - Filma Erotik');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage(url(asset('/img/logo.png')));
        OpenGraph::addImage(url(asset('/img/logo.png')), ['height' => 290, 'width' => 185]);

        TwitterCard::setTitle('Filma24.pw Filma me Titra Shqip - Filma Aksion - Filma Erotik');

        return view('livewire.show.movie-index', [
            'movies' => Movie::published(true)->orderBy('updated_at', 'desc')->paginate(18)
            ])
            ->extends('layouts.show')
            ->section('content');
    }
}
