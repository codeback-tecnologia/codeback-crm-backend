<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Desenvolvedor;
use App\Models\Grupo;

class Desenvolvedores extends Controller {

    public function listar( $msg = false ) {
        $desenvolvedores = Desenvolvedor::all();
        return view( 'desenvolvedores/grid', [ 'desenvolvedores' => $desenvolvedores, 'msg' => $msg, 'exibirModal' => false ] );
    }

    // cadastra usuario
    public function cadastrar( $msg = false ) {

        // busca os usuarios
        $users = User::all();

        // retorna a view
        return redirect()->to( '/admin/desenvolvedores')
                         ->with( 'entidade', 'desenvolvedor' )
                         ->with( 'msgForm', $msg )
                         ->with( 'exibirModal', true );
    }

    // altera usuario
    public function alterar( $idDesenvolvedor ) {

        // pega o desenvolvedor
        $desenvolvedor = Desenvolvedor::find( $idDesenvolvedor );

        // verifica se existe o desenvolvedor
        if( !$desenvolvedor ) {
            abort( 404 );
        }

        // busca os usuarios
        $users = User::all();

        // retorna a view
        return redirect()->to( '/admin/desenvolvedores')
                         ->with( 'entidade', 'desenvolvedor' )
                         ->with( 'desenvolvedor', $desenvolvedor )
                         ->with( 'exibirModal', true );
    }

    // exclui usuario
    public function excluir( $idDesenvolvedor ) {

        // pega o desenvolvedor
        $desenvolvedor = Desenvolvedor::find( $idDesenvolvedor );

        // verifica se existe o desenvolvedor
        if( !$desenvolvedor ) {
            abort( 404 );
        }

        // pega o usuario
        $user = User::find( $desenvolvedor->user_id );

        // deleta o desenvolvedor
        $del = $desenvolvedor->delete();
        $user->delete();

        // redireciona
        return redirect()->to( '/admin/desenvolvedores')
                         ->with( 'msg', $del ?
                                 'Desenvolvedor deletado com sucesso!' : 'Não foi possivel deletar o desenvolvedor no momento!')
                         ->with( 'tipo', $del ? 'light' : 'warning' );        
    }

    // exclui usuario
    public function salvar( Request $request ) {

        // verifica se é uma alteração
        if( $request->idDesenvolvedor ) {

            // busca o desenvolvedor
            $desenvolvedor = Desenvolvedor::find( $request->idDesenvolvedor );
            $user = User::find( $desenvolvedor->user_id );
            $user->name = $request->nome;
            $user->email = $request->email;
            if( User::where( 'email', '=', $request->email )->where( 'id', '<>', $desenvolvedor->user_id )->first() ){
                return redirect()->to( '/admin/desenvolvedores')
                             ->with( 'desenvolvedor', $desenvolvedor )
                             ->with( 'entidade', 'desenvolvedor' )
                             ->with( 'msgForm', 'E-mail já alocado a um usuário!' )
                             ->with( 'exibirModal', true )
                             ->with( 'tipo', 'danger' );
            } else if( !$user->save() ){
                return redirect()->to( '/admin/desenvolvedores')
                            ->with( 'msg', 'Não foi possivel cadastrar o desenvolvedor no momento!' )
                            ->with( 'tipo', 'warning' );
            } 
        } else if( User::where( 'email', '=', $request->email )->first() && !isset( $request->user_id ) ) {

            // retorna o formulario informando que o usuario ja está alocado
            return redirect()->to( '/admin/desenvolvedores')
                             ->with( 'entidade', 'desenvolvedor' )
                             ->with( 'msgForm', 'Usuário já alocado a um desenvolvedor!' )
                             ->with( 'exibirModal', true )
                             ->with( 'tipo', 'danger' );
        } else if( isset( $request->senha ) && $request->senha != $request->confirmarSenha ) {

            // remove a senha informada
            unset( $request->senha );
            unset( $request->confirmarSenha );

            // retorna o formulario informando que o usuario ja está alocado
            return redirect()->to( '/admin/desenvolvedores')
                             ->with( 'entidade', 'desenvolvedor' )
                             ->with( 'msgForm', 'Senhas não conferem!' )
                             ->with( 'exibirModal', true )
                             ->with( 'tipo', 'danger' );
        } else {
            $desenvolvedor = new Desenvolvedor;

            // pega o grupo
            $grupo = Grupo::where( 'entidade', '=', $request->grupo )->first();
            
            // verifica se encontrou o grupo
            if( !$grupo ) {
                $grupo = Grupo::create([
                    'nome' => 'Desenvolvedores',
                    'entidade' => 'desenvolvedor'
                ]);
            }

            // verifica se existe ja o user_id
            if( isset( $request->user_id ) ) {
                $user = User::find( $request->user_id );
                $user->grupo_id = $grupo->idGrupo;
                
                // verifica se o usuario foi cadastrado
                if( !$user->save() ){
                    return redirect()->to( '/admin/desenvolvedores')
                                ->with( 'msg', 'Não foi possivel cadastrar o desenvolvedor no momento!' )
                                ->with( 'tipo', 'warning' );
                }
            } else {

                // cria o usuario
                $user = User::create([
                    'name' => $request->nome,
                    'email' => $request->email,
                    'password' => bcrypt($request->senha),
                    'grupo_id' => $grupo->idGrupo
                ]);

                // verifica se o usuario foi cadastrado
                if( !$user ){
                    return redirect()->to( '/admin/desenvolvedores')
                                ->with( 'msg', 'Não foi possivel cadastrar o desenvolvedor no momento!' )
                                ->with( 'tipo', 'warning' );
                }
            }
        }

        // nascimento
        $desenvolvedor->nascimento = $request->nascimento;

        // apelido
        $desenvolvedor->apelido = $request->apelido;

        // user
        $desenvolvedor->user_id = $user->id;

        // salva
        if( $desenvolvedor->save() ) {
            return redirect()->to( '/admin/desenvolvedores')
                             ->with( 'msg', $request->idDesenvolvedor ?
                                     'Desenvolvedor alterado com sucesso!' : 'Desenvolvedor cadastrado com sucesso!')
                             ->with( 'tipo', 'success' );
        } else {
            return redirect()->to( '/admin/desenvolvedores')
                             ->with( 'msg', $request->idDesenvolvedor ?
                                     'Não foi possivel salvar as alterações no desenvolvedor no momento.' : 
                                     'Não foi possivel cadastrar o desenvolvedor no momento.')
                             ->with( 'tipo', 'warning' );
        }
    }
}
