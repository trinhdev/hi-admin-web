@extends('layoutv2.layout.app')

@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)
                            <a onclick="pushPopup()" href="#" class="btn btn-primary mright5 test pull-left display-block">
                                <i class="fa-regular fa-plus tw-mr-1"></i>
                                Thêm mới popup</a>
                        @endif

                        <a href="#" onclick="alert('Liên hệ zalo 0354370175 nếu xảy ra lỗi không mong muốn!')"
                           class="btn btn-default pull-left display-block mright5">
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
                                {{ $dataTable->table(['id' => 'popup_manage_table'], $footer = false) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('template.modal', ['id' => 'show_detail_popup', 'title'=>'Form popup', 'form'=>'popup.detail'])
    @include('template.modal', ['id' => 'show_form_export', 'title'=>'Export Data User Click', 'form'=>'banners.export'])
@endsection
@push('script')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function () {
            showHide();
            $('body').on('click', '#exportPopup', function (e) {
                e.preventDefault();
                $('#show_form_export').modal('toggle');
                document.getElementById('formExport').reset();
                let id = $(this).data('id');
                document.getElementById("formExport").action = "/popupmanage/export/" + id;
            });
        });
    </script>
    <script src="{{ asset('/custom_js/popupmanage.js')}}"></script>
@endpush



