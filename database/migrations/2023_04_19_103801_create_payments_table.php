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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->morphs('purchasable');
            $table->enum('payment_gateway', config('payment_gateways'))->nullable();
            $table->string('payment_gateway_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
