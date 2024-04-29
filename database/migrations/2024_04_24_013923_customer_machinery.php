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
        //id_machinery
        //id_customer
        Schema::create('customer_machinery', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('machinery_id');
            $table->unsignedInteger('days');

            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('machinery_id')->references('id')->on('machinery');

            $table->primary(['customer_id', 'machinery_id']);
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
        Schema::dropIfExists('customer_machinery');
    }
};
