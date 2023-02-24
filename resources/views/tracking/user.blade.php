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

                            <!--begin::Overview-->
                            <livewire:filter-overview/>
                            <!--end::Overview-->
                            <hr class="hr-panel-separator">
                            <!--begin::Table-->
                            {!! $dataTable->table(['id'=>'user_detail'], $footer = false) !!}
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
            data.daterange = $('#filter_date_datatable').val();
            data.cusId = $('#customer_id').val();
        });
    </script>
@endpush
