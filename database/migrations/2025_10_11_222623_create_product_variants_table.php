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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel products
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            
            $table->string('variant_size');
            $table->string('variant_color');
            $table->integer('stock');
            $table->decimal('price_override', 10, 2)->nullable(); // Opsional, bisa null
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};