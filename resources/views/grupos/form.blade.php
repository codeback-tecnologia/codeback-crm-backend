
{{--  verifica se os usuarios estao setados  --}}
<hr>
<form action="/admin/grupos/salvar" method="post">     

    {{--  insere o csrf field  --}}
    {!! csrf_field() !!}

    {{--  verifica se o id do desenvolvedor existe  --}}
    @if( session(  'grupo'  ) && session(  'grupo'  )->idGrupo )
        <input type="hidden" value="{{ session(  'grupo'  )->idGrupo }}" name="idGrupo" id="idGrupo">
    @endif

    {{--  nome  --}}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome do {{ session(  'grupo'  ) && session(  'grupo'  )->idGrupo ? '' : 'Novo '}}Grupo</label>
                <input class="form-control" type="text"
                        name="nome" 
                        id="nome"
                        value="{{ session(  'grupo'  ) ? session(  'grupo'  )->nome : '' }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="entidade">Entidade</label>
                <input class="form-control" type="text"
                        name="entidade" 
                        id="entidade"
                        value="{{ session(  'grupo'  ) ? session(  'grupo'  )->entidade : '' }}">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Salvar Grupo</button>
    <a href="/admin/grupos" class="btn btn-danger">Cancelar</a>
</form>