function getURL(url){
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'html',
        beforeSend: function(){
            //$('#loading_popup').html()
        },
        success: function(data){
            $('.content-wrapper').html(data);
        },
        error: function(error){
            $('.content-wrapper').html(error.responseText);
        }
    });
}

$('a[rel="getURL"]').on('click', function(event){
    event.preventDefault();

    var url = $(this).attr('url');
    $.ajax({
        type: 'GET',
        url: url,
        success: function(data){
            $('.content-wrapper').html(data);
        },
        error: function(error){
            //$('.content-wrapper').html(error.responseText);
            if(error.statusText === "Unauthorized")
            {
                window.location.href = './login';
            }

            if(error.statusText === "Not Found")
            {
                $('.content-wrapper').html("Essa página ou rota não existe.");
            }
        }
    });

});

