@extends('layoutv2.layout.app')

@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)
                            <a id="addBanner" href="#" class="btn btn-primary mright5 test pull-left display-block">
                                <i class="fa-regular fa-plus tw-mr-1"></i>
                                Thêm mới banner</a>
                            <a href="#" class="btn btn-primary pull-left display-block mright5 hidden-xs"
                               id="updateBannerFconnect">
                                <i class="fa-solid fa-upload tw-mr-1"></i>Update banner fconnect
                            </a>
                        @endif

                        <a href="#" onclick="alert('Liên hệ zalo 0354370175 nếu xảy ra lỗi không mong muốn!')" class="btn btn-default pull-left display-block mright5">
                            <i class="fa-regular fa-user tw-mr-1"></i>Liên hệ
                        </a>
                        <div class="visible-xs">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            @include('banners.filter')
                            <div class="clearfix mtop20"></div>
                            <div class="panel-table-full">
                                {{ $dataTable->table(['id' => 'banner_manage']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('template.modal', ['id' => 'showDetailBanner_Modal', 'title'=>'Form banner', 'form'=>'banners.detail'])
    @include('banners.update-banner-fconnect')
    @include('template.modal', ['id' => 'show_form_export', 'title'=>'Export Data User Click', 'form'=>'banners.export'])
@endsection
@push('script')
    {{ $dataTable->scripts() }}
    <script>
        let table = $('#banner_manage');
        table.on('preXhr.dt', function (e, settings, data) {
            data.daterange = $('#daterange').val();
            data.bannerType = $('#select_filter').val();
        });

        $(document).ready(function () {
            methodAjaxBanner();
        });
    </script>
    <script src="{{ asset('/custom_js/bannermanage.js')}}"></script>
@endpush
