
{{--  verifica se os usuarios estao setados  --}}
<div class="modal show" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">

                    {{--  seta o titulo do modal  --}}
                    {{ session(  'desenvolvedor'  ) && session(  'desenvolvedor'  )->idDesenvolvedor ? 'Alterar' : 'Cadastrar'}} Desenvolvedor
                </h5>
            </div>
            <div class="modal-body">


                {{--  exibe a mensagem  --}}
                @if( session( 'msgForm' ) )
                    <div class="alert alert-{{session( 'tipo' )}}" role="alert">
                        {{ session( 'msgForm' ) }}
                    </div>
                @endif
                <form action="/admin/desenvolvedores/salvar" class="form-horizontal" method="post">     

                    {{--  insere o csrf field  --}}
                    {!! csrf_field() !!}

                    {{--  verifica se o id do desenvolvedor existe  --}}
                    @if( session(  'desenvolvedor'  ) && session(  'desenvolvedor'  )->idDesenvolvedor )
                        <input type="hidden" value="{{ session(  'desenvolvedor'  )->idDesenvolvedor }}" name="idDesenvolvedor" id="idDesenvolvedor">
                    @endif

                    @component( 'auth/form' )
                    @endcomponent

                    {{--  inputs  --}}
                    <div class="form-group"> 

                        {{--  apelido  --}}
                        <label for="apelido" class="col-md-1">Apelido</label> 
                        <div class="col-md-5">
                            <input class="form-control" type="text"
                                    name="apelido" 
                                    id="apelido"
                                    value="{{ session(  'desenvolvedor'  ) ? session(  'desenvolvedor'  )->apelido : '' }}">
                        </div>   

                        {{--  data de nascimento  --}}
                        <label for="nascimento" class="col-md-2">Nascimento</label>
                        <div class="col-md-4">
                            <input class="form-control" type="date"
                                    name="nascimento"
                                    id="nascimento"
                                    value="{{ session(  'desenvolvedor'  ) ? session(  'desenvolvedor'  )->nascimento : '' }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Desenvolvedor</button>
                    <a href="/admin/desenvolvedores" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>