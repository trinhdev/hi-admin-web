$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        theme: "classic"
    });
});

function filter() {
    var from = $('#show_from').val();
    var to = $('#show_to').val();
    var services = $("#services").val();

    $.ajax({
        url: '/reportsalebydate',
        type:'GET',
        data: {
            from: from,
            to: to,
            services: services,
            is_ajax: 1
        },
        success: function (response){
            $('#report-table').html(response);
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showError(errorString);
            console.log(data);
        }
    });
}