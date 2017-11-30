@extends('layouts.app')

@section('content')
<div class="container">
    @if( session( 'exibirModal' ) )
          @component( 'desenvolvedores/form' )
          @endcomponent
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Desenvolvedores
                        <a href="/admin/desenvolvedores/cadastrar" class="btn btn-success pull-right">
                            <span class="glyphicon glyphicon-plus"></span>
                            Adicionar
                        </a>                
                    </h3>
                </div>

                <div class="panel-body">

                    {{--  exibe a mensagem  --}}
                    @if( session( 'msg' ) )
                        <div class="alert alert-{{session( 'tipo' )}}" role="alert">
                            {{ session( 'msg' ) }}
                        </div>
                    @endif
                    
                    {{--  percorre os desenvolvedores  --}}
                    @forelse( $desenvolvedores as $dev )

                        {{--  exibe o cabecalho do grid  --}}
                        @if( $loop->first )
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Apelido</th>
                                        <th>Nascimento</th>
                                        <th>E-mail</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                        @endif 
                        
                        {{--  exibe os campos  --}}
                        <tr>
                            <td>{{ $dev->user->name }}</td>
                            <td>{{ $dev->apelido }}</td>
                            <td>{{ date( 'd/m/Y' , strtotime( $dev->nascimento ) ) }}</td>
                            <td>{{ $dev->user->email }}</td>
                            <td>

                                {{--  botoes para as acoes  --}}
                                <a href="/admin/desenvolvedores/alterar/{{ $dev->idDesenvolvedor }}" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="/admin/desenvolvedores/deletar/{{ $dev->idDesenvolvedor }}" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>

                        {{--  fecha o grud  --}}
                        @if( $loop->last )
                                </tbody>
                            </table>
                        @endif

                    {{--  exibe a mensagem de nenhum registro  --}}
                    @empty
                        <div class="alert alert-dark" role="alert">
                            Nenhum registro encontrado
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
