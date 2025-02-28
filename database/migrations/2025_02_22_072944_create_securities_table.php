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
        Schema::create('securities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_asset_id')->constrained('financial_assets')->onDelete('cascade');
            $table->enum('security_type', ['stock', 'bond', 'mutual_fund']);
            $table->string('institution');
            $table->integer('number_of_units');
            $table->decimal('price_per_unit', 10, 2);
            $table->date('purchase_date');
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
        Schema::dropIfExists('securities');
    }
};
