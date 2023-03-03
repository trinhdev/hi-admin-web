
<!-- Create by: trinhdev || Update at: 2022/06/22 || Contact: trinhhuynhdp@gmail.com -->
@extends('layoutv2.layout.app')
@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        <a href="{{ route('screen.create') }}" class="btn btn-primary mright5 test pull-left display-block">
                            <i class="fa-regular fa-plus tw-mr-1"></i>
                            Thêm mới</a>
                        <a href="#" onclick="alert('Liên hệ trinhhdp nếu xảy ra lỗi không mong muốn!')" class="btn btn-default pull-left display-block mright5">
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
                                {{ $dataTable->table(['id' => 'screen_manage'], $footer = false) }}
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
        function deleteScreen(data){
            let dataPost = {};
            dataPost.id = $(data).data('id');
            $.post('/screen/delete', dataPost).done(function(response) {
                alert_float('success', response.message);
                $('#screen_manage').DataTable().ajax.reload(null,false);
            });
        }
    </script>
@endpush



