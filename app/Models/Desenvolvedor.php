<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model {

    // tabela
    protected $table = 'desenvolvedores';

    // idDesenvolvedor
    protected $primaryKey = 'idDesenvolvedor';

    // nome
    protected $fillable = [ 'nascimento', 'apelido', 'user_id' ];

    public function user() {
        return $this->belongsTo( 'App\User' );
    }

}
