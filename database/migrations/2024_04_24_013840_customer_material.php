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
        //id_material
        //id_customer
        Schema::create('customer_material', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedInteger('quantity');

            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('material_id')->references('id')->on('material');

            $table->primary(['customer_id', 'material_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('customer_material');
    }
};
