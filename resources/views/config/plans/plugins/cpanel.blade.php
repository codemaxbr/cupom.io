
    <div class="row">
        <div class="col-md-4 noPadding text-right">
            <label class="fs-14">Nome do pacote no WHM</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="config[package_name]" class="form-control" value="">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 noPadding text-right">
            <label class="fs-14">Espaço em disco (MB)</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" name="config[disk_limit]" id="disco" value="">
                    <div class="input-group-addon">
                        <div class="checkbox checkbox-primary d-inline">
                            <label class="checkbox-checked">
                                <input type="checkbox" name="config[disk_limit]" value="unlimited">
                                <span class="label-text">
                                    ilimitado
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 noPadding text-right">
            <label class="fs-14">Tráfego mensal (MB)</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" name="config[bw_limit]" id="disco" value="">
                    <div class="input-group-addon">
                        <div class="checkbox checkbox-primary d-inline">
                            <label class="checkbox-checked">
                                <input type="checkbox" name="config[bw_limit]" value="unlimited">
                                <span class="label-text">
                                    ilimitado
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 noPadding text-right">
            <label class="fs-14">Contas de E-mail</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" name="config[emails]" id="disco" value="">
                    <div class="input-group-addon">
                        <div class="checkbox checkbox-primary d-inline">
                            <label class="checkbox-checked">
                                <input type="checkbox" name="config[emails]" value="unlimited">
                                <span class="label-text">
                                    ilimitado
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 noPadding text-right">
            <label class="fs-14">Banco de Dados</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" name="config[databases]" id="disco" value="">
                    <div class="input-group-addon">
                        <div class="checkbox checkbox-primary d-inline">
                            <label class="checkbox-checked">
                                <input type="checkbox" name="config[databases]" value="unlimited">
                                <span class="label-text">
                                    ilimitado
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 noPadding text-right">
            <label class="fs-14">Domínios adicionais</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" name="config[domains]" id="disco" value="">
                    <div class="input-group-addon">
                        <div class="checkbox checkbox-primary d-inline">
                            <label class="checkbox-checked">
                                <input type="checkbox" name="config[domains]" value="unlimited">
                                <span class="label-text">
                                    ilimitado
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 noPadding text-right">
            <label class="fs-14">Mapeamentos</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" name="config[parks]" id="disco" value="">
                    <div class="input-group-addon">
                        <div class="checkbox checkbox-primary d-inline">
                            <label class="checkbox-checked">
                                <input type="checkbox" name="config[parks]" value="unlimited">
                                <span class="label-text">
                                    ilimitado
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-7">
            <div class="checkbox checkbox-primary d-inline">
                <label class="checkbox-checked">
                    <input type="checkbox" name="config[access_ssh]">
                    <span class="label-text">
                        Acesso SSH
                    </span>
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-7">
            <div class="checkbox checkbox-primary d-inline">
                <label class="checkbox-checked">
                    <input type="checkbox" name="config[access_cgi]" value="yes">
                    <span class="label-text">
                        Acesso CGI
                    </span>
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-7">
            <div class="checkbox checkbox-primary d-inline">
                <label class="checkbox-checked">
                    <input type="checkbox" name="config[frontpage]" value="yes">
                    <span class="label-text">
                        Extensões do FrontPage
                    </span>
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-7">
            <div class="checkbox checkbox-primary d-inline">
                <label class="checkbox-checked">
                    <input type="checkbox" name="config[over_disk]" value="yes">
                    <span class="label-text">
                        Permitir consumo de Disco excedente
                    </span>
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-7">
            <div class="checkbox checkbox-primary d-inline">
                <label class="checkbox-checked">
                    <input type="checkbox" name="config[over_bw]" value="yes">
                    <span class="label-text">
                        Permitir consumo de Tráfego excedente
                    </span>
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 noPadding text-right">
            <label>Tema cPanel</label>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select name="config[theme]" id="" class="form-control">
                    <option value="paper_lantern">paper_lantern</option>
                    <option value="x3">x3</option>
                </select>
            </div>
        </div>
    </div>
