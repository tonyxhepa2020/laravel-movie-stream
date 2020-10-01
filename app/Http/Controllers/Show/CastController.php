<?php

namespace App\Http\Controllers\Show;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function index()
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
        return view('casts.index');
    }
    public function show($slug)
    {
        $cast = Cast::where('slug', $slug)->first();

        SEOMeta::setTitle($cast->name. ' filma me Titra Shqip HD - Filma24');
        SEOMeta::setDescription($cast->name. ' filma me Titra Shqip HD - Filma24 Shiko dhe shkarko filma me titra shqip FALAS!');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addMeta('article:published_time', $cast->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('og:locale', 'en_US', 'property');
        SEOMeta::addMeta('og:type', 'article', 'property');
        SEOMeta::addMeta('og:url', url()->current(), 'property');
        SEOMeta::addMeta('article:tag', 'Netflix', 'property');
        SEOMeta::addMeta('article:section', 'Aktor', 'property');
        SEOMeta::addMeta('og:site_name', 'Filma24.pw | Filma me titra shqip HD', 'property');
        OpenGraph::setDescription('Shiko dhe shkarko filma me titra shqip FALAS!');
        OpenGraph::setTitle($cast->name. ' filma me Titra Shqip HD - Filma24');
        OpenGraph::addImage(url(asset('storage/cast/'. $cast->poster_path)));
        OpenGraph::addImage(url(asset('storage/cast/'. $cast->poster_path)), ['height' => 290, 'width' => 185]);

        $get_movies = $cast->movies()->where('is_public', true)->paginate(12);
        $movies = MovieBladeResource::collection($get_movies);

        return view('casts.show', compact('cast', 'movies'));

    }
}
