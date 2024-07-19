<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'rates';

    function generateRandomColor() {
        // Generate random values for red, green, and blue components
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);

        // Convert the RGB values to a hexadecimal string
        $hex = sprintf("#%02x%02x%02x", $red, $green, $blue);

        return $hex;
    }
}
