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
                            <li class="breadcrumb-item active"><a href="{{url()->current()}}">Docs Settings</a></li>
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
                        <h2 style="font-weight: 500; font-size: 20px !important;">Cú pháp lịch trình cron</h2>
                    </div>
                    <div class="annotated-section-description pd-all-20 p-none-t">
                        <p class="color-note"></p>
                    </div>
                </div>

                <div class="flexbox-annotated-section-content">
                    <div class="wrapper-content pd-all-20 ">
                        <pre tabindex="0"><code class="border-none"># ┌───────────── minute (0 - 59)
# │ ┌───────────── hour (0 - 23)
# │ │ ┌───────────── day of the month (1 - 31)
# │ │ │ ┌───────────── month (1 - 12)
# │ │ │ │ ┌───────────── day of the week (0 - 6) (Sunday to Saturday;
# │ │ │ │ │                                   7 is also Sunday on some systems)
# │ │ │ │ │                                   OR sun, mon, tue, wed, thu, fri, sat
# │ │ │ │ │
# * * * * *
</code></pre>

                        <table class="table">
                            <thead>
                            <tr>
                                <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sự
                                            miêu tả</font></font></th>
                                <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tương
                                            đương với</font></font></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chạy
                                            mỗi năm một lần vào nửa đêm ngày 1 tháng 1</font></font></td>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0 0 1
                                            1 *</font></font></td>
                            </tr>
                            <tr>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chạy
                                            mỗi tháng một lần vào nửa đêm của ngày đầu tiên của tháng</font></font></td>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0 0 1
                                            * *</font></font></td>
                            </tr>
                            <tr>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chạy
                                            mỗi tuần một lần vào lúc nửa đêm vào sáng Chủ Nhật</font></font></td>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0 0 *
                                            * 0</font></font></td>
                            </tr>
                            <tr>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chạy
                                            một lần một ngày vào lúc nửa đêm</font></font></td>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0 0 *
                                            * *</font></font></td>
                            </tr>
                            <tr>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chạy
                                            mỗi giờ một lần vào đầu giờ</font></font></td>
                                <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0 * *
                                            * *</font></font></td>
                            </tr>
                            </tbody>
                        </table>
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
