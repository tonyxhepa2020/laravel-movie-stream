<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSerieRequest;
use App\Http\Resources\Admin\AdminSerieResource;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiAdminSerieController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->per_page;
        if ($request->search) {
            $series = Serie::search($request->search)
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        } else {
            $series = Serie::orderBy('created_at', 'desc')->paginate($per_page);
        }
        return AdminSerieResource::collection($series);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illumainate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSerieRequest $request)
    {

        $contents = file_get_contents($request->poster_path);
        $name = substr($request->poster_path, strrpos($request->poster_path, '/') + 1);
        $save = Storage::put('public/serie/'.$name, $contents);
        if ($save){
            $serie = new Serie;
            $serie->tmdb_id = $request->tmdb_id;
            $serie->name = $request->name;
            $serie->created_year = $request->created_year;
            $serie->poster_path = '/'.$name;
            $serie->save();

            return response('Created');
        }else{
            return response('Not created');
        }


    }

    public function show($id)
    {
        $serie = Serie::where('id', $id)->first();

        return new AdminSerieResource($serie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $serie = Serie::where('slug', $slug)->first();
        $name = substr($request->poster_path, strrpos($request->poster_path, '/') + 1);
        if ('/'.$name === $serie->poster_path){
            $serie->update([
                'tmdb_id' => $request->tmdb_id,
                'name' => $request->name,
                'created_year' => $request->created_year,
                'poster_path' => $name,
            ]);
            return response('Serie Updated Successfully');
        }else{
            $contents = file_get_contents($request->poster_path);
            Storage::delete('public/serie/'. $serie->poster_path);
            $save = Storage::put('public/serie/'.$name, $contents);
            if ($save){
                $serie->update([
                    'tmdb_id' => $request->tmdb_id,
                    'name' => $request->name,
                    'created_year' => $request->created_year,
                    'poster_path' => $name,
                ]);
                return response('Serie Updated and File Stored');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $serie = Serie::where('slug', $slug)->first();
        Storage::delete('public/serie/'. $serie->poster_path);
        if ($serie->seasons){
            foreach ($serie->seasons as $season){
                Storage::delete('public/serie/season/'. $season->poster_path);
            }
        }
        $serie->delete();
        return response('u fshije');
    }
}
