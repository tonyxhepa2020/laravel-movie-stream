<?php

namespace App\Http\Livewire\Show;

use App\Models\Serie;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SerieShow extends Component
{
    use WithPagination;

    public $serie;

    public function mount($slug)
    {
        $this->serie = Serie::where('slug', $slug)->first();
    }
    public function render()
    {

        SEOMeta::setTitle(Str::limit($this->serie->name. ' me Titra Shqip HD - Seriale me titra shqip.', 67, '...'));
        SEOMeta::setDescription($this->serie->name.' me Titra Shqip filma24.pw, Shiko dhe shkarko filma me titra shqip. Seriale turke, Serialet dhe filmat e fundit.');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $this->serie->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', 'Series', 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription($this->serie->name.' me Titra Shqip filma24.pw, Shiko dhe shkarko filma me titra shqip. Seriale turke, Serialet dhe filmat e fundit.');
        OpenGraph::setTitle(Str::limit($this->serie->name. ' me Titra Shqip HD - Seriale me titra shqip.', 67, '...'));
        OpenGraph::addImage(url(asset('storage/serie/'.$this->serie->poster_path)));
        OpenGraph::addImage(url(asset('storage/serie/'.$this->serie->poster_path)), ['height' => 290, 'width' => 185]);

        if (!empty($this->serie)){

            $this->serie->timestamps = false;
            $this->serie->increment('visits', 1);
        }

        return view('livewire.show.serie-show', [
            'seasons' => $this->serie->seasons()->paginate(18)
        ])
            ->extends('layouts.show')
            ->section('content');
    }
}
