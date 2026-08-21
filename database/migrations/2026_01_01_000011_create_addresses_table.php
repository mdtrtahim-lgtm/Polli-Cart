<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('mobile');
            $table->string('division');
            $table->string('district');
            $table->string('upazila')->nullable();
            $table->string('area')->nullable();
            $table->text('address');
            $table->string('postal_code')->nullable();
            $table->enum('type', ['home', 'office', 'other'])->default('home');
            $table->boolean('default')->default(false);
            $table->timestamps();
            $table->index('user_id');
            $table->index(['user_id', 'default']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
