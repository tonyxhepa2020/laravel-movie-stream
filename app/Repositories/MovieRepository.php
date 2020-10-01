<?php
namespace App\Repositories;

use App\Models\Cast;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MovieRepository
{
    private $api_key = "8a11aac3fb4ef5f1f9607ee7e0329793";
    public function store($tmdb_id)
    {
        if (!Movie::where('tmdb_id', $tmdb_id)->exists()){
            $tmdb_movie = Http::get('https://api.themoviedb.org/3/movie/'. $tmdb_id .'?api_key='. $this->api_key .'&language=en-US')
                ->json();

            if ($tmdb_movie){
                $img_url = 'https://image.tmdb.org/t/p/w185'.$tmdb_movie['poster_path'];
                $contents = file_get_contents($img_url);
                $name = substr($img_url, strrpos($img_url, '/') + 1);
                Storage::put('public/movie/'.$name, $contents);

                $movie = Movie::create([
                    'tmdb_id' => $tmdb_movie['id'],
                    'title' => $tmdb_movie['title'].' '.  Carbon::parse($tmdb_movie['release_date'])->format('Y'),
                    'runtime' => $tmdb_movie['runtime'],
                    'rating' => $tmdb_movie['vote_average'],
                    'release_date' => $tmdb_movie['release_date'],
                    'lang' => $tmdb_movie['original_language'],
                    'video_format' => 'HD',
                    'is_public' => false,
                    'overview' => $tmdb_movie['overview'],
                    'poster_path' => '/'.$name,
                    'backdrop_path' => $tmdb_movie['backdrop_path']
                ]);

                if ($tmdb_movie['genres']){
                    $tmdb_genres = $tmdb_movie['genres'];
                    $tmdb_genres_id = collect($tmdb_genres)->pluck('id');
                    $genres = Genre::whereIn('tmdb_id',$tmdb_genres_id)->get();
                    $movie->genres()->attach($genres);
                }
                if ($tmdb_movie['video']){
                    $movie->trailers()->create([
                        'web_name' => 'triler',
                        'web_url' => 'https://www.youtube.com/embed/'. $tmdb_movie['video'],
                    ]);
                }
            }
            $this->store_cast($tmdb_id);
            return response()->json('Movie Created Successfully');

        }else {
            return response()->json('Movie Not Created');
        }
    }

    public function store_cast($id)
    {
        $tmdb_cast_res = Http::get('https://api.themoviedb.org/3/movie/'. $id .'/credits?api_key='. $this->api_key)
            ->json()['cast'];
        $only_tmdb_cast = array_slice($tmdb_cast_res, 0, 5);
        if ($only_tmdb_cast){
            foreach ($only_tmdb_cast as $tcr){
                if (!Cast::where('tmdb_id',$tcr['id'])->first()){
                    if ($tcr['profile_path']){
                        $url = "https://image.tmdb.org/t/p/w92". $tcr['profile_path'];
                        $contents = file_get_contents($url );
                        $name = substr($url, strrpos($url, '/') + 1);
                        Storage::put('public/cast/'.$name, $contents);
                        $cast = new Cast;
                        $cast->tmdb_id = $tcr['id'];
                        $cast->name = $tcr['name'];
                        $cast->poster_path = '/'.$name;
                        $cast->save();
                    }else{
                        $cast = new Cast;
                        $cast->tmdb_id = $tcr['id'];
                        $cast->name = $tcr['name'];
                        $cast->save();
                    }
                }
            }
        }
        $tmdb_cast = collect($tmdb_cast_res)->pluck('id');

        $movie = Movie::where('tmdb_id', $id)->first();
        $casts = Cast::whereIn('tmdb_id', $tmdb_cast)->get();
        if (!empty($casts)){
            $movie->casts()->attach($casts);
        }
        $tmdb_video_res = Http::get('https://api.themoviedb.org/3/movie/'. $id .'/videos?api_key='. $this->api_key)
            ->json()['results'];
        if (!empty($tmdb_video_res && $tmdb_video_res[0]['site'] == 'YouTube')){
            $movie->trailers()->create([
                'web_name' => 'trailer',
                'web_url' => 'https://www.youtube.com/embed/'. $tmdb_video_res[0]['key'],
            ]);
        }

    }
    public function update($movie)
    {
        if (request()->has('genres')){
            $movie->genres()->sync(request()->genres);
        }
        if (request()->has('casts')){
            $movie->casts()->sync(request()->casts);
        }
        if (request()->has('tags')){
            $movie->tags()->sync(request()->tags);
        }

        $name = substr(request()->poster_path, strrpos(request()->poster_path, '/') + 1);
        if ('/'.$name === $movie->poster_path){

            $movie->update([
                'tmdb_id' => request()->tmdb_id,
                'title' => request()->title,
                'runtime' => request()->runtime,
                'rating' => request()->rating,
                'release_date' => request()->release_date,
                'lang' => request()->lang,
                'video_format' => request()->video_format,
                'is_public' => request()->is_public,
                'overview' => request()->overview,
                'poster_path' => '/'.$name,
                'backdrop_path' => request()->backdrop_path,
                'slug' => $movie->slug.'-me-titra-shqip'
            ]);
            return response('Movie Updated ');
        }else{
            $contents = file_get_contents(request()->poster_path);
            Storage::delete('public/movie/'. $movie->poster_path);
            $save = Storage::put('public/movie/'.$name, $contents);
            if ($save){
                $movie->update([
                    'tmdb_id' => request()->tmdb_id,
                    'title' => request()->title,
                    'runtime' => request()->runtime,
                    'rating' => request()->rating,
                    'release_date' => request()->release_date,
                    'lang' => request()->lang,
                    'video_format' => request()->video_format,
                    'is_public' => request()->is_public,
                    'overview' => request()->overview,
                    'poster_path' => '/'.$name,
                    'backdrop_path' => request()->backdrop_path,
                    'slug' => $movie->slug.'-me-titra-shqip'
                ]);
                return true;
            }
        }

        return false;
    }
}
