<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GruposUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('grupos_users', function (Blueprint $table) {
            $table->increments('idGrupoUser');
            $table->integer( 'grupo_id' );
            $table->integer( 'user_id' );
            $table->foreign('grupo_id')->references('idGrupo')->on('grupos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos_users');
    }
}
