<?php

namespace App\Http\Livewire\Show;

use App\Models\Cast;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;
use Livewire\WithPagination;

class CastIndex extends Component
{
    use WithPagination;

    public function render()
    {
        SEOMeta::setTitle('Aktoret | Filma24 | Filma me Titra Shqip HD, Filma Indian, Filma Turk');
        SEOMeta::setDescription('Shiko dhe shkarko filma me titra shqip FALAS! Seriale turke. Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        OpenGraph::setDescription('Shiko dhe shkarko filma me titra shqip FALAS! Seriale turke. Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip');
        OpenGraph::setTitle('Aktoret | Filma24 | Filma me Titra Shqip HD, Filma Indian, Filma Turk');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'articles');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');

        TwitterCard::setTitle('Aktoret | Filma24 | Filma me Titra Shqip HD, Filma Indian, Filma Turk');
        $casts = Cast::orderBy('created_at', 'desc')->paginate(18);
        return view('livewire.show.cast-index', [
            'casts' => $casts
        ])
            ->extends('layouts.show')
            ->section('content');
    }
}
