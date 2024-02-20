<div class="modal-body p-0" id="verCliente" style="background: #fff">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-7 pd-l-20 pd-b-20 pd-r-20 bg-gray1">

                <img src="{{ asset('images/modules/panel/cpanel.png') }}" class="mr-20 mr-l-0" style="max-height: 40px">
                <h4 class="modal-title d-inline" id="mExcluirLabel">
                    <span class="plugin-title d-inline-block mr-t-30 f-right">Chaves de acesso</span>
                </h4>

                <p>
                    <b>Como funciona</b><br>
                    Para que a integração com servidores externos funcione, é necessário vincular um servidor ao módulo.
                </p>

                <p>
                    <b>Veja abaixo suas chaves autenticadas:</b>
                    <hr>

                    <div class="ls-list ls-mini ls-domain">
                        <header class="ls-list-header bg-white">
                            <h6>
                                88b368b0-b691-11e8-94df-279b9270b430
                            </h6>

                            <div class="ls-group-actions">
                                <a href="#" class="btn btn-sm btn-primary fs-14 f-left">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </div>

                            <div class="ls-list-title">
                                <a href="">VPS Amazon</a>
                                <small>Vinculado em 26/06/2018 14:41
                                    <a href="#" class="ico-question" data-container="body" data-inherit="background-color" data-toggle="popover" data-placement="top" data-content="Um texto bem legal e bonito por aqui." data-title="Título" data-original-title="" title=""></a>
                                </small>
                            </div>
                        </header>
                    </div>

                </p>
            </div>

            <div class="col-md-5 pd-20">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                <form action="{{ ($config != null) ? route('plugin.update', $module->id) : route('plugin.save', $module->id) }}" method="post" class="config-plugin">
                    @csrf
                    <div class="form-group">
                        <label for="servidor">Servidor</label>
                        <select name="server_id" id="servidor" class="form-control selectpicker">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user">Usuário WHM</label>
                        <input type="text" id="user" name="user" class="form-control" value="{{ ($config != null) ? $config->user : old('user') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Senha WHM</label>
                        <input type="password" id="password" name="password" class="form-control" value="{{ ($config != null) ? $config->password : old('password') }}">
                    </div>

                    <div class="form-group mr-b-20">
                        <label for="ambiente">Remote Key</label>
                        <textarea name="remote_key" id="remote_key" rows="10" class="form-control resize-none"></textarea>
                    </div>

                    <!--
                    <div class="alert alert-danger">
                        <i class="icone-attention-circled"></i>
                        Não foi possível estabelecer conexão com as credênciais informadas
                    </div>
                    -->

                    <button type="submit" class="btn btn-sm btn-primary fs-14 text-white">
                        Salvar configurações
                    </button>
                    <button type="button" class="btn btn-sm btn-default fs-14" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('.selectpicker').selectpicker();
    })
</script>