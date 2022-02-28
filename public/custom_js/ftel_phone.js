"use strict";

function changeFileFtelPhone() {
    $('#number_phone_import').change(function() {
        $('#importExcel').submit();
    });
}

function datatableFtelPhoneExport() {
    $('#phoneExport').DataTable({
        processing: true,
        lengthChange: false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'
        ],
        columnDefs: [
            { "visible": false, "targets": 5 }
          ]
    });
}
