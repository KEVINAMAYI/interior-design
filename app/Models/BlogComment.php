<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = [
        'blog_id',
        'author',
        'comment',
        'is_approved',
    ];

    public function blog()
    {
        return $this->belongsTo(\App\Models\Blog::class);
    }
}
