
@extends('layoutv2.layout.app')
@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
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
                            <div class="row">
                                <div class="col-md-12">
                                    @include('template.form-import-phone', [
                                    'form'=> 'template.form-import-phone',
                                    'action'=>'',
                                    'button'=>'
                                        <button id="btn-data" type="button" class="action btn btn-info">Submit API</button>
                                        <button id="btn-db" type="button" class="action btn btn-info ml-2">Submit Database </button>'
                                ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <div class="panel-table-full">
                                {{ $dataTable->table(['id' => 'table_manage'], $footer = false) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('template.modal', ['id' => 'showDetail_Modal', 'title'=>'Form nhân viên', 'form'=>'ftel-phone.edit'])
@endsection
@push('script')
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function () {
            postPhone('');
        });
        function detailFtelPhone(_this){
            let dataPost = {};
            dataPost.phone = $(_this).data('phone');
            $.post('/ftel-phone/show', dataPost).done(function(response) {
                console.log(response.data);
                for (let [key, value] of Object.entries(response.data)) {
                    let air_direction = $('#'+key);
                    air_direction.val(value);
                }
                $('#showDetail_Modal').modal('toggle');
                $('body').on('click', '#submitAjax', alert('Chức năng đang bảo trì!'));
                window.urlMethod = '/ftel-phone/update';
            });
        }
    </script>
@endpush




