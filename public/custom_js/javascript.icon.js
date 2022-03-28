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
                $("#img_icon").attr('src', data.url);
                $("#iconUrl").val(data.url);
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

// function deleteButton(form_data, name, url, ul_id) {
//     var arrayId = [];
//     $("#" + ul_id).find("li").each((key, value) => {
//         arrayId.push($(value).attr('data-prodid'));
//     });
//     // $("#selected-prod-id").val(arrayId.join(','));
//     if (arrayId.length > 0) {
//         Swal.fire({
//             title: 'Cảnh báo',
//             html: `Xin vui lòng xoá trống danh sách sản phẩm được chọn trước khi xoá danh mục`,
//             icon: 'warning',
//             showCancelButton: true,
//             cancelButtonText: 'Huỷ',
//             cancelButtonColor: '#d33',
//             confirmButtonColor: '#3085d6',
//             confirmButtonText: 'Đồng ý',
//             reverseButtons: true

//         })
//     }

//     Swal.fire({
//         title: 'Xóa sản phẩm',
//         html: `Bạn có chắc muốn xóa sản phẩm <span class="badge bg-warning text-dark">${name}</span>?`,
//         icon: 'warning',
//         showCancelButton: true,
//         cancelButtonText: 'Huỷ',
//         cancelButtonColor: '#d33',
//         confirmButtonColor: '#3085d6',
//         confirmButtonText: 'Đồng ý',
//         reverseButtons: true

//     }).then((result) => {
//         if (result.isConfirmed) {
//             var formData = new FormData();
//             // var data = serializeObject(form_data);
//             formData.append('formData', form_data);

//             $.ajaxSetup({
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 }
//             });
//             $.ajax({
//                 type: 'POST',
//                 url: url,
//                 data: formData,
//                 processData: false,
//                 contentType: false,
//                 cache: false,
//                 success: (data) => {
//                     var result = JSON.parse(data);
//                     if (result.result) {
//                         Swal.fire({
//                             title: 'LƯU THÀNH CÔNG',
//                             text: result.message,
//                             icon: 'success',
//                         })
//                     }
//                 },
//                 error: function (xhr) {
//                     var errorString = '';
//                     $.each(xhr.responseJSON.errors, function (key, value) {
//                         errorString = value;
//                         return false;
//                     });
//                     showError(errorString);
//                 }
//             });
//         }
//     });
// }

function deleteButton(from, form_data, name, url, ul_id) {
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
            try {
                var data = JSON.parse(form_data);
            } catch (e) {
                var formData = $(form_data).serializeArray();
                var data = serializeObject(formData);
                // data['_token'] = data['_token'][0];
                delete data['_token'];
                delete data['arrayId'];
                if (ul_id) {
                    var arrayId = [];
                    $("#" + ul_id).find("li").each((key, value) => {
                        arrayId.push($(value).attr('data-prodid'));
                    });
                    data['arrayId'] = arrayId.join(",");
                }
            }
            data['product_type'] = from;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: "json",
                success: (result) => {
                    // var result = JSON.parse(data);
                    if (result.result) {
                        Swal.fire({
                            title: 'Xoá thành công',
                            text: result.message,
                            icon: 'success',
                        }).then((alertOption) => {
                            if (alertOption.isConfirmed) {
                                window.location.href = result.url;
                            }
                        });
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
    });
}

function deleteButtonApprovedRole(form_data, name, url, ul_id) {
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
            try {
                var data = JSON.parse(form_data);
            } catch (e) {
                var formData = $(form_data).serializeArray();
                var data = serializeObject(formData);
                // data['_token'] = data['_token'][0];
                delete data['_token'];
                delete data['arrayId'];
                if (ul_id) {
                    var arrayId = [];
                    $("#" + ul_id).find("li").each((key, value) => {
                        arrayId.push($(value).attr('data-prodid'));
                    });
                    data['arrayId'] = arrayId.join(",");
                }
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: "json",
                success: (result) => {
                    // var result = JSON.parse(data);
                    if (result.result) {
                        Swal.fire({
                            title: 'Xoá thành công',
                            text: result.message,
                            icon: 'success',
                        }).then((alertOption) => {
                            if (alertOption.isConfirmed) {
                                window.location.href = result.url;
                            }
                        });
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

function removeFromSelectedProduct(el) {
    var remove_prod_id = $("#" + el).attr('data-prodid');
    var parent_ul = $($("#" + el).parent());
    $("#" + el).remove();
    parent_ul.find("li").each((key, value) => {
        $(value).find("span.position").text($(value).index() + 1);
    });
}

function onsubmitIconForm(e, form, ul_id, withPopup = true) {
    e.preventDefault();
    var arrayId = [];
    $("#" + ul_id).find("li").each((key, value) => {
        arrayId.push($(value).attr('data-prodid'));
    });
    $("#selected-prod-id").val(arrayId.join(','));

    if (withPopup) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Please Confirm This Action",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Confirmed!',
            reverseButtons: true

        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                let submitBtn = $(form).closest('form').find('button').append('&ensp;<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
                $('form').find(':button').prop('disabled', true);
                $("#spinner").toggle("show");
            }
        });
    } else {
        form.submit();
        let submitBtn = $(form).closest('form').find('button').append('&ensp;<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
        $('form').find(':button').prop('disabled', true);
        $("#spinner").toggle("show");
    }

    if (e.result == true) {
        // $("#spinner").addClass("hide");
        console.log('end submit');
    }
}

function approve(approved_data) {
    Swal.fire({
        title: 'Phê duyệt yêu cầu',
        html: `Thông tin phê duyệt sẽ được lưu?`,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Huỷ',
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Đồng ý',
        reverseButtons: true

    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData();
            formData.append('data', JSON.stringify(approved_data));
            $.ajax({
                type: 'POST',
                url: '/iconapproved/save',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var response = JSON.parse(data);
                    if (response.status) {
                        window.location.href = "/iconapproved";
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
    });
}