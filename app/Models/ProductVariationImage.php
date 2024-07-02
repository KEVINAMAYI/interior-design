<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product_variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
