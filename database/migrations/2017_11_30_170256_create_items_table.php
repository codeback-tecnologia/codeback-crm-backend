<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens', function (Blueprint $table) {
            $table->increments('idItem');
            $table->string('nome');
            $table->string('end_point');
            $table->integer( 'ordem' );
            $table->integer( 'componente_id' );
            $table->integer( 'grupo_id' );
            $table->timestamps();
            $table->foreign('grupo_id')->references('idGrupo')->on('grupos');
            $table->foreign('componente_id')->references('idComponente')->on('componentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itens');
    }
}
