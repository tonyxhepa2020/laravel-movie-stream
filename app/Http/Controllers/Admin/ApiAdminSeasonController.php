<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSeasonRequest;
use App\Http\Resources\Admin\AdminSeasonResource;
use App\Http\Resources\Admin\AdminSerieResource;
use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiAdminSeasonController extends Controller
{
    public function index(Request $request, $serie_id)
    {
        $per_page = $request->per_page;
        if ($request->search) {
            $seasons = Season::where('serie_id', $serie_id)->search($request->search)
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        } else {
            $seasons = Season::where('serie_id', $serie_id)->orderBy('created_at', 'desc')->paginate($per_page);
        }
        return AdminSeasonResource::collection($seasons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illumainate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSeasonRequest $request, $slug)
    {
        $serie = Serie::where('slug', $slug)->first();
        $contents = file_get_contents($request->poster_path);
        $name = substr($request->poster_path, strrpos($request->poster_path, '/') + 1);
        $save = Storage::put('public/serie/season/'.$name, $contents);
        if ($save){
            $serie->seasons()->create([
                'tmdb_id' => $request->tmdb_id,
                'name' => $request->name,
                'season_number' => $request->season_number,
                'poster_path' => '/'.$name,
            ]);
            return response('Season Created Successfully');
        }else{
            return response('Not created');
        }
    }
    public function show($serie_id, $season_id)
    {
        $serie = Serie::where('id', $serie_id)->first();
        $season = $serie->seasons()->where('id', $season_id)->first();

        return new AdminSeasonResource($season);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $serie_slug, $slug)
    {
        $serie = Serie::where('slug', $serie_slug)->first();
        $season = $serie->seasons->where('slug', $slug)->first();
        $name = substr($request->poster_path, strrpos($request->poster_path, '/') + 1);
        if ('/'.$name === $season->poster_path){
            $season->update([
                'tmdb_id' => $request->tmdb_id,
                'name' => $request->name,
                'season_number' => $request->season_number,
                'poster_path' => $name,
            ]);
            return response('Updated Successfully');
        }else{
            $contents = file_get_contents($request->poster_path);
            Storage::delete('public/serie/season/'. $serie->poster_path);
            $save = Storage::put('public/serie/season/'.$name, $contents);
            if ($save){
                $season->update([
                    'tmdb_id' => $request->tmdb_id,
                    'name' => $request->name,
                    'season_number' => $request->season_number,
                    'poster_path' => '/'.$name,
                ]);
                return response('Created and File Stored');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($serie_slug, $slug)
    {
        $season = Season::where('slug', $slug)->first();
        Storage::delete('public/serie/season/'. $season->poster_path);
        $season->delete();

        return response('u fshije');
    }
}
