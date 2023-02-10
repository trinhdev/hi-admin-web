@extends('layouts.default')
@push('header')
    <link media="all" type="text/css" rel="stylesheet" href="{{url('/')}}/base/css/core.css">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <?php
    ?>
    <div class="content-wrapper">
        @include('template.breadcrumb', ['name' => 'Quản lí banner'])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12">
                    <div class="container">
                        <div class="card-body row form-inline">
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Vị Trí Hiển Thị:</div>
                                    </div>
                                    <select class="form-control" name="position" id="show_at" placeholder="Show at">
                                        <option value=''>Tất Cả</option>
                                        @forelse($list_type_banner as $type)
                                            <option value="{{$type->key}}">&#8920; {{ $type->key}}
                                                &#x22D9;: {{$type->name}}</option>
                                        @empty
                                            <option>API Error</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend ">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i>&nbsp;</div>
                                    </div>
                                    <input class="form-control" id="daterange" type="text" name="daterange" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm mb-4">
                                    <button id="filter_condition" class="btn btn-sm btn-primary">Time filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Start table--}}
                    {{ $dataTable->table([], $footer = false) }}
                    {{--End table--}}
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    @include('template.modal', ['id' => 'showDetailBanner_Modal', 'title'=>'Thông tin banner', 'form'=>'banners.detail'])
    @include('template.modal', ['id' => 'showFormUpdateFconnect_Modal', 'title'=>'Update banner fconnect', 'form'=>'banners.update-banner-fconnect'])
    @include('template.modal', ['id' => 'show_form_export', 'title'=>'Export Data User Click', 'form'=>'banners.export'])
    <!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        const table = $('#banner_manage');
        table.on('preXhr.dt', function (e, settings, data) {
            data.bannerType = $('#show_at').val();
            data.daterange = $('#daterange').val();
        });

        function showHideTitle(_this) {
            $('.hide' + _this).show();
            $('.show' + _this).hide();
        }

        $(document).ready(function () {
            methodAjaxBanner();
        });
    </script>
    <script src="{{ asset('/custom_js/bannermanage.js')}}"></script>
@endpush
