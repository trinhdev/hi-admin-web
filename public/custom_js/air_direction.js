'use strict';

function handlePushAirDiretion() {
    $('body').on('click', '#submit', function (event){
        $(this).attr('disabled','disabled');
        event.preventDefault();
        let data = $('#formActionAirDiretion').serialize();
        $.ajax({
            url: urlMethod,
            type: 'POST',
            dataType: 'json',
            data: data,
            cache: false,
            success: (data) => {
                if(data.data.statusCode === 0){
                    $('#push_air_direction').modal('toggle');
                    showSuccess(data.data.message);
                    $('#submit').prop('disabled', false);
                    var table = $('#air_direction_table').DataTable();
                    table.ajax.reload();
                }else{
                    showMessage('error',data.data.message);
                    $('#submit').prop('disabled', false);
                }
            },
            error: function (xhr) {
                var errorString = '';
                $.each(xhr.responseJSON.errors, function (key, value) {
                    errorString = value;
                    return false;
                });
                showMessage('error',errorString);
                $('#submit').prop('disabled', false);
            }
        });
    });
}

function methodAjaxAirDirection() {
    $('body').on('click', '#push_air_direction_form', function (e) {
        e.preventDefault();
        document.getElementById('formActionAirDiretion').reset();
        $('#push_air_direction').modal('toggle');
        window.urlMethod = '/air-direction/add';
    });

    $('body').on('click', '#detailAirDirection', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/air-direction/getById/',
            type:'POST',
            data: {
                id: id
            }, success: function (response){
                console.table(response);
                for (const [key, value] of Object.entries(response)) {
                    let air_direction = $('#'+key+'_air_direction');
                    air_direction.val(value);
                    air_direction.trigger('change');
                }
                $('#push_air_direction').modal('toggle');
                window.urlMethod = '/air-direction/update';
            }
        });


    });
}

function deleteAirDirection(data){
    let id = $(data).data('id');
    let key = $(data).data('key');
    $.ajax({
        url: '/air-direction/delete',
        type:'POST',
        data: {
            id: id, key: key
        }, success: function (response){
            showSuccess(response.message);
            var table = $('#air_direction_table').DataTable();
            table.ajax.reload();
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showMessage('error',errorString);
            console.log(xhr);
        }
    });
}
