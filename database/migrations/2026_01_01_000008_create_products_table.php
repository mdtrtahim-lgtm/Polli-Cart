<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('brand')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->decimal('sale_price', 12, 2)->nullable();
            $table->decimal('cost_price', 12, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('low_stock_threshold')->default(10);
            $table->string('unit')->default('piece');
            $table->decimal('weight', 8, 2)->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('best_seller')->default(false);
            $table->boolean('new_product')->default(false);
            $table->boolean('flash_sale')->default(false);
            $table->boolean('status')->default(true);
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index('slug');
            $table->index('sku');
            $table->index('category_id');
            $table->index('status');
            $table->index('featured');
            $table->index('best_seller');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
