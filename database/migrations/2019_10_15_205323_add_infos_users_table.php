<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfosUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->nullable()->default('default.png');
            $table->string('phone')->nullable()->after('image');
            $table->string('genre')->nullable()->after('phone');
            $table->boolean('status')->nullable();
            $table->string('cen_id')->nullable();
            $table->string('poste')->nullable();
            $table->string('type_user')->nullable();

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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'image', 'phone', 'genre','user_id','status','num_enfant','type_user'
            ]);
        });
    }
}
