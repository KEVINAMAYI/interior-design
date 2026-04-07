<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{

    protected $fillable = [
        'blog_id',
        'image_path',
        'sort_order',
        'is_cover',
    ];
    public function blog()
    {
        return $this->belongsTo(\App\Models\Blog::class);
    }
}
