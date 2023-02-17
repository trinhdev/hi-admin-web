@extends('layoutv2.layout.app')
@livewireStyles
@section('content')
    <div id="wrapper">
        <div class="content">
            <form action="{{ route('general_settings.edit') }}" id="settings-form" class=""
                  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="tw-font-semibold tw-mt-0 tw-text-neutral-800"> Cài đặt </h4>
                        <ul class="nav navbar-pills navbar-pills-flat nav-tabs nav-stacked">
                            <li class="settings-group-general">
                                <a href="http://perfex.local/admin/settings?group=general" data-group="general">
                                    <i class="fa fa-cog menu-icon"></i>
                                    Tổng quan

                                </a>
                            </li>
                            <li class="settings-group-cronjob active">
                                <a href="http://perfex.local/admin/settings?group=cronjob" data-group="cronjob">
                                    <i class="fa-solid fa-microchip menu-icon"></i>
                                    Email chu kì/Cron Job

                                </a>
                            </li>
                            <li class="settings-group-tags">
                                <a href="http://perfex.local/admin/settings?group=tags" data-group="tags">
                                    <i class="fa-solid fa-tags menu-icon"></i>
                                    Các thẻ

                                </a>
                            </li>
                            <li class="settings-group-pusher">
                                <a href="http://perfex.local/admin/settings?group=pusher" data-group="pusher">
                                    <i class="fa-regular fa-bell menu-icon"></i>
                                    Pusher.com

                                </a>
                            </li>
                            <li class="settings-group-google">
                                <a href="http://perfex.local/admin/settings?group=google" data-group="google">
                                    <i class="fa-brands fa-google menu-icon"></i>
                                    Google

                                </a>
                            </li>
                            <li class="settings-group-misc">
                                <a href="http://perfex.local/admin/settings?group=misc" data-group="misc">
                                    <i class="fa-solid fa-gears menu-icon"></i>
                                    Khác

                                </a>
                            </li>
                        </ul>
                        @include('settings.includes.infomation')

                        <div class="btn-bottom-toolbar text-right">
                            <button type="submit" class="btn btn-primary">
                                Lưu lại cài đặt
                            </button>
                        </div>
                    </div>
                    @include('settings.includes.cronjob')
                    <div class="clearfix"></div>
                </div>
            </form>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <div id="new_version"></div>
@endsection
@livewireScripts
@push('script')
@endpush
