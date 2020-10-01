<?php

namespace App\Http\Livewire\Show;

use App\Models\Season;
use App\Models\Serie;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SeasonShow extends Component
{
    use WithPagination;

    public $serie;
    public $season;

    public function mount(Serie $serie, Season $season)
    {
        $this->serie = $serie;
        $this->season = $season;

    }
    public function render()
    {

        if (!empty($this->serie)){

            SEOMeta::setTitle(Str::limit($this->serie->name. ' Sezoni '. $this->season->season_number. ' me Titra Shqip filma24.pw', 67));
            SEOMeta::setDescription($this->serie->name. ' Sezoni '. $this->season->season_number. ' me Titra Shqip. Shiko dhe shkarko Seriale me titra shqip FALAS! Seriale turke, Serialet dhe filmat e fundit.');
            SEOMeta::setCanonical(url()->current());
            SEOMeta::addMeta('article:published_time', $this->season->created_at, 'property');
            SEOMeta::addMeta('og:locale', 'en_US', 'property');
            SEOMeta::addMeta('og:type', 'article', 'property');
            SEOMeta::addMeta('og:url', url()->current(), 'property');
            SEOMeta::addMeta('article:tag', 'Netflix', 'property');
            SEOMeta::addMeta('article:section', 'Series', 'property');
            SEOMeta::addMeta('og:site_name', 'filma24.pw | Seriale me titra shqip HD', 'property');
            OpenGraph::setDescription('Shiko dhe shkarko seriale me titra shqip FALAS!');
            OpenGraph::setTitle($this->serie->name. ' Sezoni '. $this->season->season_number. ' me Titra Shqip HD - Seriale me titra shqip HD!');
            OpenGraph::addImage(url(asset('storage/serie/season/'. $this->season->poster_path)));
            OpenGraph::addImage(url(asset('storage/serie/season/'. $this->season->poster_path)), ['height' => 290, 'width' => 185]);
        }

        return view('livewire.show.season-show', [
            'episodes' => $this->season->episodes()->paginate(18)
        ])->extends('layouts.show')
            ->section('content');
    }
}
