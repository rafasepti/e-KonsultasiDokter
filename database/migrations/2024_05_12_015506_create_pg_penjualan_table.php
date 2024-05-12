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
        Schema::create('pg_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('masked_card', 100);
            $table->string('approval_code', 100);
            $table->string('bank', 100);
            $table->string('eci', 100);
            $table->string('channel_response_code', 100);
            $table->string('channel_response_message', 100);
            $table->string('transaction_time', 100);
            $table->string('currency', 100);
            $table->string('order_id', 100);
            $table->string('payment_type', 100);
            $table->string('signature_key', 100);
            $table->string('status_code', 100);
            $table->string('transaction_id', 100);
            $table->string('transaction_status', 100);
            $table->string('fraud_status', 100);
            $table->dateTime('settlement_time');
            $table->string('status_message', 100);
            $table->string('merchant_id', 100);
            $table->string('card_type', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pg_penjualan');
    }
};
