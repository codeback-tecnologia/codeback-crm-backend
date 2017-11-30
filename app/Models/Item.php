<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    // tabela
    protected $table = 'itens';

    // idDesenvolvedor
    protected $primaryKey = 'idItem';

    // nome
    protected $fillable = [ 'nome', 'end_point', 'ordem', 'grupo_id', 'componente_id' ];

    public function grupo() {
        return $this->belongsTo( 'App\Models\Grupo', 'grupo_id', 'idGrupo' );
    }

    public function componente() {
        return $this->belongsTo( 'App\Models\Componente', 'componente_id', 'idComponente' );
    }
}
