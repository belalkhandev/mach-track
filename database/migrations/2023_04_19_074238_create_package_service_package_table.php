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
        Schema::create('package_service_package', function (Blueprint $table) {
            $table->foreignId('package_id')->constrained('packages')->cascadeOnDelete();
            $table->foreignId('package_service_id')->constrained('package_services')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_service_package');
    }
};
