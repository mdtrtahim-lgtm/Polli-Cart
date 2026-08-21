<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('sku')->unique();
            $table->decimal('price', 12, 2);
            $table->integer('stock')->default(0);
            $table->string('unit')->default('piece');
            $table->timestamps();
            $table->index('product_id');
            $table->index('sku');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
