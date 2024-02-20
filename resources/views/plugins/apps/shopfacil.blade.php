<div class="modal-body p-0" id="verCliente" style="background: #fff">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-7 pd-l-20 pd-b-20 pd-r-10 bg-gray1">

                <img src="{{ asset('images/modules/gateways/bradesco.png') }}" class="mr-20 mr-l-0" style="max-height: 40px">

                <p>
                    <b>Custo das transações</b><br>
                    As tarifas das transações aplicam-se de acordo com o plano do portal de pagamento. Não serão cobrados encargos adicionais pela Folha Dirigida.
                </p>

                <p>
                    <b>Aceita somente boleto</b><br>
                    <small>( Com base na configuração da sua conta ShopFácil, os tipos de cartão podem variar. )</small>

                <div class="payment-with">
                    <i class="sprite-pagamento-boleto i-p-boleto"></i>
                </div>

                <hr>
                <p>
                    <b>Checkout transparente: <span class="text-green">Suportado</span></b><br>
                    <b>Pagamentos disponíveis: <span class="text-green">Boleto</span></b>
                </p>
                <hr>

                <p>
                    <span class="text-dark d-block mr-b-5">Instruções:</span>
                    Para utilizar Vindi com checkout transparente, é necessário gerar uma chave de acesso privada.
                </p>

                <ul>
                    <li>
                        Inicie sessão na sua conta <a href="https://www.shopfacil.com.br/login" target="_blank">ShopFácil</a>.
                    </li>
                    <li>
                        Navegue até Configurações &gt; Chaves de API.
                    </li>
                    <li>
                        Clique no botão superior "Nova chave"  &gt; Selecione o tipo: "Chave privada"  &gt; Criar chave de acesso
                    </li>
                </ul>
                </p>
            </div>

            <div class="col-md-5 pd-20">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                <form action="{{ ($config != null) ? route('plugin.update', $module->id) : route('plugin.save', $module->id) }}" method="post" class="config-plugin">
                    @csrf
                    <div class="form-group">
                        <label for="email">Id do Vendedor</label>
                        <input type="text" id="merchant_id" name="merchant_id" class="form-control" value="{{ ($config != null) ? $config->merchant_id : old('merchant_id') }}">
                    </div>

                    <div class="form-group">
                        <label for="token">Chave de Acesso</label>
                        <input type="text" id="chave" name="chave" class="form-control" value="{{ ($config != null) ? $config->chave : old('chave') }}">
                    </div>

                    <div class="form-group mr-b-20">
                        <label for="ambiente">Ambiente</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="radiobox">
                                    <label>
                                        <input type="radio" name="env" value="production" {{ ($config != null && $config->env == 'production') ? 'checked' : '' }}>
                                        <span class="label-text">Produção</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="radiobox">
                                    <label>
                                        <input type="radio" name="env" value="sandbox" {{ ($config != null && $config->env == 'sandbox') ? 'checked' : '' }}>
                                        <span class="label-text">Sandbox</span>
                                    </label>
                                </div>
                            </div>
                        </div>
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