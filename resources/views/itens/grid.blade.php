@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        Itens
                        @if( !session( 'exibirForm' ) )
                            <a href="/admin/itens/cadastrar" class="btn btn-success pull-right">
                                <span class="glyphicon glyphicon-plus"></span>
                                Adicionar
                            </a> 
                        @endif
                    </h3>
                    @if( session( 'exibirForm' ) )
                        @component( 'itens/form' )
                        @endcomponent
                    @endif
                </div>

                <div class="panel-body">

                    {{--  exibe a mensagem  --}}
                    @if( session( 'msg' ) )
                        <div class="alert alert-{{session( 'tipo' )}}" role="alert">
                            {{ session( 'msg' ) }}
                        </div>
                    @endif
                    
                    {{--  percorre os desenvolvedores  --}}
                    @forelse( $itens as $item )

                        {{--  exibe o cabecalho do grid  --}}
                        @if( $loop->first )
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>End point</th>
                                        <th>Ordem</th>
                                        <th>Grupo</th>
                                        <th>Componente</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                        @endif 
                        
                        {{--  exibe os campos  --}}
                        <tr>
                            <td>{{ $item->idItem }}</td>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->end_point }}</td>
                            <td>{{ $item->ordem }}</td>
                            <td>{{ $item->grupo->nome }}</td>
                            <td>{{ $item->componente->nome }}</td>
                            <td>

                                {{--  botoes para as acoes  --}}
                                <a href="/admin/itens/alterar/{{ $item->idItem }}" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="/admin/itens/deletar/{{ $item->idItem }}" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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
