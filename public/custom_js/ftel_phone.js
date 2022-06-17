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
        responsive: true,
        autoWidth: true,
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
                extend: 'collection',
                text: 'Show options',
                autoClose: true,
                buttons: [
                    {
                        extend: 'colvisGroup',
                        text: 'Show all',
                        show: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]
                    },
                    {
                        extend: 'colvisGroup',
                        text: 'Hide all',
                        hide: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]
                    },
                    {
                        extend: 'colvisGroup',
                        text: 'Show default (After hide all)',
                        show: [1,2,3,4,5]
                    }
                ],
                dropup: true
            },
            'colvis'
        ],
        "columnDefs": [
            {
                "targets": [6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],
                "visible": false
            }
        ]
    });
}
