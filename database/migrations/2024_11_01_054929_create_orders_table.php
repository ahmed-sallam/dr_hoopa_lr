<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->decimal('net_price', 10, 2);
            $table->string('payment_method')->nullable();
            $table->enum('payment_status', [
                'pending',
                'processing',
                'paid',
                'failed',
                'refunded',
                'partially_refunded'
            ])->default('pending');
            $table->string('payment_transaction_id')->nullable();
            $table->string('currency')->default('EGP'); // if needed in future
            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'cancelled',
                'refunded'
            ])->default('pending');
//            $table->string('coupon_code')->nullable(); // for later
            $table->ipAddress('customer_ip')->nullable(); // For security tracking
            $table->softDeletes();
            $table->timestamps();

            //  indexes
            $table->index(['payment_status', 'status']);
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
