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
        Schema::create('buisiness', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_asset_id')->constrained('financial_assets')->onDelete('cascade');
            $table->string('business_name');
            $table->string('industry')->nullable();
            $table->decimal('revenue', 15, 2)->nullable();
            $table->decimal('ownership_percentage', 5, 2);
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
        Schema::dropIfExists('buisiness');
    }
};
