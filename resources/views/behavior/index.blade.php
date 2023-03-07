@extends('layoutv2.layout.app')
@section('content')
    @php
        $data = session()->get('data');
    @endphp
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        <a id="push_air_direction_form" href="#" class="btn btn-primary mright5 test pull-left display-block">
                            <i class="fa-regular fa-plus tw-mr-1"></i>
                            Thêm mới điều hướng</a>
                        <a href="#" onclick="alert('Liên hệ trinhhdp@fpt.com.vn nếu xảy ra lỗi không mong muốn!')" class="btn btn-default pull-left display-block mright5">
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
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <p>*** LƯU Ý ***<br> - Nếu như tải lên file exel, Tải file mẫu
                                            <a href="https://docs.google.com/spreadsheets/d/1SRdXHP-QdOcPkGpGspGxxBLSNAmcH3TBWwA98w-Q9fY/edit#gid=0"
                                               target="_blank"> <b> tại đây</b> </a>
                                        </p>
                                    </div>
                                    {!! Form::open(array('url' => route('behavior.post'),'id' => 'importExcel', 'method'=>'post' ,'enctype' =>'multipart/form-data')) !!}
                                    @csrf

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="control-label">Số điện thoại khách hàng</div>
                                            <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Số điện thoại" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Từ ngày </label>
                                            <input type="text" name="show_from" class="form-control datepicker" id="show_from" placeholder="Date From" aria-invalid="false" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Đến ngày</label>
                                            <input type="text" name="show_to" class="form-control datepicker" id="show_to" placeholder="Date To" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Hoặc tải lên file excel</label>
                                            <input onchange="uploadFile()" type="file" id="number_phone_import" name="excel"
                                                   class= "form-control" accept=".xlsx,.csv">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label"></label>
                                        <div class="input-group date">
                                            <button type="submit" value="data" class=" tw-mt-1 btn btn-info">Submit </button>
                                        </div>

                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <div class="panel-table-full">
                                @include('behavior.export')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#behaviorExport').DataTable({
        processing: true,
        lengthChange: false,
        responsive: true,
        autoWidth: true,
        initComplete: function(settings, json) {
            this.wrap(`<div class='table-responsive'></div>`);
            this.parents('.table-loading').removeClass('table-loading');
            this.removeClass('dt-table-loading');
            var btnReload = $('.btn-dt-reload');
            btnReload.attr('data-toggle', 'tooltip');
            btnReload.attr('title', 'Tải lại');
        },
        dom: "<'row'><'row'<'col-md-7'lB><'col-md-5'f>>rt<'row'<'col-md-4'i><'col-md-8 dataTables_paging'<'#colvis'><'.dt-page-jump'>p>>",
        buttons: [
            {
                extend: 'collection',
                text: 'Xuất ra',
                autoClose: true,
                attr: {
                    class: 'btn btn-default buttons-collection btn-sm btn-default-dt-options'
                },
                buttons: [
                    {
                        text: 'Excel',
                        excel: 'excel',
                    },
                    {
                        text: 'CSV',
                        excel: 'csv',
                    },
                    {
                        text: 'PDF',
                        excel: 'pdf',
                    },
                    {
                        text: 'Print',
                        excel: 'print',
                    },
                ]
            },
            {
                extend: 'collection',
                text: '<i class="fa fa-refresh"></i>',
                autoClose: true,
                attr: {
                    class: 'btn btn-default btn-sm btn-default-dt-options btn-dt-reload'
                },
                action: 'function ( e, dt, node, config ) {dt.ajax.reload();}',
            }
        ]
    });
    </script>
@endpush


