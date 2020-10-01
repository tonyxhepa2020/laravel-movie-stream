<?php

namespace App\Http\Livewire\Show;

use App\Models\Tag;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class TagShow extends Component
{
    use WithPagination;
    public $tag;

    public function mount($slug)
    {
        $this->tag = Tag::where('slug', $slug)->first();
    }

    public function render()
    {
        SEOMeta::setTitle(Str::limit($this->tag->tag_name. ' filma me Titra Shqip HD filma24 Filma Indian.', 67));
        SEOMeta::setDescription($this->tag->tag_name. ' Shiko dhe shkarko filma me titra shqip. Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $this->tag->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', 'Movie', 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription($this->tag->tag_name. ' Shiko dhe shkarko filma me titra shqip. Filma Aksion, Filma Erotik, Filma Indian, Filma Turk, Seriale Turke me titra shqip');
        OpenGraph::setTitle($this->tag->tag_name. ' filma me Titra Shqip HD filma24');
        OpenGraph::addImage(url(asset('/img/logo.png')));
        OpenGraph::addImage(url(asset('/img/logo.png')), ['height' => 290, 'width' => 185]);

        $movies = $this->tag->movies()->orderBy('updated_at', 'desc')->published(true)->paginate(18);

        return view('livewire.show.tag-show', [
            'movies' => $movies
        ]) ->extends('layouts.show')
            ->section('content');
    }
}
