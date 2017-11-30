<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model {

    // tabela
    protected $table = 'componentes';

    // idDesenvolvedor
    protected $primaryKey = 'idComponente';

    // nome
    protected $fillable = [ 'nome' ];

    public function item() {
        return $this->hasMany( 'App\Models\Item' );
    }
}
