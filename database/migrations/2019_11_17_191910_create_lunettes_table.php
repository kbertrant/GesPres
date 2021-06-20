<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLunettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunettes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pres_id');
            $table->unsignedBigInteger('cen_id');
            $table->unsignedBigInteger('per_id');
            $table->string('num_emp');
            $table->string('prix_emp');
            $table->date('date_emp');
            $table->date('date_fin');
            $table->string('etat_emp');
            $table->timestamps();
            $table->foreign('pres_id')->references('id')->on('users');
            $table->foreign('per_id')->references('id')->on('personnels');
            $table->foreign('cen_id')->references('id')->on('centres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunettes');
    }
}
