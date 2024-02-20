var invoice             = {};
    invoice.itens       = [];
    invoice.total       = parseFloat(0.00);
    invoice.subtotal    = parseFloat(0.00);
    invoice.desconto    = parseFloat(0.00);
    invoice.taxas       = parseFloat(0.00);
    invoice.account_id  = $('body').data('id');
    invoice.cliente     = $('[name="cliente"]').val();

$('.date').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: true,
    format: 'dd/mm/yyyy',
    todayHighlight: true,
    autoclose: true,
    language: 'pt-BR'
});

$('[rel="adicionarItem"]').on('click', function() {
    $('#adicionarItem').modal('show');
    $('#adicionarItem .modal-dialog').animate().width('600px');
});

$('[name="produto_servico"]').on('change', function(){
    var selected = $(':selected', this);

    // Pega o texto do "option" selecionado
    var option = selected.text();

    // Aqui pega o "option group" (Categoria do Serviço/Plano)
    var optGroup = selected.closest('optgroup').attr('label');

    // Pega o preço do serviço/plano
    var price = float2moeda(selected.data('html'));

    // Monta a descriçao completa
    var description = option;

    if(selected.val() !== ''){
        $('.define-price').val(price);
        $('.define-description').val(description);
    }else{
        $('.define-price').val('');
        $('.define-description').val('');
    }
});

$('[rel="submitAdd_item"]').on('click', function (e){

    // bloqueando envio do form
    e.preventDefault();

    var desconto = 0.00;

    if($('#desconto_item').val() !== ''){
        desconto = moeda2float($('#desconto_item').val());
    }

    if($('#addItem_invoice').valid()){

        var items = {
            'tipo': $('#tipo_servico').val(),
            'tipo_nome': $('#tipo_servico :selected').text(),
            'produto_servico': $('#produto_servico').val(),
            'valor': moeda2float($('#valor').val()),
            'descricao': $('#descricao').val(),
            'desconto': desconto,
            'dominio': $('#dominio').val(),
            'qtd': parseInt($('#qty').val()),
            'subtotal': parseFloat(parseInt($('#qty').val()) * moeda2float($('#valor').val()) - desconto)
        };

        // Quantidade de itens na lista
        invoice.itens.push(items);

        var total = invoice.itens.length;

        var itens_hidden = '';
        $.each(items, function (i, item){
            itens_hidden += '<input type="hidden" name="items['+total+']['+i+']" value="'+item+'" />';
        });

        var itens_html = '';
        itens_html += '<tr>';
        itens_html += '<td>'+items.tipo_nome+'</td>';
        itens_html += '<td>';
        itens_html += '<a href="'+items.produto_servico+'">'+items.descricao+'</a>';
        if(items.dominio !== ''){
            itens_html += items.dominio;
        }
        itens_html += '</td>';
        itens_html += '<td class="text-center">R$ '+float2moeda(items.valor.toFixed(2))+'</td>';
        itens_html += '<td class="text-center">R$ '+float2moeda(items.desconto.toFixed(2))+'</td>';
        itens_html += '<td class="text-center">'+items.qtd+'</td>';
        itens_html += '<td class="text-center">R$ '+float2moeda(items.subtotal.toFixed(2))+'</td>';

        itens_html += '</tr>';

        $($(itens_html).slideDown('slow')).appendTo('.fatura_itens table tbody');
        $(itens_hidden).appendTo('.itens_fatura');

        if(total > 0){
            $('.botoes_incluir .well').hide();
        }

        invoice.subtotal = (invoice.subtotal + items.subtotal);
        calcula();

        $('#addItem_invoice')[0].reset();
        $('#produto_servico').selectpicker('refresh');
        $('#tipo_servico').selectpicker('refresh');
        $('.fatura_itens table').show();
        $('#adicionarItem').modal('hide');
    }
});

$('#desconto').on('keyup', function () {
    if($(this).val() !== ''){
        var desconto = moeda2float($(this).val());
    }else{
        var desconto = 0.00
    }

    invoice.desconto = desconto;
    calcula();
});

