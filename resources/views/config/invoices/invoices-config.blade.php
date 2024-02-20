@extends('layouts.sistema')
@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Configurações</h6>
            <!--<p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Configurações</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->

    <div class="row">
        <!-- col-md-4 -->
        <div class="actions-sidebar pd-l-0 pd-r-20">
            <div class="widget-bg widget-notes border-radius-3">
                <div class="widget-body profile-user-description p-3">
                    <h6 class="mr-t-0">
                        Financeiro
                    </h6>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <a href="{{ route('config.method-payment') }}" class="fw-600 fs-15 d-block">
                                <i class="icone-right-dir f-left"></i>
                                Método de pagamento
                            </a>
                            Você pode selecionar um gateway padrão para cada tipo de pagamento.
                        </p>
                    </div>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <a href="#" class="fw-600 fs-15 d-block">
                                <i class="icone-right-dir f-left"></i>
                                Faturas
                            </a>
                            Selecione como e quando serão feitas os envios de cobrança para o cliente
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- col-md-4 -->

        <div class="content-with-sidebar">

                        <h6 class="mr-b-20 mr-t-0">
                            <i class="icone-barcode-1"></i>
                            Selecione quando deseja enviar a cobrança:
                        </h6>


            <form class="">
                <div class="bg-white p-3 border-radius-3">
                    <div class="widget-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="" for="">Enviar antes do vencimento</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-5 pd-t-5" style="max-width: 34.66667%;">Enviar automaticamente as cobranças</label>
                                        <div class="col-md-1"><input type="text" class="form-control" name="dias_vencimento"></div>
                                        <label class="col-md-5 pd-t-5">dias antes do vencimento.</label>
                                    </div>
                                    <div class="form-check pd-l-20">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="" for="">Enviar boleto em anexo</label>
                                    </div>
                                </div>
                            </div>
                            <h6 class="mr-b-10 mr-t-10">
                                <i class="icone-mail-1"></i>
                                Enviar SMS
                            </h6>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="label_obs">Mensagem do SMS:</label>
                                    <textarea class="form-control" name="obs_sms_antes" id="label_obs" rows="3"></textarea>
                                </div>
                            </div>
                            <h6 class="mr-b-10 mr-t-20">
                                <i class="icone-email"></i>
                                Enviar Email
                            </h6>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="label_obs">Mensagem do Email:</label>
                                    <textarea class="form-control" name="obs_email_antes" id="label_obs" rows="3"></textarea>
                                </div>
                            </div>


                    </div>

                </div>
                <div class="bg-white p-3 border-radius-3 mr-t-20">
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="" for="">Enviar depois do vencimento</label>
                                </div>
                                <div class="row">
                                    <label class="col-md-5 pd-t-5" style="max-width: 34.66667%;">Enviar automaticamente as cobranças</label>
                                    <div class="col-md-1"><input type="text" class="form-control"></div>
                                    <label class="col-md-5 pd-t-5">dias antes do vencimento.</label>
                                </div>
                                <div class="form-check pd-l-20">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="" for="">Enviar boleto em anexo</label>
                                </div>
                            </div>
                        </div>
                        <h6 class="mr-b-10 mr-t-10">
                            <i class="icone-mail-1"></i>
                            Enviar SMS
                        </h6>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="label_obs">Mensagem do SMS:</label>
                                <textarea class="form-control" name="obs_sms_depois" id="label_obs" rows="3"></textarea>
                            </div>
                        </div>
                        <h6 class="mr-b-10 mr-t-20">
                            <i class="icone-email"></i>
                            Enviar Email
                        </h6>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="label_obs">Mensagem do Email:</label>
                                <textarea class="form-control" name="obs_email_depois" id="label_obs" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                               <div class="col-md-3">
                                   <div class="form-group mr-t-20">
                                       <a href="#" class="btn btn-primary btn-sm fs-14">Salvar configurações</a>
                                   </div>
                               </div>
                                <div class="col-md-9">
                                    <div class="form-group mr-t-20">
                                        <a href="#" class="btn btn-default btn-sm fs-14">Ver listas de cobraças</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </div>

    </div>

    <!-- Modal Nova Conta -->
    <div class="modal fade" id="novaConta" tabindex="-1" role="dialog" aria-labelledby="novaConta_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 400px;">
                <form action="{{ route('config.store.conta-bancaria') }}" method="post">
                    @csrf
                    <div class="modal-body p-0">

                        <div class="col-md-12 pd-lr-20 pd-t-0">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                            <h4 class="modal-title d-inline" id="mExcluirLabel">
                                <span class="plugin-title d-inline-block mr-t-10 fs-20">Nova conta</span>
                            </h4>

                            <div class="row">
                                <div class="col-md-2 noPadding-right">
                                    <img src="{{ asset('/images/bancos/bradesco.gif') }}" class="img-responsive img-banco" style="margin-top: 5px;" />
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="banco" class="mr-b-0">
                                            Banco
                                        </label>
                                        <select id="banco" name="banco" required class="form-control selectpicker">
                                            <option value="">Selecione o banco</option>
                                            <option value="bradesco">Bradesco</option>
                                            <option value="itau">Itaú</option>
                                            <option value="caixa">Caixa Econômica</option>
                                            <option value="santander">Santander</option>
                                            <option value="bb">Banco do Brasil</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nome" class="mr-b-0">Cedente</label>
                                        <input name="cedente" required class="form-control" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nome" class="mr-b-0">Carteira <a href="#"><i class="icone-help-circled-1 mr-l-5"></i></a></label>
                                        <input name="carteira" required class="form-control" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="tipo_conta" class="mr-b-0">Tipo de Conta</label>
                                        <select id="tipo_conta" required name="tipo_conta" class="form-control selectpicker">
                                            <option value="">Selecione o tipo</option>
                                            <option value="corrente">Conta corrente</option>
                                            <option value="poupanca">Conta Poupança</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="agencia" class="mr-b-0">Agência</label>
                                        <input id="agencia" name="agencia" required class="form-control" type="text" placeholder="" />
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="conta" class="mr-b-0">Conta</label>
                                        <input id="conta" name="conta" required class="form-control" type="text" placeholder="" />
                                    </div>
                                </div>

                                <div class="col-md-2 noPadding">
                                    <div class="form-group">
                                        <label></label>
                                        <input name="digito" required class="form-control" type="text" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default fs-14" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-primary fs-14">Salvar conta</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript">
        $(function (){
            $('#banco').on('change', function () {
                var banco = $(this).val();
                $('img.img-banco').attr('src', '{{ asset('/images/bancos/_banco_.png') }}'.replace('_banco_', banco));
            });
        })
    </script>

@endsection