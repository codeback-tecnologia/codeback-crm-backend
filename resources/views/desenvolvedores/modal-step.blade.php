<div class="modal show" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perfil Desenvolvedor</h5>
            </div>
            <div class="modal-body">
                <form action="/admin/desenvolvedores/salvar" method="post"> 
                    {!! csrf_field() !!}
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" id="user_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apelido">Apelido</label>
                                <input class="form-control" type="text"
                                        name="apelido" 
                                        id="apelido">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nascimento">Nascimento</label>
                                <input class="form-control" type="date"
                                        name="nascimento"
                                        id="nascimento">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Perfil</button>
                    <a href="{{ route('logout') }}"
                        class="btn btn-danger"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        Cancelar
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>