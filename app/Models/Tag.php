<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['slug','tag_name'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('tag_name')
            ->saveSlugsTo('slug');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['tag_name'] = ucfirst($value);
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('tag_name', 'like', '%'.$query.'%');
    }
    public function movies()
    {
        return $this->morphedByMany(Movie::class, 'taggable');
    }
}
