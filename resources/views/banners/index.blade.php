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
                        <a href="#" class="btn btn-primary pull-left display-block mright5 hidden-xs"
                           id="updateBannerFconnect">
                            <i class="fa-solid fa-upload tw-mr-1"></i>Update banner fconnect
                        </a>
                        <a href="#" onclick="alert('Liên hệ zalo 0354370175 nếu xảy ra lỗi không mong muốn!')" class="btn btn-default pull-left display-block mright5">
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
                                        Filter 1
                                    </a>
                                </li>
                                <div class="clearfix"></div>
                                <li class="divider"></li>
                                <li class="dropdown-submenu pull-left responsible_admin">
                                    <a href="#" tabindex="-1">Vị trí hiển thị</a>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        <li>
                                            <a href="#" data-cview="">
                                                None data
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="member_filter">
                                        <label for="member_filter" class="control-label">Vị trí hiển thị</label>
                                        <div class="dropdown bootstrap-select show-tick bs3" style="width: 100%;">
                                            <select id="select_filter" class="selectpicker" data-actions-box="1" data-width="100%"
                                                    data-none-selected-text="Không có mục nào được chọn"
                                                    data-live-search="true" tabindex="-98">
                                                <option data-subtext="Không có mục nào được chọn"></option>
                                                @forelse($list_type_banner as $type)
                                                    <option class="text-capitalize" value="{{$type->key}}" data-subtext="{{$type->key}}">{{$type->name}}</option>
                                                @empty
                                                    <option value="1" data-subtext="Trình">Huỳnh</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="from_date">
                                        <label for="daterange" class="control-label">Từ ngày</label>
                                        <div class="input-group date">
                                            <input id="daterange"  class="form-control daterange" type="text" name="daterange"
                                                   placeholder="Nhập ngày hiển thị" autocomplete="off"/>
                                            <div class="input-group-addon">
                                                <i class="fa-regular fa-calendar calendar-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-table-full">
                                {{ $dataTable->table(['id' => 'banner_manage'], $footer = false) }}
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
