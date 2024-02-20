

$('[rel="suspendSubscription"]').on('click', function(){
    $("#dialogSuspender").dialog('open');
});

$(document).ready(function() {
    $("#dialogSuspender").dialog({
        modal: true,
        autoOpen: false,
        height: 'auto',
        width: 300,
        draggable:false,
        buttons: {
            Confirmar: function() {
                alert('confirmado.');
                $(this).dialog('close');
            },
            Cancelar: function() {
                $(this).dialog('close');
            }
        },
    });
});