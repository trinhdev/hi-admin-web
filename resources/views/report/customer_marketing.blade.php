@extends('layouts.default')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="float: left; margin-right: 20px" class="uppercase">Báo cáo thông tin khách hàng</h1>
                    <div style="float: left; width: 300px">
                        <form style="float: left; margin-right: 20px" action="{{ route('importlogreportcustomerinfomarketing.uploadFile') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label class="btn btn-primary btn-sm" id="upload-label" for="apply"><input type="file" name="excel" id="apply" accept=".xlsx, .xls" onchange="form.submit()">Upload file</label>
                        </form>
                        @if(session('error'))
                            <label style="float: left; color: red">{{ session('error') }}</label>
                        @endif
                        <a href="http://upload-static.fpt.net/sys/hifpt/report/helper/test_import_customer_report.xlsx">File import mẫu</a>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Báo cáo thông tin khách hàng</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-body col-sm-12">
                {{-- <div class="container">

                </div> --}}
                {{-- <div class="card-body row form-inline filter-section">
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Từ: </div>
                            </div>
                            <input type="date" name="show_from_last" class="form-control" id="show_from_last" placeholder="Date From" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Đến: </div>
                            </div>
                            <input type="date" name="show_to_last" class="form-control" id="show_to_last" placeholder="Date To" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Từ: </div>
                            </div>
                            <input type="date" name="show_from" class="form-control" id="show_from" placeholder="Date From" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-sm mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Đến: </div>
                            </div>
                            <input type="date" name="show_to" class="form-control" id="show_to" placeholder="Date To" />
                        </div>
                    </div>
                    <div class="col-md-12" style="text-align: center">
                        <button id="filter_condition" class="btn btn-sm btn-primary">Tìm kiếm</button>
                    </div>
                </div> --}}
                {{--Start table--}}
                {{ $dataTable->table([], true) }}
                {{--End table--}}
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<style>
    .chart-legend li span{
        display: inline-block;
        width: 12px;
        height: 12px;
        margin-right: 5px;
    }

    .chart-legend{
    height:250px;
    overflow:auto;
    }

    .chart-legend li{
    cursor:pointer;
    }

    .strike{
        text-decoration: line-through !important;
    }

    .float-left{
        float:left;
    }

    #upload-label {
        /* display: block; */
        /* width: 60vw; */
        /* max-width: 300px; */
        margin: 0 auto;
        /* background-color: slateblue; */
        border-radius: 2px;
        font-size: 1em;
        line-height: 2.5em;
        text-align: center;
        padding: 0 5px
    }

    #upload-label:hover {
        background-color: cornflowerblue;
    }

    #upload-label:active {
        background-color: mediumaquamarine;
    }

    input {
        border: 0;
        clip: rect(1px, 1px, 1px, 1px);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }
</style>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        setInterval(function () {
            var table = $('#customer_marketing').DataTable();
            table.ajax.reload();
        }, 10000);
    </script>
@endpush
