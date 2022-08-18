$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        // theme: "classic",
        closeOnSelect: false
    });
});

function filter() {
    var from1 = $('#show_from1').val();
    var to1 = $('#show_to1').val();
    var from = $('#show_from').val();
    var to = $('#show_to').val();
    var services = $("#services").val();

    $.ajax({
        url: '/reportsalebydate',
        type:'GET',
        data: {
            from1: from1,
            to1: to1,
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