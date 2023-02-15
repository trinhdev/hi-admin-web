@extends('layoutv2.layout.app')

@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        <a id="addBanner" href="#" class="btn btn-primary mright5 test pull-left display-block">
                            <i class="fa-regular fa-plus tw-mr-1"></i>
                            Thêm mới</a>
                        <a href="#" class="btn btn-primary pull-left display-block mright5 hidden-xs" id="updateBannerFconnect">
                            <i class="fa-solid fa-upload tw-mr-1"></i>Update banner fconnect
                        </a>
                        <a href="#" class="btn btn-default pull-left display-block mright5">
                            <i class="fa-regular fa-user tw-mr-1"></i>Liên hệ
                        </a>
                        <div class="visible-xs">
                            <div class="clearfix"></div>
                        </div>
                        <div class="btn-group pull-right mleft4 btn-with-tooltip-group _filter_data"
                             data-toggle="tooltip"
                             data-title="Được lọc theo">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-left" style="width:300px;">
                                <li class="divider"></li>
                                <li class="dropdown-submenu pull-left responsible_admin">
                                    <a href="#" tabindex="-1">
                                        <input id="daterange" type="text" name="daterange" placeholder="Nhập ngày hiển thị"/>
                                    </a>
                                </li>
                                <div class="clearfix"></div>
                                <li class="divider"></li>
                                <li class="dropdown-submenu pull-left responsible_admin">
                                    <a href="#" tabindex="-1">Vị trí hiển thị</a>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        @forelse($list_type_banner as $type)
                                            <li>
                                                <a onclick="filter(this)" class="show_at text-capitalize" href="#" data-cview="{{$type->key}}">
                                                    {{$type->key .' - '.$type->name}}
                                                </a>
                                            </li>
                                        @empty
                                            <li>
                                                <a href="#" data-cview="">
                                                    None data
                                                </a>
                                            </li>
                                        @endforelse
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <div class="panel-table-full">
                                {{ $dataTable->table(['id' => 'banner_manage'], $footer = false) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('template.modal', ['id' => 'showDetailBanner_Modal', 'title'=>'Thông tin banner', 'form'=>'banners.detail'])
    @include('banners.update-banner-fconnect')
    @include('template.modal', ['id' => 'show_form_export', 'title'=>'Export Data User Click', 'form'=>'banners.export'])
@endsection
@push('script')
    {{ $dataTable->scripts() }}
    <script>
        let table = $('#banner_manage');
        function filter(_this) {
            type = $(_this).attr("data-cview");
            table.on('preXhr.dt', function (e, settings, data) {
                data.bannerType = type;
                data.daterange = $('#daterange').val();
            });
        }
        table.on('preXhr.dt', function (e, settings, data) {
            data.daterange = $('#daterange').val();
        });

        $(document).ready(function () {
            methodAjaxBanner();
        });
    </script>
    <script src="{{ asset('/custom_js/bannermanage.js')}}"></script>
@endpush
