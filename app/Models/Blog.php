<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'author',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(\App\Models\BlogImage::class)->orderBy('sort_order');
    }

    public function coverImage()
    {
        return $this->hasOne(\App\Models\BlogImage::class)->where('is_cover', true);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\BlogComment::class)->latest();
    }
}
