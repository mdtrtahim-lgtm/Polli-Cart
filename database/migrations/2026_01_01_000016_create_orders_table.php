<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipping_address_id')->constrained('addresses');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('delivery_fee', 12, 2)->default(0);
            $table->decimal('total', 12, 2);
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('set null');
            $table->string('payment_method'); // sslcommerz, bkash, nagad, cod
            $table->enum('payment_status', ['pending', 'processing', 'paid', 'failed', 'cancelled'])->default('pending');
            $table->enum('status', ['pending', 'confirmed', 'processing', 'packed', 'out_for_delivery', 'delivered', 'cancelled', 'returned', 'refunded'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('order_number');
            $table->index('user_id');
            $table->index('status');
            $table->index('payment_status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
