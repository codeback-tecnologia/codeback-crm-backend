
{{--  verifica se os usuarios estao setados  --}}
<hr>
<form action="/admin/componentes/salvar" method="post">     

    {{--  insere o csrf field  --}}
    {!! csrf_field() !!}

    {{--  verifica se o id do desenvolvedor existe  --}}
    @if( session(  'componente'  ) && session(  'componente'  )->idComponente )
        <input type="hidden" value="{{ session(  'componente'  )->idComponente }}" name="idComponente" id="idComponente">
    @endif

    {{--  nome  --}}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome do {{ session(  'componente'  ) && session(  'componente'  )->idComponente ? '' : 'Novo '}}Componente</label>
                <input class="form-control" type="text"
                        name="nome" 
                        id="nome"
                        value="{{ session(  'componente'  ) ? session(  'componente'  )->nome : '' }}">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Salvar Componente</button>
    <a href="/admin/componentes" class="btn btn-danger">Cancelar</a>
</form>