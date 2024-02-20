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

$(function (){
    $('.ls-price').maskMoney({thousands:'.', decimal:','});

    $('.terms').on('change', function (){
        var terms = $(this).val();

        // Recorrente
        if (terms == 1) {
            $('.input-parcelas').hide();
            $('.input-ciclo').show();
            $('.input-trial').show();
            $('.ls-price').removeAttr('disabled').removeClass('disabled');
        }

        // Gratuito
        if(terms == 2){
            $('.input-parcelas').hide();
            $('.input-ciclo').hide();
            $('.input-trial').hide();

            $('.ls-price').attr('disabled', 'disabled').addClass('disabled');
        }

        // Único
        if(terms == 3){
            $('.input-ciclo').hide();
            $('.input-parcelas').show();
            $('.input-trial').show();
            $('.ls-price').removeAttr('disabled').removeClass('disabled');
        }
    });

    $('.input-parcelas').hide();
    $('.input-ciclo').show();
    $('.input-trial').show();
    $('.ls-price').removeAttr('disabled').removeClass('disabled');

});