<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_item_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('rating'); // 1-5
            $table->string('title')->nullable();
            $table->text('comment')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
            $table->index('product_id');
            $table->index('user_id');
            $table->index('status');
            $table->unique(['product_id', 'order_item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
