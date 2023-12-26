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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('machine_id')->nullable()->constrained('machines')->cascadeOnDelete();
            $table->foreignId('floor_id')->nullable()->constrained('floors')->cascadeOnDelete();
            $table->string('line_no')->nullable();
            $table->enum('status', \App\Enums\MachineStatuses::values())->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
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
        Schema::dropIfExists('trackings');
    }
};
