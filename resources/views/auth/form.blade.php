    {{--  verifica se o id do desenvolvedor existe  --}}
    @if( !( isset( session(  session( 'entidade' )  )->user ) && session(  session( 'entidade' )  )->user->grupo_id ) )
        <input type="hidden" value="{{ session( 'entidade' ) }}" name="grupo" id="grupo">        
    @endif

    {{--  nome  --}}
    <div class="form-group">
        <label for="nome" class="col-md-4">Nome do {{ isset( session(  session( 'entidade' )  )->user ) ? session( 'entidade' ) : "novo(a) " .session( 'entidade' ) }}</label>
        <div class="col-md-8">
            <input class="form-control" type="text"
                    name="nome" 
                    id="nome"
                    value="{{ isset( session( session( 'entidade' ) )->user ) ? session( session( 'entidade' ) )->user->name : '' }}">
        </div>
    </div>

    {{--  email  --}}
    <div class="form-group">
        <label for="email" class="col-md-4">E-mail</label>
        <div class="col-md-8">
            <input class="form-control" type="email"
                    name="email" 
                    id="email"
                    value="{{ isset( session(  session( 'entidade' )  )->user ) ? session(  session( 'entidade' )  )->user->email : '' }}">
        </div>
    </div>

    {{--  verifica se ja esta setado  --}}
    @if( !isset( session(  session( 'entidade' )  )->user ) )

        {{--  senha  --}}
        <div class="form-group"> 
            <label for="senha" class="col-md-1">Senha</label> 
            <div class="col-md-5">
                <input class="form-control" type="password"
                        name="senha" 
                        id="senha">
            </div>   
            <label for="confirmarSenha" class="col-md-1">Confirmar Senha</label>
            <div class="col-md-5">
                <input class="form-control" type="password"
                        name="confirmarSenha" 
                        id="confirmarSenha">
            </div>
        </div>
    @endif