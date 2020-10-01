<?php

namespace App\Http\Livewire\Show;

use App\Models\Episode;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class EpisodeShow extends Component
{
    public $episode;
    public $season;

    public function mount($slug)
    {
        $this->episode = Episode::where('slug', $slug)->first();
    }
    public function render()
    {
        SEOMeta::setTitle($this->episode->season->serie->name.' Episodi '. $this->episode->episode_number. ' me Titra Shqip filma24.pw');
        SEOMeta::setDescription($this->episode->season->serie->name .' me Titra Shqip. Shiko dhe shkarko Seriale me titra shqip FALAS!. Filma me titra shqip, Seriale turke. filma24.pw .');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $this->episode->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', $this->episode->name, 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription($this->episode->season->serie->name .' me Titra Shqip. Shiko dhe shkarko Seriale me titra shqip FALAS!. Filma me titra shqip, Seriale turke. filma24.pw .');
        OpenGraph::setTitle($this->episode->season->serie->name.' Episodi '. $this->episode->episode_number. ' me Titra Shqip filma24.pw');
        OpenGraph::addImage(url(asset('storage/serie/season/'. $this->episode->season->poster_path)));
        OpenGraph::addImage(url(asset('storage/serie/season/'. $this->episode->season->poster_path)), ['height' => 290, 'width' => 185]);

        $this->season = $this->episode->season;
        $this->episode->timestamps = false;
        $this->episode->increment('visits', 1);

        return view('livewire.show.episode-show')
            ->extends('layouts.show')
            ->section('content');
    }
}
