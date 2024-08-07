<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product_variations(){
        return $this->hasMany(ProductVariation::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tags');
    }

    public function deals(){
        return $this->belongsToMany(Deal::class);
    }
}
