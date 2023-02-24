@extends('layoutv2.layout.app')
@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
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
                            <livewire:filter/>
                            <livewire:chart-filter/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <!--begin::Filter-->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="member_filter" class="control-label">Customer ID</label>
                                        <input id="customer_id" class="form-control" type="text" name="customer_id"
                                               placeholder="Nhập ID khách hàng" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="daterange" class="control-label">Lọc ngày</label>
                                        <div class="input-group date">
                                            <input id="filter_date" class="form-control daterange" type="text"
                                                   name="daterange"
                                                   placeholder="Nhập ngày hiển thị" autocomplete="off"/>
                                            <div class="input-group-addon">
                                                <i class="fa-regular fa-calendar calendar-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Filter-->
                            <!--begin::Overview-->
                            <div class="row mbot15">
                                <div class="col-md-12">
                                    <h4 class="tw-mt-0 tw-font-semibold tw-text-lg tw-flex tw-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="tw-w-5 tw-h-5 tw-text-neutral-500 tw-mr-1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                        </svg><span> Tổng quan  </span>
                                    </h4>

                                </div>
                                <div class="_filters _hidden_inputs">
                                    <input type="hidden" name="my_projects" value="">
                                    <input type="hidden" name="project_status_1" value="1">
                                    <div
                                        class="col-md-2 col-xs-6 md:tw-border-r md:tw-border-solid md:tw-border-neutral-300 last:tw-border-r-0">
                                        <a href="#"
                                           class="tw-text-neutral-600 hover:tw-opacity-70 tw-inline-flex tw-items-center"
                                           onclick="dt_custom_view('project_status_1','.table-projects','project_status_1',true); return false;">
                                        <span class="tw-font-semibold tw-mr-3 rtl:tw-ml-3 tw-text-lg">
                                            0                                        </span>
                                            <span style="color:#475569">
                                            Chưa bắt đầu                                        </span>
                                        </a>
                                    </div>

                                    <input type="hidden" name="project_status_2" value="2">
                                    <div
                                        class="col-md-2 col-xs-6 md:tw-border-r md:tw-border-solid md:tw-border-neutral-300 last:tw-border-r-0">
                                        <a href="#"
                                           class="tw-text-neutral-600 hover:tw-opacity-70 tw-inline-flex tw-items-center"
                                           onclick="dt_custom_view('project_status_2','.table-projects','project_status_2',true); return false;">
                                        <span class="tw-font-semibold tw-mr-3 rtl:tw-ml-3 tw-text-lg">
                                            0                                        </span>
                                            <span style="color:#2563eb">
                                            Đang thực hiện                                        </span>
                                        </a>
                                    </div>

                                    <input type="hidden" name="project_status_3" value="3">
                                    <div
                                        class="col-md-2 col-xs-6 md:tw-border-r md:tw-border-solid md:tw-border-neutral-300 last:tw-border-r-0">
                                        <a href="#"
                                           class="tw-text-neutral-600 hover:tw-opacity-70 tw-inline-flex tw-items-center"
                                           onclick="dt_custom_view('project_status_3','.table-projects','project_status_3',true); return false;">
                                        <span class="tw-font-semibold tw-mr-3 rtl:tw-ml-3 tw-text-lg">
                                            0                                        </span>
                                            <span style="color:#f97316">
                                            Tạm ngưng                                        </span>
                                        </a>
                                    </div>

                                    <input type="hidden" name="project_status_5" value="">
                                    <div
                                        class="col-md-2 col-xs-6 md:tw-border-r md:tw-border-solid md:tw-border-neutral-300 last:tw-border-r-0">
                                        <a href="#"
                                           class="tw-text-neutral-600 hover:tw-opacity-70 tw-inline-flex tw-items-center"
                                           onclick="dt_custom_view('project_status_5','.table-projects','project_status_5',true); return false;">
                                        <span class="tw-font-semibold tw-mr-3 rtl:tw-ml-3 tw-text-lg">
                                            0                                        </span>
                                            <span style="color:#94a3b8">
                                            Đã hủy                                        </span>
                                        </a>
                                    </div>

                                    <input type="hidden" name="project_status_4" value="">
                                    <div
                                        class="col-md-2 col-xs-6 md:tw-border-r md:tw-border-solid md:tw-border-neutral-300 last:tw-border-r-0">
                                        <a href="#"
                                           class="tw-text-neutral-600 hover:tw-opacity-70 tw-inline-flex tw-items-center"
                                           onclick="dt_custom_view('project_status_4','.table-projects','project_status_4',true); return false;">
                                            <span
                                                class="tw-font-semibold tw-mr-3 rtl:tw-ml-3 tw-text-lg"> 0</span>
                                            <span style="color:#16a34a"> Hoàn thành </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end::Overview-->
                            <hr class="hr-panel-separator">
                            <!--begin::Table-->
                            {!! $dataTable->table(['width' => '100%', 'id'=>'user_detail']) !!}
                            <!--end::Table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
@endsection

@push('script')
    {!! $dataTable->scripts() !!}

    <script>
        let table = $('#user_detail');
        table.on('preXhr.dt', function (e, settings, data) {
            data.daterange = $('#filter_date').val();
            data.cusId = $('#customer_id').val();
        });
    </script>
@endpush
