<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index('slug');
            $table->index('status');
            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
