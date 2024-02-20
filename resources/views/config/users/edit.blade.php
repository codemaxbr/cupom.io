<form id="formEdit_usuario" action="{{ route('config.user.update', $user->id) }}" method="post">
    @csrf
    <div class="modal-header modal-user">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="user-profile col-md-11">
            <div class="col-md-3 photo">
                <a rel="alterarFoto" class="img-circle" data-id="22">
                    <i class="icone-camera-6"></i>
                    <p>Trocar foto</p>
                </a>

                @if($user->photo != NULL){
                    <img class="img-circle" src="{{ $user->photo }}" alt="User Avatar" style="width:100px; height: 100px;">
                @else
                    <img class="img-circle" src="{{ asset('images/user_blank.gif') }}" alt="User Avatar" style="width:100px; height: 100px;">
                @endif
            </div>

            <input id="foto" name="foto" type="file" value="" style="display:none;" />

            <div class="col-md-8 desc_name">
                <div class="form-group">
                    <input class="form-control" type="text" name="nome" id="nome" value="{{ $user->name }}" placeholder="Nome do Usuário" required />
                </div>
            </div>
        </div>
    </div>

    <div class="modal-body modal-user modal-cliente">

        <div class="row">
            <div class="col-md-12">
                <div class="box_destaque">

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="nome">Status</label>
                        </div>
                        <div class="col-md-3 form-group">
                            <select name="status" class="form-control selectpicker" id="status">
                                <option value="1" {{($user->confirmed == 1) ? 'selected' : ''}}>Ativo</option>
                                <option value="0" {{($user->confirmed == 0) ? 'selected' : ''}}>Desativado</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="nome">E-mail</label>
                        </div>
                        <div class="col-md-7 form-group">
                            <input class="form-control" id="email" name="email" type="text" value="{{ $user->email }}" required />
                            <p>Seu email não será visível ao público. <a href="#">Por que?</a></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="nome">Nova senha</label>
                        </div>
                        <div class="col-md-5 form-group">
                            <input class="form-control" name="nova_senha" type="password" id="senha" placeholder="Senha" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="nome">Confirmar senha</label>
                        </div>
                        <div class="col-md-5 form-group">
                            <input class="form-control" type="password" name="confirma_senha" id="confirma_senha" placeholder="Confirmar Senha" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="nome">Nível de acesso</label>
                        </div>
                        <div class="col-md-5 form-group">
                            <select name="grupo" class="form-control selectpicker" id="grupo">
                                <option value="0">Administrador</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm fs-14" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary btn-sm fs-14" rel="submitEdit_usuario">
            <i class="icone-floppy"></i>
            Salvar alterações
        </button>
    </div>
</form>

<script type="text/javascript">
    $(function () {
        $('.selectpicker').selectpicker();

        $('[rel="alterarFoto"]').on('click', function(event){
            event.preventDefault();

            $('#foto').click();
        });

        $('#foto').on('change', function(){
            var image  = $(this).prop('files');
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.photo img').attr('src', e.target.result);
                foto = e.target.result;
            }

            reader.readAsDataURL(image[0])
        });

        var foto;
    })
</script>