$('#taxas').on('keyup', function () {
    if($(this).val() !== ''){
        var taxas = moeda2float($(this).val());
    }else{
        var taxas = 0.00
    }

    invoice.taxas = taxas;
    calcula();
});


function removeLinha(element){

    /* Condição que mantém pelo menos uma linha na tabela */
    if (linha_total > 1){
        /* Remove os elementos da linha onde está o botão clicado */
        $(element).parent().parent().remove();
        linha_total = linha_total - 1;
    }

    /* Avisa usuário de que não pode remover a última linha */
    else{
        alert("Você não pode remover a última linha!");
        //$.messager.alert('Importante!','Você não pode remover a última linha.','warning');
    }
}

function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
            objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}

function moeda2float(moeda){
    moeda = moeda.replace(".","");
    moeda = moeda.replace(",",".");

    return parseFloat(moeda);
}

function float2moeda(num) {

    x = 0;

    if(num<0) {
        num = Math.abs(num);
        x = 1;
    }
    if(isNaN(num)) num = "0";
    cents = Math.floor((num*100+0.5)%100);

    num = Math.floor((num*100+0.5)/100).toString();

    if(cents < 10) cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
        num = num.substring(0,num.length-(4*i+3))+'.'
            +num.substring(num.length-(4*i+3));
    ret = num + ',' + cents;
    if (x == 1) ret = ' - ' + ret;return ret;

}

function calcula(){

    invoice.total = (invoice.subtotal + invoice.taxas - invoice.desconto);

    $('.txtSubtotal').html('R$ '+ float2moeda(invoice.subtotal.toFixed(2)));
    $('.txtDesconto').html('R$ '+ float2moeda(invoice.desconto.toFixed(2)));
    $('.txtTaxas').html('R$ '+ float2moeda(invoice.taxas.toFixed(2)));
    $('.txtTotal').html('R$ '+ float2moeda(invoice.total.toFixed(2)));
    $('.inputTotal').attr('value', invoice.total.toFixed(2));
}

if(invoice.itens.length === 0){
    $('.fatura_itens table').hide();
}

$(function() {

    $('.ls-price').maskMoney({thousands:'.', decimal:','});

    $('#tipo_servico').on('change', function () {
        var tipo = $(this).val();

        $.ajax({
            method: "GET",
            url: "/painel/financeiro/planos/tipo/"+tipo,
            dataType: 'json',

            beforeSend: function () {
                $('#produto_servico').html('<option>Carregando...</option>');
            },

            success: function (plans) {
                var html = '';
                if(plans.length > 0){
                    html += '<option value="">Selecione</option>';
                }
                html += $.map(plans, function (plan) {
                    return '<option value="'+plan.id+'" data-html="'+plan.price+'" data-subtext="R$ '+float2moeda(plan.price.toFixed(2))+' - ('+plan.payment_cycle.name+')">'+plan.name+'</option>'
                }).join('');

                $('#produto_servico').html(html);
                $('#produto_servico').selectpicker('refresh');
            }
        });
    });

    $('#produto_servico').selectpicker({
        noneSelectedText: 'Vazio'
    });

    $('#vencimento').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '0d'
    });

    $('.selectClientes').selectpicker({
        liveSearch: true
    }).ajaxSelectPicker({
        ajax: {
            type: 'POST',
            url: '/painel/clientes/buscar/ajax',
            dataType: 'json',
            data: function () {
                var params = {
                    _token: $('[name="_token"]').val(),
                    q: '{{{q}}}'
                };

                return params;
            }
        },
        locale: {
            emptyTitle: 'Selecione um cliente',
            statusInitialized: 'Digite para pesquisar',
            searchPlaceholder: 'Buscar...'
        },
        preprocessData: function(data){

            var i, l = data.length,
                array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push(
                        $.extend(true, data[i], {
                            text: data[i].name,
                            value: data[i].id,
                            data: {
                                'icon' : 'icone-user-1',
                                'subtext': data[i].email
                            }
                        })
                    );
                }
            }
        },
        preserveSelected: false
    });
});