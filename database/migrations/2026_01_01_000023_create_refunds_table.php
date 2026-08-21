<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('return_request_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->string('method')->nullable();
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $table->timestamp('initiated_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->index('return_request_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
