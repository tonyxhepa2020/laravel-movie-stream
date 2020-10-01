<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_name',
        'web_url'
    ];
    public function downloadable()
    {
        return $this->morphTo();
    }
    public function delete()
    {
        return parent::delete();
    }

    public function setWebNameAttribute($value)
    {
        $this->attributes['web_name'] = ucfirst($value);
    }
}
