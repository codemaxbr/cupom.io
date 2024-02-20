var Customers = {
    processingSearchLimit: 30,
    route: 'customers',
    table: null,
    logo: null,
    dataFilter: {},
    contactsSelected: [],
    account_id: null,

    getAll: function (dataFilter) {
        $.ajax({
            async: true,
            type: 'POST',
            url: 'api/'+ Customers.route,
            data: {
                limit: dataFilter,
                account: $('body').data('id'),
            },
            dataType: 'json',
            beforeSend: function(){
                //para de processar caso não exista widget seja fechado.
                $('#tabela_clientes_info').append('<span class="carregando_dados"><img src="dist/img/ajax-loader.gif" /> Recebendo dados...</span>');
            },

            success: function(response) {

                var clientes = response.clientes;

                $(clientes).each(function(i, rows) {

                    Customers.table.fnAddData({
                        "id": rows.id,
                        "name": rows.name,
                        "mobile": rows.mobile,
                        "email": rows.email,
                        "cpf": rows.cpf,
                        "city": rows.city,
                        "cnpj": rows.cnpj,
                        "type": rows.type,
                        "status": rows.status,
                    });
                });

                if(clientes != null){
                    if( clientes.length >= Customers.processingSearchLimit ){
                        dataFilter += Customers.processingSearchLimit;

                        window.setTimeout(function() {
                            Customers.getAll(dataFilter);
                        }, 200);
                    }
                }else{
                    $('.carregando_dados').fadeOut();
                }
            },

            error: function(error) {
                //para de processar caso não exista widget seja fechado.
                console.log(error.responseText);
            }
        });
    },

    view: function (id) {
        $.ajax({
            async: true,
            type: 'GET',
            url: 'api/'+ Customers.route +'/'+ id,
            dataType: 'json',
            data:{
                account: $('body').data('id'),
            },
            beforeSend: function(){
                console.log('Buscando dados do cliente...');
            },

            success: function (response) {
                console.log(response);
            },

            error: function (error) {
                console.log(error);
            }
        });
    },

    export: function(tipo){
        $.ajax({
            async: true,
            type: 'GET',
            url: 'api/'+ Customers.route + '/'+ Customers.account_id,
            dataType: 'json',
            data: {
                account: $('body').data('id'),
            },
            beforeSend: function(){
                //para de processar caso não exista widget seja fechado.
                console.log('exportando...');
                //$('#tabela_clientes_info').append('<span class="carregando_dados"><img src="../assets/admin/dist/img/ajax-loader.gif" /> Recebendo dados...</span>');
            },

            success: function(json) {
                var logo = json.logo_empresa;
                var empresa = json.empresa;
                var clientes = json.data;

                switch(tipo){
                    case 'print':

                        var content = '<style type="text/css">';
                            content += '*{';
                            content += '-webkit-print-color-adjust: exact;';
                            content += '-moz-print-color-adjust: exact;';
                            content += 'font-family: Arial, sans-serif;';
                            content += 'font-size: 12px;';
                            content += '}';
                            content += 'table{';
                            content += '    width: 100%;';
                            content += '    border: 1px solid #ccc;';
                            content += '    margin-bottom: 10px;';
                            content += '}';
                            content += 'table thead th{';
                            content += '    background: #eee;';
                            content += '    text-align: left;';
                            content += '    font-style: normal;';
                            content += '    font-weight: normal;';
                            content += '}';
                            content += 'table td{';
                            content += '    line-height: 17px;';
                            content += '}';
                            content += '</style>';

                            content += '<img src="'+logo+'" style="width:200px;" />';

                            $(clientes).each(function(i, row){
                                content += '<table width="100%" cellspacing="0" cellpadding="5px">';
                                    content += '<thead>';
                                        content += '<th colspan="2"><b>ID</b> '+row.id+'</th>';
                                        content += '<th colspan="2">Criado em: '+row.data+'</th>';
                                    content += '</thead>';

                                    content += '<tbody>';
                                        content += '<td valign="middle"></td>';
                                        content += '<td>';
                                            content += '<b>'+row.name+'</b><br />';
                                            if(row.type == 'fisica'){
                                                content += '<b>CPF: </b>'+row.cpf+'<br />';
                                                content += '<b>Data Nascimento: </b>'+row.birthdate+'<br />';
                                            }else{
                                                content += '<b>CNPJ: </b>'+row.cnpj+'<br />';
                                                content += '<b>Inscrição Municipal: </b>'+row.reg_city+'<br />';
                                            }
                                            
                                            content += '<b>Tel: </b>'+row.phone+' - <b>Cel: </b>'+row.mobile+'<br />';
                                            content += '<b>E-mail: </b>'+row.email+'<br />';
                                            content += '<b>E-mail para Nfe: </b>'+row.email_nfe+'<br />';
                                        content += '</td>';
                                        content += '<td>';
                                            content += row.address+', '+row.number+'<br />';
                                            content += row.additional+'<br />';
                                            content += row.district+' - '+row.city+', '+row.uf+'<br />';
                                            content += 'CEP: '+row.zipcode;
                                        content += '</td>';
                                        content += '<td>';
                                            content += 'Total de Débitos<br />';
                                            content += '<b>R$ 0,00</b>';

                                            content += '<hr />';

                                            content += 'Total de Créditos<br />';
                                            content += '<b>R$ 0,00</b>';
                                        content += '</td>';
                                    content += '</tbody>';
                                content += '</table>';
                            });

                        var w = window.open("");

                        w.document.write(content);
                        w.print();
                        w.close();

                        break;
                    
                    case 'CSV':
                        var content = 'ID;Tipo Pessoa;Nome;CPF;CNPJ;E-mail;Telefone;Celular;Email NFe;Inscrição Municipal;Inscrição Estadual;RG;Data de Nascimento;Endereço;Número;Cidade;UF;Bairro;Complemento;Data de Cadastro;\r\n';
                        
                        $(clientes).each(function(i, row) {
                            content += row.id+';'+row.type+';'+row.name+';'+row.cpf+';'+row.cnpj+';'+row.email+';'+row.phone+';'+row.mobile+';'+row.email_nfe+';'+row.reg_city+';'+row.reg_state+';'+row.rg+';'+row.birthdate+';'+row.address+';'+row.number+';'+row.uf+';'+row.district+';'+row.additional+';'+row.data+'\r\n';
                        });            

                        var a         = document.createElement('a');
                        a.href        = 'data:attachment/csv,' +  escape(content);
                        a.target      = '_blank';
                        a.download    = 'Clientes.csv';

                        document.body.appendChild(a);
                        a.click();

                        break;

                    case 'PDF':
                        var columns = ["Nome / Razão Social", "Fone", "E-mail", "CPF / CNPJ", "Cidade"];
                        var rows = [];

                        $(clientes).each(function(i, row){
                            var fone = '';
                            if(row.phone == ''){
                                fone = row.mobile;
                            }else{
                                fone = row.phone;
                            }

                            var cpf_cnpj = '';

                            if(row.type == 'fisica'){
                                cpf_cnpj = row.cpf;
                            }else{
                                cpf_cnpj = row.cnpj;
                            }

                            rows.push([row.name, fone, row.email, cpf_cnpj, row.city+', '+row.uf]);
                        });

                        var doc = new jsPDF('l', 'pt');

                        var dataCurrente = new Date();
                        var year = dataCurrente.getFullYear();
                        var month = dataCurrente.getMonth() + 1;
                        var day = dataCurrente.getDate();

                        doc.autoTable(columns, rows, {
                            theme: 'striped', // 'striped', 'grid' or 'plain'
                            headerStyles: {
                                fillColor: [0, 147, 147],
                                color: [255, 255, 255]
                            },
                            bodyStyles: {
                                overflow: 'linebreak', // visible, hidden, ellipsize or linebreak
                            },
                            margin: {
                                top: 100
                            },
                            beforePageContent: function(canvas) {
                                var width = doc.internal.pageSize.width / 6;    
                                var height = doc.internal.pageSize.height / 12;

                                //var imgData = logo;
                                //doc.addImage(imgData, 'PNG', 40, 30);
                            }
                        });
                        doc.save("Clientes_"+year+"-"+month+"-"+day+".pdf");

                        break;
                }
            },

            error: function(error){
                console.log(error.responseText);
            },

            complete: function(){

            }
        });
    },

    verCliente: function(id){
        $.ajax({
            type: 'GET',
            url: 'customers/'+id,
            dataType: 'html',
            success: function(data){
                $('#abreModal').modal('show');
                $('.modal-dialog').animate().width('700px');
                $('.modal-content').html(data);
            },
            error: function(error){
                $('#abreModal').modal('show');
                $('.modal-dialog').animate().width('700px');
                $('.modal-content').html(error.responseText);
            }
        });
    },

    modalAdd: function(){
        $.ajax({
            type: 'GET',
            url: 'customers/add_new',
            dataType: 'html',
            success: function(data){
                $('#abreModal').modal('show');
                $('.modal-dialog').animate().width('700px');
                $('.modal-content').html(data);
            },
            error: function(error){
                $('#abreModal').modal('show');
                $('.modal-dialog').animate().width('700px');
                $('.modal-content').html(error.responseText);
            }
        });
    },

    modalMensagem: function(itens){

        $.ajax({
            type: 'POST',
            url: 'clientes/newMessage/',
            dataType: 'json',
            data: {selecionados: itens},
            success: function(data){
                console.log(data);

                $('#abreModal').modal('show');
                $('.modal-dialog').animate().width('600px');
                $('.modal-content').html(data);
            },
            error: function(error){
                $('#abreModal').modal('show');
                $('.modal-dialog').animate().width('600px');
                $('.modal-content').html(error.responseText);
            }
        });
    },
};

