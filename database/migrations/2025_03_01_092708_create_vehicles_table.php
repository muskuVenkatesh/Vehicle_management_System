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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->integer('year')->nullable();
            $table->string('vehicle_type');
            $table->string('color')->nullable();
            $table->string('license_plate')->unique();
            $table->decimal('mileage', 10, 2)->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('engine_capacity')->nullable();
            $table->integer('seating_capacity')->nullable();
            $table->boolean('availability')->default(true);
            $table->decimal('daily_rate', 10, 2);
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
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
        Schema::dropIfExists('vehicles');
    }
};
