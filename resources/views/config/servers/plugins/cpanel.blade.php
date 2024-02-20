<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3 pd-b-10">
        <img src="{{ asset('images/modules/panel/cpanel.png') }}" style="height: 30px;">
    </div>
</div>

<div class="row">
    <div class="col-md-3 text-right">
        <label for="user_cpanel">Usuário <b class="text-red">*</b></label>
    </div>
    <div class="col-md-4 form-group">
        <input class="form-control" type="text" id="user_cpanel" name="config[user_cpanel]" value="{{ old('user_panel') }}" required>
    </div>
</div>

<div class="row">
    <div class="col-md-3 text-right">
        <label for="pass_cpanel">Senha <b class="text-red">*</b></label>
    </div>
    <div class="col-md-4 form-group">
        <input class="form-control" type="password" id="pass_cpanel" name="config[pass_cpanel]" value="{{ old('pass_panel') }}" required>
    </div>
</div>

<div class="row">
    <div class="col-md-3 text-right">
        <label for="hash_cpanel">Acesso Hash <b class="text-red">*</b></label>
    </div>
    <div class="col-md-8 form-group">
        <textarea name="config[hash_cpanel]" id="hash_cpanel" cols="30" rows="10" class="form-control">{{ old('hash_cpanel') }}</textarea>
    </div>
</div>