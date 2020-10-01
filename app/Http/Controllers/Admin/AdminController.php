<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Serie;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
//    public function test()
//    {
//        auth()->user()->assignRole('writer', 'admin');
//        return redirect()->route('home');
//    }

    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        $users = User::all();

        return response()->json($users);
    }
    public function movies()
    {
        $movies = Movie::all();

        return response()->json($movies);
    }
    public function series()
    {
        $series = Serie::all();

        return response()->json($series);
    }
    public function genres()
    {
        $genres = Genre::all();

        return response()->json($genres);
    }
    public function tags()
    {
        $tags = Tag::all();

        return response()->json($tags);
    }
    public function casts()
    {
        $casts = Cast::all();

        return response()->json($casts);
    }
}
