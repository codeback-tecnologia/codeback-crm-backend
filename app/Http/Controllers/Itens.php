<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Componente;
use App\Models\Item;

class Itens extends Controller {
    
    public $grupo = 'Administradores';
    
    // lista
    public function listar( $msg = false ) {

        // verifica se o usuario tem permissão
        if( !$this->hasPermission( $this->grupo )) {
            abort( 404 );            
        }
        $itens = Item::all();
        return view( 'itens/grid', [ 'itens' => $itens, 'msg' => $msg, 'exibirForm' => false ] );
    }

    // cadastra usuario
    public function cadastrar( $msg = false ) {

        // grupos
        $grupos = Grupo::all();

        // componentes
        $componentes = Componente::all();

        // retorna a view
        return redirect()->to( '/admin/itens')
                         ->with( 'grupos', $grupos )
                         ->with( 'componentes', $componentes )
                         ->with( 'msgForm', $msg )
                         ->with( 'exibirForm', true );
    }

    // altera usuario
    public function alterar( $idItem ) {

        // pega o item
        $item = Item::find( $idItem );

        // verifica se existe o item
        if( !$item ) {
            abort( 404 );
        }

        // grupos
        $grupos = Grupo::all();

        // componentes
        $componentes = Componente::all();

        // retorna a view
        return redirect()->to( '/admin/itens')
                         ->with( 'grupos', $grupos )
                         ->with( 'componentes', $componentes )
                         ->with( 'item', $item )
                         ->with( 'exibirForm', true );
    }

    // exclui usuario
    public function excluir( $idItem ) {

        // pega o item
        $item = Item::find( $idItem );

        // verifica se existe o item
        if( !$item ) {
            abort( 404 );
        }

        // deleta o item
        $del = $item->delete();

        // redireciona
        return redirect()->to( '/admin/itens')
                         ->with( 'msg', $del ?
                                 'Item deletado com sucesso!' : 'Não foi possivel deletar o item no momento!')
                         ->with( 'tipo', $del ? 'light' : 'warning' );        
    }

    // exclui usuario
    public function salvar( Request $request ) {

        // verifica se é uma alteração
        if( $request->idItem ) {

            // busca o item
            $item = Item::find( $request->idItem );
        }  else $item = new Item;

        // nascimento
        $item->nome = $request->nome;
        $item->end_point = $request->end_point;
        $item->ordem = $request->ordem;
        $item->grupo_id = $request->grupo;
        $item->componente_id = $request->componente;

        // salva
        if( $item->save() ) {

            return redirect()->to( '/admin/itens')
                             ->with( 'msg', $request->idItem ?
                                     'Item alterado com sucesso!' : 'Item cadastrado com sucesso!')
                             ->with( 'tipo', 'success' );
        } else {
            return redirect()->to( '/admin/itens')
                             ->with( 'msg', $request->idItem ?
                                     'Não foi possivel salvar as alterações no item no momento.' : 
                                     'Não foi possivel cadastrar o item no momento.')
                             ->with( 'tipo', 'warning' );
        }
    }
}
