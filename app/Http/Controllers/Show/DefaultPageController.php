<?php

namespace App\Http\Controllers\Show;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class DefaultPageController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function dmca()
    {
        return view('pages.dmca');
    }
    public function privacy()
    {
        return view('pages.privacy');
    }
}
