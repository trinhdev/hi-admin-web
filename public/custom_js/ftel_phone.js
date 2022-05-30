"use strict";

function changeFileFtelPhone() {
    $('#number_phone_import').change(function() {
        $('#importExcel').submit();
    });
}

function datatableFtelPhoneExport(){
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
                extend: 'colvisGroup',
                text: 'Show all',
                show: [ 1, 2, 3 ,4, 5 ,6,7,8,9  ]
            },
            'colvis'
        ],
        "columnDefs": [
            {
                "targets": [ 6,7,8,9 ],
                "visible": false
            }
        ]

    });
}
