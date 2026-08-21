<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['percentage', 'fixed']);
            $table->decimal('discount', 12, 2);
            $table->decimal('min_order', 12, 2)->nullable();
            $table->decimal('max_discount', 12, 2)->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('usage_limit')->nullable();
            $table->integer('per_customer_limit')->default(1);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->index('code');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
