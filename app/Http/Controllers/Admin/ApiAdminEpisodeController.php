<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDownloadRequest;
use App\Http\Requests\CreateEmbedRequest;
use App\Http\Requests\CreateEpisodeRequest;
use App\Http\Requests\CreateWatchRequest;
use App\Http\Resources\Admin\AdminDownloadResource;
use App\Http\Resources\Admin\AdminEmbedResource;
use App\Http\Resources\Admin\AdminEpisodeResource;
use App\Http\Resources\Admin\AdminSerieResource;
use App\Http\Resources\Admin\AdminWatchResource;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;

class ApiAdminEpisodeController extends Controller
{
    public function index(Request $request, $serie_id, $season_id)
    {
        $serie = Serie::findOrFail($serie_id);
        $season = $serie->seasons()->where('id', $season_id)->first();
        $per_page = $request->per_page;
        if ($request->search) {
            $episodes = $season->episodes()
                ->search($request->search)
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        } else {
            $episodes = $season->episodes()
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }
        return AdminEpisodeResource::collection($episodes);
    }

    public function store(CreateEpisodeRequest $request, $serie_id, $season_id)
    {
        $serie = Serie::findOrFail($serie_id);
        $season = $serie->seasons()->where('id', $season_id)->first();
        $season->episodes()->create([
            'tmdb_id' => $request->tmdb_id,
            'episode_number' => $request->episode_number,
            'name' => $request->name,
            'overview' => $request->overview,
        ]);
        return response('Eppisode Created Successfully');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $serie_id, $season_id, $slug)
    {
        $serie = Serie::findOrFail($serie_id);
        $season = $serie->seasons()->where('id', $season_id)->first();
        $episode = $season->episodes()->where('slug', $slug)->first();
        $episode->update([
            'tmdb_id' => $request->tmdb_id,
            'episode_number' => $request->episode_number,
            'name' => $request->name,
            'is_public' => $request->is_public,
            'overview' => $request->overview
        ]);
        return response('Eppisode Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($serie_id, $season_id, $slug)
    {
        $serie = Serie::findOrFail($serie_id);
        $season = $serie->seasons()->where('id', $season_id)->first();
        $episode = $season->episodes()->where('slug', $slug)->first();
        $episode->delete();
        return response('Eppisode Deleted Successfully');
    }

    public function addWatchUrl($slug, CreateWatchRequest $request)
    {
        $episode = Episode::where('slug', $slug)->first();

        $episode->watchs()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);

        return response('watch url Added ');
    }
    public function addEmbedUrl($slug, CreateEmbedRequest $request)
    {
        $episode = Episode::where('slug', $slug)->first();
        $episode->embeds()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);
        return response('Embed Added');
    }
    public function addDownloadUrl($slug, CreateDownloadRequest $request)
    {
        $episode = Episode::where('slug', $slug)->first();
        $episode->downloads()->create([
            'web_name' => $request->web_name,
            'web_url' => $request->web_url,
        ]);
        return response('Download Added');
    }

    public function watchUrl($slug)
    {
        $episode = Episode::where('slug', $slug)->first();
        return AdminWatchResource::collection($episode->watchs);
    }
    public function downloadUrl($slug)
    {
        $episode = Episode::where('slug', $slug)->first();
        return AdminDownloadResource::collection($episode->downloads);
    }
    public function embedUrl($slug)
    {
        $episode = Episode::where('slug', $slug)->first();
        return AdminEmbedResource::collection($episode->embeds);
    }
}
