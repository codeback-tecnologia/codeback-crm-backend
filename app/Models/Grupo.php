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

    public function users() {
        return $this->belongsToMany( 'App\User', 'grupos_users', 'grupo_id', 'user_id' );
    }

    public function item() {
        return $this->hasMany( 'App\Models\Item', 'grupo_id', 'idGrupo' );
    }

}
