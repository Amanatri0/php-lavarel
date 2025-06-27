<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id');

            $table->string('payment_gateway')->nullable(); // e.g., "Stripe", "Razorpay", "PayPal"
            $table->string('transaction_id')->nullable(); // returned by payment gateway
            $table->string('payment_method')->nullable(); // e.g., "card", "upi", "netbanking"
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->string('currency', 10)->default('USD');

            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled', 'refunded'])->default('pending');

            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            $table->json('meta_data')->nullable(); // gateway raw response or additional info
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
