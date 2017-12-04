<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;

class Grupos extends Controller {
    
    public $grupo = 'Administradores';
    
    // lista
    public function listar( $msg = false ) {

        // verifica se o usuario tem permissão
        if( !$this->hasPermission( $this->grupo )) {
            abort( 404 );            
        }
        $grupos = Grupo::all();
        return view( 'grupos/grid', [ 'grupos' => $grupos, 'msg' => $msg, 'exibirForm' => false ] );
    }

    // cadastra usuario
    public function cadastrar( $msg = false ) {

        // retorna a view
        return redirect()->to( '/admin/grupos')
                         ->with( 'msgForm', $msg )
                         ->with( 'exibirForm', true );
    }

    // altera usuario
    public function alterar( $idGrupo ) {

        // pega o grupo
        $grupo = Grupo::find( $idGrupo );

        // verifica se existe o grupo
        if( !$grupo ) {
            abort( 404 );
        }

        // retorna a view
        return redirect()->to( '/admin/grupos')
                         ->with( 'grupo', $grupo )
                         ->with( 'exibirForm', true );
    }

    // exclui usuario
    public function excluir( $idGrupo ) {

        // pega o grupo
        $grupo = Grupo::find( $idGrupo );

        // verifica se existe o grupo
        if( !$grupo ) {
            abort( 404 );
        }

        // deleta o grupo
        $del = $grupo->delete();

        // redireciona
        return redirect()->to( '/admin/grupos')
                         ->with( 'msg', $del ?
                                 'Grupo deletado com sucesso!' : 'Não foi possivel deletar o grupo no momento!')
                         ->with( 'tipo', $del ? 'light' : 'warning' );        
    }

    // exclui usuario
    public function salvar( Request $request ) {

        // verifica se é uma alteração
        if( $request->idGrupo ) {

            // busca o grupo
            $grupo = Grupo::find( $request->idGrupo );
        }  else $grupo = new Grupo;

        // nascimento
        $grupo->nome = $request->nome;
        $grupo->entidade = $request->entidade;

        // salva
        if( $grupo->save() ) {

            return redirect()->to( '/admin/grupos')
                             ->with( 'msg', $request->idGrupo ?
                                     'Grupo alterado com sucesso!' : 'Grupo cadastrado com sucesso!')
                             ->with( 'tipo', 'success' );
        } else {
            return redirect()->to( '/admin/grupos')
                             ->with( 'msg', $request->idGrupo ?
                                     'Não foi possivel salvar as alterações no grupo no momento.' : 
                                     'Não foi possivel cadastrar o grupo no momento.')
                             ->with( 'tipo', 'warning' );
        }
    }
}
