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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_asset_id')->constrained('financial_assets')->onDelete('cascade');
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('property_type', ['house', 'land', 'commercial']);
            $table->text('address');
            $table->decimal('estimated_value', 15, 2);
            $table->date('purchase_date');
            $table->boolean('mortgage_status')->default(false);
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
        Schema::dropIfExists('properties');
    }
};
