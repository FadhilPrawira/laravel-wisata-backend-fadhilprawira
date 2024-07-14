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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->integer('nominal');
            $table->string('payment_method');
            $table->integer('payment_amount');
            $table->integer('total_item');
            $table->integer('total_price');
            // Foreign key to users table
            $table->unsignedBigInteger('cashier_id');
            $table->foreign('cashier_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('cashier_name');
            // $table->boolean('is_sync')->default(false);
            $table->timestamp('transaction_time');
            $table->timestamps();
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