$(function() {
    var dataFilter = 0;
    Customers.account_id = $('body').data('id');

    /*
    Customers.table = $('#tabela_clientes').DataTable({
        "processing": false,
        "serverSide": true,
        "ajax": 'api/'+ Customers.route + '/'+ Customers.account_id,
        "sDom": "lrtip",
        paginate: true,
        bLengthChange: true,
        bFilter: true,
        "bRetrieve": true,
        bInfo: true,
        "iDisplayLength": 15, //total de registros por página
        "ordering": true,
        "sPaginationType": "bootstrap",
        "pagingType": "simple_numbers",
        "oLanguage": {
            "sProcessing":   "Carregando...",
            "sZeroRecords":  "Não foram encontrados resultados",
            "sInfo":         "Exibindo _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Exibindo 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix":  "",
            "sSearch":       "Buscar:",
            "oPaginate": {
                "sFirst":    "Início",
                "sPrevious": "Anterior",
                "sNext":     "Próximo",
                "sLast":     "Final"
            }
        },
        "columns": [
            {
                'data': 'id',
                "orderable": false,
                'render': function (data, type, full, meta) {
                    return '<input type="checkbox" name="item[]" nome="'+full.name+'" class="td_item" value="'+data+'" />';
                }
            },

            {
                'data': 'name',
                'render': function (data, type, full, meta) {
                    return '<a onClick="Customers.verCliente('+full.id+')">'+data+'</a>';
                }
            },

            {
                'data': 'email',
                'render': function (data, type, full, meta) {
                    return  '<i class="icone-mail"></i>'+data;
                }
            },

            {
                'data': 'phone',
                'render': function (data, type, full, meta) {

                    if(full.phone === ''){
                        return full.mobile;
                    }else{
                        return full.phone;
                    }
                }
            },

            {'data': 'cpf_cnpj'}
        ]
    });
    */

    $('.rows_lenght').append($('.dataTables_length'));
    $('.info_dataTable').append($('.dataTables_info'));
    $(".pags_dataTable").append($(".dataTables_paginate"));

    $('.input_busca').on('keyup', function () {
        var oTable = Customers.table;
        oTable.search( this.value ).draw();
    } );


    $('#lista_cadastros').on('change', '.td_item', function() {

        if ($(this).prop("checked")) {
            //do the stuff that you would do when 'checked'
            Customers.contactsSelected.push({id: $(this).attr('value'), nome: $(this).attr('nome')});

        }else{
            Customers.contactsSelected.splice( $.inArray($(this).val(),Customers.contactsSelected) ,1 );
        }
    });

    $('[rel="excluirClientes"]').on('click', function(){
        var selecionados = Customers.contactsSelected;

        if(selecionados.length > 0){
            $('b.qtd_select').html(selecionados.length);
            $("#modalExcluir").modal('show');
        }else{
            alert("Nenhum cliente foi selecionado.");
        }

    });

    $('[rel="submitDel_cliente"]').on('click', function(){
        $.ajax({
            type: 'DELETE',
            url: 'clientes/remover',
            dataType: 'json',
            data: {
                itens: Customers.contactsSelected,
                _token: $('[name="_token"]').val()
            },
            beforeSend: function(){
                $('[rel="submitDel_cliente"]').html('<i class="icone-spin6 animate-spin"></i> Carregando...');
            },
            success: function(data){
                if(data === true){
                    window.location.href = "clientes";
                }
            },
            error: function(error){
                $('.modal-content').html(error.responseText);
            }
        });
    });

    $(".selecionaTodos").click(function () {

        //seleciona
        if($(this).is(':checked')){
            Customers.contactsSelected = [];

            $(".td_item").prop('checked', $(this).prop('checked'));

            $('#lista_cadastros .td_item:checked').each(function() {
                Customers.contactsSelected.push({id: $(this).attr('value'), nome: $(this).attr('nome')});
            });

        }else{ // não seleciona

            Customers.contactsSelected = [];
            $(".td_item").prop('checked', $(this).prop('checked'));
        }
    });

    $('.dataTable').on('click','[rel="verCliente"]', function(event){
        event.preventDefault();

        var id = $(this).data('id');
        Customers.verCliente(id);
    });

    $('[rel="enviarMensagem"]').on('click', function(){
        Customers.modalMensagem(Customers.contactsSelected);
    });

    $('[rel="addCliente"]').on('click', function(event){
        event.preventDefault();

        Customers.modalAdd();
    });

    $('[rel="excluirCliente"]').on('click', function(event){
        event.preventDefault();

        if(Customers.contactsSelected.length > 0){
            $.ajax({
                type: 'GET',
                url: 'customers/deleteCustomer',
                dataType: 'html',
                beforeSend: function(){
                    $('.modal-content').html('Carregando...');
                },
                success: function(data){
                    $('#abreModal').modal('show');
                    $('.modal-dialog').animate().width('300px');
                    $('.modal-content').html(data);
                },
                error: function(error){
                    $('#abreModal').modal('show');
                    $('.modal-dialog').animate().width('300px');
                    $('.modal-content').html(error.responseText);
                }
            });
        }else{
            toastr.info('Você deve selecionar os clientes que deseja excluir.', 'Nota');
        }
    });


    $(".formatTEL").inputmask("(99) 9999-9999", {"placeholder": "(00) 0000-0000"});
    $(".formatCEP").inputmask("99999-999", {"placeholder": "00000-000"});
    $(".formatCEL").inputmask("(99) 9999-99999", {"placeholder": "(00) 0000-0000 "});
    $(".formatCPF").inputmask("999.999.999-99", {"placeholder": "000.000.000-00"});
    $(".formatCNPJ").inputmask("99.999.999/9999-99", {"placeholder": "00.000.000/0000-00"});

    $.fn.clickToggle = function(func1, func2) {
        var funcs = [func1, func2];
        this.data('toggleclicked', 0);
        this.click(function() {
            var data = $(this).data();
            var tc = data.toggleclicked;
            $.proxy(funcs[tc], this)();
            data.toggleclicked = (tc + 1) % 2;
        });
        return this;
    };

    $('.search-advanced #tipo').on('change', function () {
        var tipo = $(this).val();

        if(tipo === "fisica"){
            $('.div_cpf').show();
            $('.div_cnpj').hide();
        }else{
            $('.div_cnpj').show();
            $('.div_cpf').hide();
        }
    });

    $('.bt_searchAdvanced').clickToggle(function() {
        $('.search-advanced').slideDown();
    }, function() {
        $('.search-advanced').slideUp();
    });

    $('.datepickerr').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR',
        weekStart: 0,
        todayHighlight: true
    });

    var start, end ;
    /*

    function cb(start, end) {
        $('.daterange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }


    $('.daterange').daterangepicker({
        startDate: start,
        endDate: end,
        opens: 'left',
        ranges: {
            'Hoje': [moment(), moment()],
            'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 Dias': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
            'Este mês': [moment().startOf('month'), moment().endOf('month')],
            'Mês passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            format: "DD/MM/YYYY",
            separator: " - ",
            applyLabel: "Aplicar",
            cancelLabel: "Cancelar",
            fromLabel: "Apartir de",
            toLabel: "Até",
            customRangeLabel: "Personalizado",
            daysOfWeek: [
                "Dom",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sab"
            ],
            monthNames: [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
            firstDay: 1
        }
    }, cb);

    cb(start, end);
    */

    /* File Uploader
    $('.upload_arquivo').fileuploader({
        changeInput: '<div class="fileuploader-input">' +
                        '<div class="fileuploader-input-inner">' +
                            '<img src="/images/fileuploader-dragdrop-icon.png">' +
                            '<h3 class="fileuploader-input-caption"><span>Arraste seu arquivo aqui</span></h3>' +
                            '<p>ou</p>' +
                            '<div class="fileuploader-input-button"><span>Importar arquivo</span></div>' +
                        '</div>' +
                      '</div>',
        theme: 'dragdrop',
        limit: 1,
        extensions: ['csv', 'txt'],
        upload: {
            url: '/clientes/importarArquivo',
            data: {
                _token : $('[name="_token"]').val(),
                //arquivo: $('.upload_arquivo').val()
            },
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            onSuccess: function(result, item){
                $('.result_import').html(result);
            },
            onError: function(item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
                    item.html.find('.progress-bar2').fadeOut(400);
                }

                item.upload.status !== 'cancelled' && item.html.find('.fileuploader-action-retry').length === 0 ? item.html.find('.column-actions').prepend(
                    '<a class="fileuploader-action fileuploader-action-retry" title="Tentar de novo?"><i></i></a>'
                ) : null;
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
        /*
        onRemove: function(item) {
            $.post('./php/ajax_remove_file.php', {
                file: item.name
            });
        },

        captions: {
            feedback: 'Arraste e solte os arquivos aqui',
            feedback2: 'Arraste e solte os arquivos aqui',
            drop: 'Arraste e solte os arquivos aqui'
        }
    });
*/
});