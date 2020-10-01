<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDownloadRequest;
use App\Http\Requests\CreateEmbedRequest;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\CreateTrailerRequest;
use App\Http\Requests\CreateWatchRequest;
use App\Http\Resources\Admin\AdminDownloadResource;
use App\Http\Resources\Admin\AdminEmbedResource;
use App\Http\Resources\Admin\AdminMovieResource;
use App\Http\Resources\Admin\AdminTrailerResource;
use App\Http\Resources\Admin\AdminWatchResource;
use App\Models\Genre;
use App\Models\Movie;
use App\Repositories\MovieRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiAdminMovieController extends Controller
{
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function index(Request $request)
    {
        $per_page = $request->per_page;
        if ($request->search) {
            $movies = Movie::search($request->search)
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        } else {
            $movies = Movie::orderBy('created_at', 'desc')->paginate($per_page);
        }
        return AdminMovieResource::collection($movies);
    }

    public function store(CreateMovieRequest $request)
    {
       return $this->movieRepository->store($request->tmdb_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->first();

        if ($request->has('genres')) {
            $movie->genres()->sync($request->genres);
        }
        if ($request->has('casts')) {
            $movie->casts()->sync($request->casts);
        }
        if ($request->has('tags')) {
            $movie->tags()->sync($request->tags);
        }

        $name = substr($request->poster_path, strrpos($request->poster_path, '/') + 1);
        if ('/' . $name === $movie->poster_path) {

            $movie->update([
                'tmdb_id' => $request->tmdb_id,
                'title' => $request->title,
                'runtime' => $request->runtime,
                'rating' => $request->rating,
                'release_date' => $request->release_date,
                'lang' => $request->lang,
                'video_format' => $request->video_format,
                'is_public' => $request->is_public,
                'overview' => $request->overview,
                'poster_path' => '/' . $name,
                'backdrop_path' => $request->backdrop_path,
                'slug' => $movie->slug . '-me-titra-shqip'
            ]);
            return response('Movie Updated ');
        } else {
            $contents = file_get_contents($request->poster_path);
            Storage::delete('public/movie/' . $movie->poster_path);
            $save = Storage::put('public/movie/' . $name, $contents);
            if ($save) {
                $movie->update([
                    'tmdb_id' => $request->tmdb_id,
                    'title' => $request->title,
                    'runtime' => $request->runtime,
                    'rating' => $request->rating,
                    'release_date' => $request->release_date,
                    'lang' => $request->lang,
                    'video_format' => $request->video_format,
                    'is_public' => $request->is_public,
                    'overview' => $request->overview,
                    'poster_path' => '/' . $name,
                    'backdrop_path' => $request->backdrop_path,
                    'slug' => $movie->slug . '-me-titra-shqip'
                ]);
                return response('Movie Updated and File Stored');
            }
        }

        return response('Movie not Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        Storage::delete('public/movie/' . $movie->poster_path);
        if ($movie->seasons) {
            foreach ($movie->seasons as $season) {
                Storage::delete('public/movie/' . $season->poster_path);
            }
        }
        $movie->delete();
        return response('Movie Deleted');
    }
    public function addWatchUrl($slug, CreateWatchRequest $request)
    {
        $movie = Movie::where('slug', $slug)->first();

        $movie->watchs()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);

        return response('Watch url Added ');
    }
    public function addTrailerUrl($slug, CreateTrailerRequest $request)
    {
        $movie = Movie::where('slug', $slug)->first();

        $movie->trailers()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);

        return response('Trailer url Added ');
    }
    public function addEmbedUrl($slug, CreateEmbedRequest $request)
    {
        $movie = Movie::where('slug', $slug)->first();
        $movie->embeds()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);
        return response('Embed url Added');
    }
    public function addDownloadUrl($slug, CreateDownloadRequest $request)
    {
        $movie = Movie::where('slug', $slug)->first();
        $movie->downloads()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);
        return response('Downloaded url Added');
    }

    public function watchUrl($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        return AdminWatchResource::collection($movie->watchs);
    }
    public function downloadUrl($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        return AdminDownloadResource::collection($movie->downloads);
    }
    public function embedUrl($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        return AdminEmbedResource::collection($movie->embeds);
    }
    public function trailerUrl($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        return AdminTrailerResource::collection($movie->trailers);
    }
}
