<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->cascadeOnDelete();
            $table->foreignId('machine_model_id')->nullable()->constrained('machine_models')->cascadeOnDelete();
            $table->foreignId('floor_id')->nullable()->constrained('floors')->cascadeOnDelete();
            $table->string('line_no')->nullable();
            $table->string('machine_number')->unique()->nullable();
            $table->string('local_number')->unique()->nullable();
            $table->enum('transmission_type', \App\Enums\TransmissionTypes::values())->nullable();
            $table->enum('status', \App\Enums\MachineStatuses::values())->nullable();
            $table->boolean('is_rented')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machines');
    }
};
