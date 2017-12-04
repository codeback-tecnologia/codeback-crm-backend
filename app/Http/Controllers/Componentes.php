<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Componente;

class Componentes extends Controller {
    
    public $grupo = 'Administradores';
    
    // lista
    public function listar( $msg = false ) {

        // verifica se o usuario tem permissão
        if( !$this->hasPermission( $this->grupo )) {
            abort( 404 );            
        }
        $componentes = Componente::all();
        return view( 'componentes/grid', [ 'componentes' => $componentes, 'msg' => $msg, 'exibirForm' => false ] );
    }

    // cadastra usuario
    public function cadastrar( $msg = false ) {

        // retorna a view
        return redirect()->to( '/admin/componentes')
                         ->with( 'msgForm', $msg )
                         ->with( 'exibirForm', true );
    }

    // altera usuario
    public function alterar( $idComponente ) {

        // pega o componente
        $componente = Componente::find( $idComponente );

        // verifica se existe o componente
        if( !$componente ) {
            abort( 404 );
        }

        // retorna a view
        return redirect()->to( '/admin/componentes')
                         ->with( 'componente', $componente )
                         ->with( 'exibirForm', true );
    }

    // exclui usuario
    public function excluir( $idComponente ) {

        // pega o componente
        $componente = Componente::find( $idComponente );

        // verifica se existe o componente
        if( !$componente ) {
            abort( 404 );
        }

        // deleta o componente
        $del = $componente->delete();

        // redireciona
        return redirect()->to( '/admin/componentes')
                         ->with( 'msg', $del ?
                                 'Componente deletado com sucesso!' : 'Não foi possivel deletar o componente no momento!')
                         ->with( 'tipo', $del ? 'light' : 'warning' );        
    }

    // exclui usuario
    public function salvar( Request $request ) {

        // verifica se é uma alteração
        if( $request->idComponente ) {

            // busca o componente
            $componente = Componente::find( $request->idComponente );
        }  else $componente = new Componente;

        // nome
        $componente->nome = $request->nome;

        // salva
        if( $componente->save() ) {

            return redirect()->to( '/admin/componentes')
                             ->with( 'msg', $request->idComponente ?
                                     'Componente alterado com sucesso!' : 'Componente cadastrado com sucesso!')
                             ->with( 'tipo', 'success' );
        } else {
            return redirect()->to( '/admin/componentes')
                             ->with( 'msg', $request->idComponente ?
                                     'Não foi possivel salvar as alterações no componente no momento.' : 
                                     'Não foi possivel cadastrar o componente no momento.')
                             ->with( 'tipo', 'warning' );
        }
    }
}
