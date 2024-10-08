<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variation_id')->nullable()->constrained();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->float('price')->nullable();
            $table->float('discounted_price')->nullable();
            $table->longText('custom_variation')->nullable();
            $table->float('discount_percentage')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
