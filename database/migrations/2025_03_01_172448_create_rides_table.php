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
            Schema::create('rides', function (Blueprint $table) {
                $table->id();
                $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
                $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled');
                $table->timestamp('start_time')->nullable();
                $table->timestamp('end_time')->nullable();
                $table->string('pickup_location')->nullable();
                $table->string('dropoff_location')->nullable();
                $table->decimal('fare', 10, 2)->nullable();
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
        Schema::dropIfExists('rides');
    }
};
