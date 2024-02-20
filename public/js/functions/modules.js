$(function() {

    $('.ls-price').maskMoney({thousands: '.', decimal: ','});

    $('#vencimento').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '0d'
    });
});