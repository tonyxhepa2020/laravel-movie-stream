<?php

namespace App\Http\Livewire\Show;

use App\Models\Cast;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;
use Livewire\WithPagination;

class CastShow extends Component
{
    use WithPagination;

    public $cast;

    public function mount($slug)
    {
        $this->cast = Cast::where('slug', $slug)->first();
    }
    public function render()
    {
        SEOMeta::setTitle($this->cast->name. ' filma me Titra Shqip HD - Filma24');
        SEOMeta::setDescription($this->cast->name. ' filma me Titra Shqip HD - Filma24 Shiko dhe shkarko filma me titra shqip FALAS!');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $this->cast->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', 'Aktor', 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription('Shiko dhe shkarko filma me titra shqip FALAS!');
        OpenGraph::setTitle($this->cast->name. ' filma me Titra Shqip HD - Filma24');
        OpenGraph::addImage(url(asset('storage/cast/'. $this->cast->poster_path)));
        OpenGraph::addImage(url(asset('storage/cast/'. $this->cast->poster_path)), ['height' => 290, 'width' => 185]);

        return view('livewire.show.cast-show', [
            'movies' => $this->cast->movies()->where('is_public', true)->paginate(12)
        ]) ->extends('layouts.show')
            ->section('content');
    }
}
