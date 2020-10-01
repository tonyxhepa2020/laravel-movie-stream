<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCastResource;
use App\Models\Cast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiAdminCastController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->per_page;
        if ($request->search){
            $casts = Cast::search($request->search)->orderBy('created_at', 'desc')->paginate($per_page);
        } else {
            $casts = Cast::orderBy('created_at', 'desc')->paginate($per_page);
        }
        return AdminCastResource::collection($casts);
    }
    public function store(Request $request)
    {
        if ($request->poster_path){
            $contents = file_get_contents($request->poster_path);
            $name = substr($request->poster_path, strrpos($request->poster_path, '/') + 1);
            Storage::put('public/cast/'.$name, $contents);
            $cast = new Cast;
            $cast->tmdb_id = $request->tmdb_id;
            $cast->name = $request->name;
            $cast->poster_path = '/'.$name;
            $cast->save();

            return response('New Cast Created');
        }else{
            $cast = new Cast;
            $cast->tmdb_id = $request->tmdb_id;
            $cast->name = $request->name;
            $cast->save();
            return response('New Cast Created without poster');
        }

    }

    public function update(Request $request, $slug)
    {
        $cast = Cast::where('slug', $slug)->first();
        if ($request->poster_path){
            $name = substr($request->poster_path, strrpos($request->poster_path, '/') + 1);
            if ('/'.$name === $cast->poster_path){
                $cast->update([
                    'tmdb_id' => $request->tmdb_id,
                    'name' => $request->name,
                    'poster_path' => '/'.$name
                ]);
                return response('Cast Updated');
            }else{
                $contents = file_get_contents($request->poster_path);
                Storage::delete('public/cast/'. $cast->poster_path);
                $save = Storage::put('public/cast/'.$name, $contents);

                if ($save){
                    $cast->update([
                        'tmdb_id' => $request->tmdb_id,
                        'name' => $request->name,
                        'poster_path' => '/'.$name,
                    ]);
                    return response('Updated and File Stored');
                }
            }
        } else{
            $cast->update([
                'tmdb_id' => $request->tmdb_id,
                'name' => $request->name,
                'poster_path' => null
            ]);
            return response('Updated without poster');
        }
        return response('not updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($slug)
    {
        $cast = Cast::where('slug', $slug)->first();
        Storage::delete('public/cast/'. $cast->poster_path);
        $cast->delete();

        return response('Cast has Deleted SuccessFully ');
    }

}
