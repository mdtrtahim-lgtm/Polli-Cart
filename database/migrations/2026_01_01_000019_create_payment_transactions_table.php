<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('payment_method');
            $table->decimal('amount', 12, 2);
            $table->enum('status', ['pending', 'processing', 'paid', 'failed', 'cancelled', 'refunded', 'partially_refunded'])->default('pending');
            $table->string('transaction_id')->nullable()->unique();
            $table->json('response_data')->nullable();
            $table->timestamps();
            $table->index('order_id');
            $table->index('status');
            $table->index('transaction_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
