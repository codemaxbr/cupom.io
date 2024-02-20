<!-- Modal Novo Pagamento -->
<div class="modal fade modal-primary bs-modal-md" id="adicionarItem" tabindex="-1" role="dialog" aria-labelledby="novoItem_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 600px;">

            <form id="addItem_invoice">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title text-white" id="novoItem_label">Adicionar Lançamento</h5>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo_servico" style="display: block;">
                                    Tipo de Lançamento <b class="text-red">*</b>
                                </label>

                                <select id="tipo_servico" name="tipo" required class="form-control selectpicker" style="width: 100%;">
                                    <option value="">Selecione um item</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="produto_servico" style="display: block;">
                                    Produto / Serviço <b class="text-red">*</b>
                                </label>

                                <select id="produto_servico" name="produto_servico" required class="form-control selectpicker" style="width: 100%;">
                                    <option value="">Selecione um Tipo</option>
                                    <!--
                                    <optgroup label="Web">
                                        <option value="servico">Criação e Desenvolvimento de sites</option>
                                        <option value="assinatura">Mega 2GB - R$ 19,90 /mês</option>
                                        <option value="assinatura">Nitro 5GB - R$ 29,90 /mês</option>
                                    </optgroup>
                                    -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="valor">Preço R$</label>
                                <input type="text" id="valor" disabled="disabled" name="valor" class="form-control define-price ls-price" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="desconto_item">Desconto</label>
                                <input type="text" id="desconto_item" name="desconto_item" class="form-control define-discount ls-price" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dominio">Domínio <small>(opcional)</small></label>
                                <input type="text" id="dominio" name="dominio" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="qty">Qtd <b class="text-red">*</b></label>
                                <input type="number" name="qty" required id="qty" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="descricao">Descrição da Cobrança</label>
                                <input type="text" id="descricao" name="descricao" class="form-control define-description" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default fs-14" data-dismiss="modal">Fechar</button>
                    <button type="submit" rel="submitAdd_item" class="btn btn-primary btn-sm fs-14"><i class="icone-plus-1"></i> Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>