<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Season extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['slug','name', 'tmdb_id', 'season_number', 'poster_path'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%');
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
    public function episodes()
    {
        return $this->hasMany(Episode::class)->latest();
    }
}
