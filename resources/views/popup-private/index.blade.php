<!--
Create by: trinhdev
Update at: 2022/06/22
Contact: trinhhuynhdp@gmail.com
-->
@extends('layoutv2.layout.app')

@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)
                            <a id="push_popup_private_form" href="#" class="btn btn-primary mright5 test pull-left display-block">
                                <i class="fa-regular fa-plus tw-mr-1"></i>
                                Thêm mới popup định danh</a>
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
                                {{ $dataTable->table(['id' => 'popup_private_table'], $footer = false) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('template.modal', ['id' => 'push_popup_private', 'title'=>'Thông tin pop up <i class="fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom"
                                                           data-title="Đọc kĩ lưu ý trước khi tải lên popup"></i>', 'form'=>'popup-private._modal_add_update'])
    @include('template.modal', ['id' => 'show_form_export', 'title'=>'Export Data User Click', 'form'=>'banners.export'])
    @include('template.modal', ['title'=> 'Import số điện thoại', 'id'=>'push_phone_number_private', 'form'=> 'template.form-import-phone','action'=>'', 'button'=>'
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Thoát</button>
            <button type="submit" class="btn btn-info ml-2" id="submitPhone">Lưu</button>'])
@endsection
@push('script')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            showHide();
            postPhone('/popup-private/importPrivate');
            methodAjaxPopupPrivate();
            handlePushPopUpPrivate();
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






