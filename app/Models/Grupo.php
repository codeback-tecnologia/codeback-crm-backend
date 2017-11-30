<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model {

    // tabela
    protected $table = 'grupos';

    // idDesenvolvedor
    protected $primaryKey = 'idGrupo';

    // nome
    protected $fillable = [ 'nome', 'entidade' ];

    public function user() {
        return $this->hasMany( 'App\User' );
    }

    public function item() {
        return $this->hasMany( 'App\Models\Item', 'grupo_id', 'idGrupo' );
    }

}
