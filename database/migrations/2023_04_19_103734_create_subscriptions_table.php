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
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('package_category_package_id')->constrained('package_category_packages')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('payment_status', config('enums.payment_statuses'))->default('pending');
            $table->boolean('is_auto_renewal')->default(false);
            $table->foreignId('original_subscription_id')->nullable()->constrained('subscriptions')->cascadeOnDelete();
            $table->enum('status', config('enums.subscription_statuses'))->default('pending');
            $table->timestamps();
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
