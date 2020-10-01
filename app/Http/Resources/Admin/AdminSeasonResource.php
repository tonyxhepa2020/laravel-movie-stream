<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminSeasonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tmdb_id' => $this->tmdb_id,
            'name' => $this->name,
            'poster_path' => $this->poster_path,
            'season_number' => $this->season_number,
            'slug' => $this->slug,
            'serie' => new AdminSerieResource($this->serie),
            'serie_id' => $this->serie_id
        ];
    }
}
