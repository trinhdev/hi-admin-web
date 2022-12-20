@extends('layouts.default')
@push('header')
    <link media="all" type="text/css" rel="stylesheet" href="{{url('/')}}/base/css/core.css">
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{url()->current()}}">General Settings</a></li>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="clearfix"></div>
        {!! Form::open(['route' => ['general_settings.edit']])!!}
        <div class="max-width-1200">
            <div class="flexbox-annotated-section">
                <div class="flexbox-annotated-section-annotation">
                    <div class="annotated-section-title pd-all-20">
                        <h2 style="font-weight: 500; font-size: 20px !important;">Config Service Payment Unpaid</h2>
                    </div>
                    <div class="annotated-section-description pd-all-20 p-none-t">
                        <p class="color-note">Settings email, enabled, time ...</p>
                    </div>
                </div>

                <div class="flexbox-annotated-section-content">
                    <div class="wrapper-content pd-all-20">
                        <div class="form-group mb-3">

                            <label class="text-title-field form-check-label"
                                   for="admin_locale_direction">Bật service payment unpaid
                            </label>
                            <label class="me-2 form-check-label mt-2">
                                <input type="radio" name="hi_admin_cron_service_check_payment_unpaid_enable" value="1"
                                       @if (setting('hi_admin_cron_service_check_payment_unpaid_enable', '0') === '1') checked @endif>{{ __('Bật') }}
                            </label>
                            <label class=" form-check-label mt-2">
                                <input type="radio" name="hi_admin_cron_service_check_payment_unpaid_enable" value="0"
                                       @if (setting('hi_admin_cron_service_check_payment_unpaid_enable', '0') === '0') checked @endif>{{ __('Tắt') }}
                            </label>
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-title-field form-check-label"
                                   for="hi_admin_cron_service_check_payment_unpaid_list_email">Email người nhận</label>
                            <textarea data-counter="120" type="text" class="next-input mt-2"
                                      name="hi_admin_cron_service_check_payment_unpaid_list_email"
                                      id="hi_admin_cron_service_check_payment_unpaid_list_email">{{ setting('hi_admin_cron_service_check_payment_unpaid_list_email') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flexbox-annotated-section">
                <div class="flexbox-annotated-section-annotation">
                    <div class="annotated-section-title pd-all-20">
                        <h2 style="font-weight: 500; font-size: 20px !important;">Add key settings hi-admin-cron</h2>
                    </div>
                    <div class="annotated-section-description pd-all-20 p-none-t">
                        <p class="color-note">Ex: service_payment, service_auto_send_mail</p>
                    </div>
                </div>

                <div class="flexbox-annotated-section-content">
                    <div class="wrapper-content pd-all-20">
                        <div class="form-group mb-3">
                            <label class="text-title-field form-check-label"
                                   for="hi_admin_cron_service_check_payment_unpaid_list_email">{{ __('Key') }}</label>
                            <input data-counter="120" type="text" class="next-input mt-2"
                                   name="hi_admin_cron_add_key"
                                   id="hi_admin_cron_add_key"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flexbox-annotated-section" style="border: none">
                <div class="flexbox-annotated-section-annotation">
                </div>
                <div class="flexbox-annotated-section-content">
                    <button class="btn btn-info" type="submit">Lưu cài đặt</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@push('scripts')
    <link href="http://martfury.local/vendor/core/core/media/css/media.css?v=1671434393" rel="stylesheet"
          type="text/css"/>
    <script src="http://martfury.local/vendor/core/core/media/js/integrate.js?v=1671434393"></script>
    <script src="http://martfury.local/vendor/core/core/base/libraries/respond.min.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/base/libraries/excanvas.min.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/base/libraries/ie8.fix.min.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/base/libraries/modernizr/modernizr.min.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/base/libraries/select2/js/select2.min.js?v=1.23.2"></script>
    <script
        src="http://martfury.local/vendor/core/core/base/libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js?v=1.23.2"></script>
    <script
        src="http://martfury.local/vendor/core/core/base/libraries/jquery-cookie/jquery.cookie.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/base/js/core.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/base/libraries/toastr/toastr.min.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/base/libraries/pace/pace.min.js?v=1.23.2"></script>
    <script
        src="http://martfury.local/vendor/core/core/base/libraries/mcustom-scrollbar/jquery.mCustomScrollbar.js?v=1.23.2"></script>
    <script
        src="http://martfury.local/vendor/core/core/base/libraries/stickytableheaders/jquery.stickytableheaders.js?v=1.23.2"></script>
    <script
        src="http://martfury.local/vendor/core/core/base/libraries/jquery-waypoints/jquery.waypoints.min.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/base/libraries/spectrum/spectrum.js?v=1.23.2"></script>
    <script
        src="http://martfury.local/vendor/core/core/base/libraries/fancybox/jquery.fancybox.min.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/plugins/language/js/language-global.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/setting/js/setting.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/base/libraries/tagify/tagify.js?v=1.23.2"></script>
    <script src="http://martfury.local/vendor/core/core/base/js/tags.js?v=1.23.2"></script>
@endpush
