function readURL(value, url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var files = $(value)[0].files[0];
    var formData = new FormData();
    formData.append("file", files, files.name);
    $.ajax({
        type: 'POST',
        // datatype: 'JSON',
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            if (data.url) {
                $("#img_icon").attr('src', '/images/upload/' + data.url);
            }
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showError(errorString);
        }
    });
}

function deleteButton(id, name) {
    Swal.fire({
        title: 'Xóa sản phẩm',
        html: `Bạn có chắc muốn xóa sản phẩm <span class="badge bg-warning text-dark">${name}</span>?`,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Huỷ',
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Đồng ý',
        reverseButtons: true

    }).then((result) => {
        if (result.isConfirmed) {
            console.log(id);
            // form.submit();
            // let submitBtn = $(form).closest('form').find('button').append('&ensp;<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
            // $('form').find(':button').prop('disabled', true);
            // $("#spinner").addClass("show");
        }
    });
}

function cancelButton(url) {
    Swal.fire({
        title: 'Đóng biểu mẫu',
        html: `Các thông tin đã nhập sẽ không được lưu?`,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Huỷ',
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Đồng ý',
        reverseButtons: true

    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

function openDetail(url) {
    $.ajax({
        url: url,
        success: function (result) {
            if (result) {
                console.log(result);
                $("#icon-modal-body").html('');
                $("#icon-modal-body").html(result);
                $('#iconModal').modal();
            }
        },
        error: function (jqXHR, testStatus, error) {
            console.log(error);
        },
    })
}

function filterStatusPheDuyet(tableId) {
    var table = $(tableId).DataTable();
    var statusFilterArr = [];
    var pheduyetFilterArr = [];
    $("#filter-status input[name='status']").filter(function () {
        var status = $(this).val();
        if (this.checked) {
            statusFilterArr.push(status);
        }
        else {
            // statusFilterArr.remove(status);
            statusFilterArr = $.grep(statusFilterArr, function (value) {
                return value != status;
            });
        }
    });

    $("#filter-status input[name='pheduyet']").filter(function () {
        var pheduyet = $(this).val();
        if (this.checked) {
            pheduyetFilterArr.push(pheduyet);
        }
        else {
            // statusFilterArr.remove(status);
            pheduyetFilterArr = $.grep(pheduyetFilterArr, function (value) {
                return value != pheduyet;
            });
        }
    });

    if (statusFilterArr) {
        table.column(4).search(statusFilterArr.join('|'), true);
    }
    if (pheduyetFilterArr) {
        table.column(5).search(pheduyetFilterArr.join('|'), true);
    }
    table.draw();
    $('#filter-status').modal('toggle');
}