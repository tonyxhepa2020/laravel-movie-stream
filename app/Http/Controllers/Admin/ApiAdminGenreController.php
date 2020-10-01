<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGenreRequest;
use App\Http\Resources\Admin\AdminGenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class ApiAdminGenreController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->per_page;
        if ($request->search){
            $genres = Genre::search($request->search)->orderBy('created_at', 'desc')->paginate($per_page);
        } else {
            $genres = Genre::orderBy('created_at', 'desc')->paginate($per_page);
        }
        return AdminGenreResource::collection($genres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illumainate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGenreRequest $request)
    {
        $genre = new Genre;
        $genre->tmdb_id = $request->tmdb_id;
        $genre->title = $request->title;
        $genre->save();

        return response()->json('New Genre Created Successfully');

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
        $genre = Genre::where('slug', $slug)->first();
        $genre->update([
            'tmdb_id' => $request->tmdb_id,
            'title' => $request->title,
        ]);
        return response()->json('Genre Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $genre = Genre::where('slug', $slug)->first();
        $genre->delete();

        return response('Genre Deleted Successfully');
    }
}
