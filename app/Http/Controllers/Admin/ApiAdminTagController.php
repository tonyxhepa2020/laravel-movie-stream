<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminTagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class ApiAdminTagController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->per_page;
        if ($request->search){
            $tags = Tag::search($request->search)->orderBy('created_at', 'desc')->paginate($per_page);
        } else {
            $tags = Tag::orderBy('created_at', 'desc')->paginate($per_page);
        }
        return AdminTagResource::collection($tags);
    }

    public function store(Request $request)
    {
        $tag = new Tag;
        $tag->tag_name = $request->tag_name;
        $tag->save();

        return response()->json('Tag Created Successfully');

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
        $tag = Tag::where('slug', $slug)->first();
        $tag->update([
            'tag_name' => $request->tag_name,
        ]);
        return response()->json('Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        $tag->delete();

        return response('u fshije');
    }
}
