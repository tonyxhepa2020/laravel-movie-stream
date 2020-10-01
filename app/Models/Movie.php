<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Movie extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;

    protected $dates = ['expired_at'];

    protected $fillable = [
        'tmdb_id',
        'title',
        'runtime',
        'release_date',
        'lang',
        'rating',
        'overview',
        'poster_path',
        'video_format',
        'is_public',
        'backdrop_path',
        'slug'
    ];

    public $asYouType = true;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array =  [
            'id' => $this->id,
            'title'    => $this->title
        ];
        return $array;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function scopePublished($query, $value)
    {
        return $query->where('is_public', $value);
    }

    public function latest($column = 'created_at')
    {
        return $this->orderBy($column, 'desc');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }
    public function casts()
    {
        return $this->belongsToMany(Cast::class, 'cast_movie');
    }

    public function embeds()
    {
        return $this->morphMany(EmbedUrl::class, 'embedable');
    }
    public function watchs()
    {
        return $this->morphMany(WatchUrl::class, 'watchable');
    }
    public function downloads()
    {
        return $this->morphMany(DownloadUrl::class, 'downloadable');
    }
    public function trailers()
    {
        return $this->morphMany(TrailerUrl::class, 'trailerable');
    }
}
