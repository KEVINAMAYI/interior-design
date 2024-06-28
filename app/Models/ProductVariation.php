<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function images(){
        return $this->hasMany(ProductVariationImage::class);
    }

    public function variation(){
        return Variation::where('id',$this->variation_id)->first();
    }
}
