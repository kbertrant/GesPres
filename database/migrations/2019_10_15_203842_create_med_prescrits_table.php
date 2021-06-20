<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedPrescritsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('med_prescrits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ord_id');
            $table->unsignedBigInteger('med_id');
            $table->string('mp_condition');
            $table->string('mp_prise');
            $table->string('mp_type');
            $table->string('mp_fois');
            $table->string('mp_jour');
            $table->string('mp_periode');
            $table->string('mp_duree');
            $table->string('mp_price');
            $table->string('mp_qte');
            $table->string('mp_total');
            $table->string('mp_posologie');
            $table->timestamps();
            $table->foreign('ord_id')->references('ord_id')->on('ordonnances');
            $table->foreign('med_id')->references('med_id')->on('medicaments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('med_prescrits');
    }
}
