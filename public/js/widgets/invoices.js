function viewInvoice(invoice_id){
    $.ajax({
        type: 'GET',
        url: 'faturas/'+invoice_id+'/editar',
        dataType: 'html',
        success: function(data){
            $('#abreModal').modal('show');
            $('.modal-dialog').animate().width('750px');
            $('.modal-content').html(data);
        },
        error: function(error){
            $('#abreModal').modal('show');
            $('.modal-dialog').animate().width('650px');
            $('.modal-content').html(error.responseText);
        }
    });
}
