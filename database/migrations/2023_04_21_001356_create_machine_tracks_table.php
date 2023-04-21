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
        Schema::create('machine_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('original_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('machine_id')->nullable()->constrained('machines')->cascadeOnDelete();
            $table->foreignId('floor_id')->nullable()->constrained('floors')->cascadeOnDelete();
            $table->enum('condition', config('enums.machine_conditions'))->nullable();
            $table->text('remarks');
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_tracks');
    }
};
