"use strict";

function changeFileFtelPhone() {
    $('#number_phone_import').change(function() {
        $('#importExcel').submit();
    });
}

function datatableFtelPhoneExport() {
    $('#phoneExport').DataTable({
        processing: true
    });
}
