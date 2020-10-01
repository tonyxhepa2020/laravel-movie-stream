<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Episode extends Model
{
    use HasFactory;
     use HasSlug;

    protected $fillable = ['tmdb_id','name', 'episode_number', 'is_public', 'overview'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name'])
            ->saveSlugsTo('slug');
    }

    public function scopeLatest($query)
    {
        return $query->where('created_at', 'desc');
    }
    public function scopePublished($query, $value)
    {
        return $query->where('is_public', $value);
    }
    public function season()
    {
        return $this->belongsTo(Season::class);
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
    public function delete()
    {
        return parent::delete();
    }
}
