
{{--  verifica se os usuarios estao setados  --}}
<hr>
<form action="/admin/itens/salvar" method="post">     

    {{--  insere o csrf field  --}}
    {!! csrf_field() !!}

    {{--  verifica se o id do desenvolvedor existe  --}}
    @if( session( 'item' ) && session( 'item' )->idItem )
        <input type="hidden" value="{{ session( 'item' )->idItem }}" name="idItem" id="idItem">
    @endif

    {{--  nome  --}}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome do {{ session( 'item' ) && session( 'item' )->idItem ? '' : 'Novo '}}Item</label>
                <input required class="form-control" type="text"
                        name="nome" 
                        id="nome"
                        value="{{ session( 'item' ) ? session( 'item' )->nome : '' }}">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="end_point">End point</label>
                <input required class="form-control" type="text"
                        name="end_point" 
                        id="end_point"
                        value="{{ session( 'item' ) ? session( 'item' )->end_point : '' }}">
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <label for="ordem">Ordem</label>
                <input required class="form-control" type="number"
                        name="ordem" 
                        id="ordem"
                        value="{{ session( 'item' ) ? session( 'item' )->ordem : '' }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="grupo">Grupo</label>
                <select required name="grupo" id="grupo" class="form-control" {{ count( session( 'grupos' ) ) ? '' : 'disabled' }}>
                    
                    {{--  percorre os desenvolvedores  --}}
                    @forelse( session( 'grupos' ) as $grupo )
                        @if( !( session( 'item' ) && session( 'item' )->componente->idGrupo ) && $loop->first )
                            <option value="" selected>Selecione uma opção</option>
                        @endif
                        <option value="{{ $grupo->idGrupo }}" {{ session( 'item' ) && session( 'item' )->grupo->idGrupo == $grupo->idGrupo ? 'selected' : '' }}>
                            {{ $grupo->nome }}
                        </option>

                    {{--  exibe a mensagem de nenhum registro  --}}
                    @empty
                        <option value="" selected>Nenhum grupo cadastrado</option>                        
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="componente">Componente</label>
                <select required name="componente" id="componente" class="form-control" {{ count( session( 'componentes' ) ) ? '' : 'disabled' }}>
                    
                    {{--  percorre os desenvolvedores  --}}
                    @forelse( session( 'componentes' ) as $componente )
                        @if( !( session( 'item' ) && session( 'item' )->componente->idComponente ) && $loop->first )
                            <option value="" selected>Selecione uma opção</option>
                        @endif
                        <option value="{{ $componente->idComponente }}" {{ session( 'item' ) && session( 'item' )->componente->idGrupo == $componente->idComponente ? 'selected' : '' }}>
                            {{ $componente->nome }}
                        </option>

                    {{--  exibe a mensagem de nenhum registro  --}}
                    @empty
                        <option value="" selected>Nenhum componente cadastrado</option>                        
                    @endforelse
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Salvar Item</button>
    <a href="/admin/itens" class="btn btn-danger">Cancelar</a>
</form>