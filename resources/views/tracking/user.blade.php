@extends('layoutv2.layout.app')
@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        <a id="addBanner" href="#" class="btn btn-primary mright5 test pull-left display-block">
                            <i class="fa-regular fa-plus tw-mr-1"></i>
                            Connect API</a>
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
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="member_filter">
                                        <label for="member_filter" class="control-label">Vị trí hiển thị</label>
                                        <div class="dropdown bootstrap-select show-tick bs3" style="width: 100%;">
                                            <select id="select_filter" class="selectpicker" data-actions-box="1" data-width="100%"
                                                    data-none-selected-text="Không có mục nào được chọn"
                                                    data-live-search="true" tabindex="-98">
                                                <option data-subtext="Không có mục nào được chọn"></option>
                                                @forelse([1,2,3,4,5,6,7] as $type)
                                                    <option class="text-capitalize" value="{{$type}}">Vung {{$type}}</option>
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
                            <livewire:chart />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <!--begin::Table-->
                            <div class="row">
                                <div class="mbot15">
                                    <h4 class="tw-mt-0 tw-font-semibold tw-text-lg tw-flex tw-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="tw-w-5 tw-h-5 tw-text-neutral-500 tw-mr-1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                        </svg>

                                        <span>
                                    User overview
                                </span>
                                    </h4>
                                    <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-6 tw-gap-2">
                                        @foreach($data as $key => $value)
                                            <div
                                                class="md:tw-border-r md:tw-border-solid md:tw-border-neutral-300 tw-flex-1 tw-flex tw-items-center">
                                                <span
                                                    class="tw-font-semibold tw-mr-3 rtl:tw-ml-3 tw-text-lg"> {{ $value }} </span>
                                                <span
                                                    class="text-capitalize text-success tw-truncate sm:tw-text-clip">{{ explode('_', $key)[0]. ' '. explode('_', $key)[1] }}</span>
                                            </div>
                                        @endforeach
                                        <div
                                            class="tw-flex tw-items-center md:tw-border-r md:tw-border-solid tw-flex-1 md:tw-border-neutral-300 lg:tw-border-r-0">
                                            <span class="tw-font-semibold tw-mr-3 rtl:tw-ml-3 tw-text-lg"> 879345 </span>
                                            <span class="text-muted tw-truncate" data-toggle="tooltip"
                                                  data-title="customers_summary_logged_in_today">
                                                <span class="pointer text-has-action"
                                                      data-toggle="popover"
                                                      data-title="Unique: 2198873"
                                                      data-html="true" data-content="Total: 21982873"
                                                      data-placement="bottom">
                                                    Log today
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Table-->
                            <div class="panel-table-full">
                                {{ $dataTable->table(['id' => 'table-detail'], $footer = false) }}
                            </div>
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
@endpush

