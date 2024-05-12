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
        Schema::create('contract_machinery', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('machinery_id');
            $table->unsignedInteger('days');

            $table->foreign('contract_id')->references('id')->on('contract')->onDelete('cascade');
            $table->foreign('machinery_id')->references('id')->on('machinery')->onDelete('cascade');

            $table->primary(['contract_id', 'machinery_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_machinery');
    }
};
