function resetErrors() {
    $('form input, form select').removeClass('inputTxtError');
    $('label.error').remove();
}

function verificaCPF(value) {
    var result = false;
    $.ajax({
        type: "POST",
        url: "unique_cpf",
        async: false,
        data: {"cpf": value, "_token": $('input[name="_token"]').val()},
        success: function (response) {
            if(response == "livre"){
                result = true;
            }else{
                result = false;
            }
        }
    });

    return result;
}

// Ação do Botão "Novo Cliente"
$('[rel="submitAdd_clientes"]').on('click', function(){
    /*
    var dados = $('#formAdd_clientes').serialize();

    resetErrors();

    $.ajax({
        type:'POST',
        url: '/customers/create',
        data: dados,
        beforeSend: function() {
            $('.carregando').fadeIn();
        },
        success: function(response){

            if(response === "success"){
                $('#abreModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

                $('#formAdd_clientes').trigger('reset');

                $('.overlay').hide();
                getURL('customers');

                // toastr.[tipo]('Mensagem', 'Título');
                toastr.success('Um novo cliente foi cadastrado.', 'Sucesso!');
            }
        },

        error: function(error){
            $('.overlay').hide();
            var erro = error.responseJSON;

            if(error.status === 422){ // Validação de Formulário
                $.each(erro, function(i, v) {
                    var msg = '<p class="help-block">'+v+'</p>';
                    $('input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg).focus();
                });
            }else{
                console.log(error.responseText);
            }
        }
    });
    */

    $('#formAdd_clientes').submit();
});

// Ação do Botão "Excluir Cliente"
$('[rel="submitDel_cliente"]').on('click', function(){
    var itens = $('#lista_cadastros').serialize();

    $.ajax({
        type:'DELETE',
        url: 'customers/delete',
        data: itens,
        success: function(response){

            if(response === "success"){
                $('#abreModal').modal('hide');
                $('.overlay').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

                getURL('customers');
                toastr.warning('Um cliente foi excluído.', 'Atenção!');
            }

        },
        error: function(error){
            $('.modal-content').html(error.responseText);
        }
    });
});

// Ação do Botão "Editar Cliente"
$('[rel="submitEdit_clientes"]').on('click', function(){
    $('#formEdit_clientes').submit();
});

$('[rel="bt_verMes"]').on('click', function(){
    var data_extrato = $('#extrato_mes').val();
    var cliente = $(this).data('id');

    $.ajax({
        type: 'POST',
        url:  'cadastros/submit_verExtrato/',
        data: {cliente: cliente, data: data_extrato},
        beforeSend: function() {
            $('.extratoDiv').html('Carregando...');
        },
        success: function(response){
            $('.extratoDiv').html(response)
        },
        error: function(error){
            $('.extratoDiv').html(error.responseText);
        }
    });
});

$('[rel="submitEnvia_mensagem"]').on('click', function(){
    var dados = $('#formEnvia_mensagem').serialize();

    $.ajax({
        type: 'POST',
        url: 'cadastros/submitMessage/',
        dataType: 'json',
        data: dados,
        success: function(data){
            console.log(data);
        },
        error: function(error){
            console.log(error.responseText);
        }
    });
});

function exibeFisica(){
    $('.pessoa_juridica').removeClass('active');
    $('.pessoa_fisica').addClass('active');
    $('[name="type"]').attr('value', 'fisica');

    $('label[for="label_razao_nome"]').html('Nome Completo');
    $('label[for="label_cpf_cnpj"]').html('CPF');

    $('#label_cpf_cnpj').inputmask("999.999.999-99", {"placeholder": "000.000.000-00"});

    $('.div_fisica').show();
    $('.div_juridica').hide();
}

function exibeJuridica(){
    $('.pessoa_fisica').removeClass('active');
    $('.pessoa_juridica').addClass('active');
    $('[name="type"]').attr('value', 'juridica');

    $('label[for="label_razao_nome"]').html('Razão Social');
    $('label[for="label_cpf_cnpj"]').html('CNPJ');

    $('#label_cpf_cnpj').inputmask("99.999.999/9999-99", {"placeholder": "00.000.000/0000-00"});

    $('.div_juridica').show();
    $('.div_fisica').hide();
}

// Quando clicar no Button Group "Pessoa Fisica"
$('.pessoa_fisica').on('click', function(){
    exibeFisica();
});

// Quando clicar no Button Group "Pessoa Jurídica"
$('.pessoa_juridica').on('click', function(){
    exibeJuridica();
});

if($('[name="type"]').val() === "fisica"){
    exibeFisica();
}else{
    exibeJuridica();
}


//Õutras Configurações
$('.date').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: true,
    format: 'dd/mm/yyyy',
    todayHighlight: true,
    autoclose: true,
    language: 'pt-BR'
});

$(".formatTEL").inputmask("(99) 9999-9999", {"placeholder": "(00) 0000-0000"});
$(".formatCEP").inputmask("99999-999", {"placeholder": "00000-000"});
$(".formatCEL").inputmask("(99) 9999-99999", {"placeholder": "(00) 0000-0000 "});

function limpa_formulario_cep() {
    // Limpa valores do formulário de cep.
    $('[name="address"]').val("");
    $('[name="district"]').val("");
    $('[name="city"]').val("");
    $('[name="uf"]').val("");
    $('[name="additional"]').val("");
}



//Quando o campo cep perde o foco.
$('.buscaCEP').blur(function(){
    var cep = $(this).val().replace(/\D/g, '');

    if (cep !== "") {
        var validacep = /^[0-9]{8}$/;

        if(validacep.test(cep)) {
            $('[name="address"]').val("Carregando...");
            $('[name="district"]').val("Carregando...");
            $('[name="city"]').val("Carregando...");
            $('[name="uf"]').val("...");
            $('[name="additional"]').val("Carregando...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    $('[name="address"]').val(dados.logradouro);
                    $('[name="district"]').val(dados.bairro);
                    $('[name="city"]').val(dados.localidade);
                    $('[name="uf"]').selectpicker('val', dados.uf);
                    $('[name="additional"]').val(dados.complemento);
                }
                else {
                    limpa_formulario_cep();
                    alert("CEP não encontrado.");
                }
            });
        }
        else {
            //cep é inválido.
            limpa_formulario_cep();
            alert("Formato de CEP inválido.");
        }
    }
    else {
        //cep sem valor, limpa formulário.
        limpa_formulario_cep();
    }
});

$(document).ready(function() {

    $.validator.addMethod("verificaCPF", function (value, element) {
        return verificaCPF(value);
    });

    $.validator.addMethod("verificaEmail", function (value, element) {
        var result = false;
        $.ajax({
            type: "POST",
            async: false,
            url: "unique_email",
            data: {"email": value, "_token": $('input[name="_token"]').val()},
            success: function (response) {
                if (response === true) {
                    result = true;
                }
            }
        });

        return result;
    });

    $('#formAdd_clientes').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true,
                verificaEmail: true
            },
            cpf_cnpj: {
                required: true,
                verificaCPF: true
            }
        },

        messages: {
            email:{
                verificaEmail: "Já existe um cliente com este E-mail."
            },
            cpf_cnpj: {
                verificaCPF: "Já existe um cliente com este CPF."
            }
        }
    });

    $('#formEdit_clientes').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true,
                //verificaEmail: true
            },
            cpf_cnpj: {
                required: true,
                //verificaCPF: true
            }
        },

        messages: {
            email:{
                verificaEmail: "Já existe um cliente com este E-mail."
            },
            cpf_cnpj: {
                verificaCPF: "Já existe um cliente com este CPF."
            }
        }
    });
});