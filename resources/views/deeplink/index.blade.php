<!-- Create by: trinhdev || Update at: 2022/06/22 || Contact: trinhhuynhdp@gmail.com -->
@extends('layoutv2.layout.app')
@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        <a id="push_air_direction_form" href="/deeplink/create" class="btn btn-primary mright5 test pull-left display-block">
                            <i class="fa-regular fa-plus tw-mr-1"></i>
                            Thêm mới deeplink</a>
                        <a href="#" onclick="alert('Liên hệ trinhhdp@fpt.com.vn nếu xảy ra lỗi không mong muốn!')" class="btn btn-default pull-left display-block mright5">
                            <i class="fa-regular fa-user tw-mr-1"></i>Liên hệ
                        </a>
                        <div class="visible-xs">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <div class="panel-table-full">
                                {{ $dataTable->table(['id' => 'Deeplink_manage'], $footer = false) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {!! $dataTable->scripts() !!}

    <script>
        function deleteItem(data){
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let dataPost = {};
                    dataPost.id = $(data).data('id');
                    let url = '/deeplink/delete/' + dataPost.id;
                    $.post(url, dataPost).done(function(response) {
                        const status = (response.data.statusCode === 0) ? 'success' : 'danger';
                        alert_float(status, response.data.message);
                        var table = $('#Deeplink_manage').DataTable();
                        table.ajax.reload(null,false);
                    });
                }
            });

        }
    </script>
@endpush



