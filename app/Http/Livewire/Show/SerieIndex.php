<?php

namespace App\Http\Livewire\Show;

use App\Models\Serie;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;
use Livewire\WithPagination;

class SerieIndex extends Component
{
    use WithPagination;

    public function render()
    {
        SEOMeta::setTitle('Seriale me Titra Shqip filma24.pw, Seriale Turke. Seriale HD');
        SEOMeta::setDescription('Filma24.pw filma me titra shqip, Shikoni dhe shkakroni Seriale me titra shqip, Seriale Turke me titra shqip HD, Episodet e perditesuara ne kohe reale.');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        OpenGraph::setDescription('Filma24.pw filma me titra shqip, Shikoni dhe shkakroni Seriale me titra shqip, Seriale Turke me titra shqip HD, Episodet e perditesuara ne kohe reale.');
        OpenGraph::setTitle('Seriale me Titra Shqip filma24.pw, Seriale Turke. Seriale HD');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage(url(asset('/img/logo.png')));
        OpenGraph::addImage(url(asset('/img/logo.png')), ['height' => 290, 'width' => 185]);

        TwitterCard::setTitle('Seriale me Titra Shqip filma24.pw, Seriale Turke. Seriale HD');

        return view('livewire.show.serie-index', [
            'series' => Serie::orderBy('created_at', 'desc')->paginate(18)
        ]) ->extends('layouts.show')
            ->section('content');
    }
}
