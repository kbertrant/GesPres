<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('per_name');
            $table->string('per_matricule');
            $table->date('per_naiss')->nullable();
            $table->string('per_poste')->nullable();
            $table->string('per_sexe');
            $table->string('per_statut')->nullable();
            $table->string('per_classe')->nullable();
            $table->boolean('is_personnel')->default(true);
            $table->unsignedBigInteger('pro_id');
            $table->timestamps();

            $table->foreign('pro_id')->references('id')->on('personnels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnels');
    }
}
