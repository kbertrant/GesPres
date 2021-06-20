<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cen_name');
            $table->string('cen_numero');
            $table->unsignedBigInteger('vil_id');
            $table->string('contact');
            $table->timestamps();
            $table->foreign('vil_id')->references('vil_id')->on('villes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centres');
    }
}
