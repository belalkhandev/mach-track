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
        Schema::create('package_category_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('packages')->cascadeOnDelete();
            $table->foreignId('package_category_id')->constrained('package_categories')->cascadeOnDelete();
            $table->double('price', 8, 2)->nullable();
            $table->double('sale_price', 8, 2)->nullable();
            $table->double('discount', 8, 2)->nullable();
            $table->enum('discount_type', config('enums.discount_types'))->nullable();
            $table->double('discount_amount', 8, 2)->nullable();
            $table->integer('purchases')->default(0);
            $table->enum('status', config('enums.package_statuses'))->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_category_packages');
    }
};
