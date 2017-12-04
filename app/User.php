<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function dev() {
        return $this->hasOne( 'App\Models\Desenvolvedor' );
    }

    public function grupos() {
        return $this->belongsToMany( 'App\Models\Grupo', 'grupos_users', 'user_id', 'grupo_id' );
    }

    public function noGrupo( $user, $grupo ) {
        return DB::select( "select * from grupos_users gu
                            inner join users u on gu.user_id = u.id
                            inner join grupos g on gu.grupo_id = g.idGrupo
                            where u.id = :id and g.nome = :grupo", [ 'id' => $user, 'grupo' => $grupo ] );
    }
}
