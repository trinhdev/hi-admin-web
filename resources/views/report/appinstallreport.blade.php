@extends('layouts.default')

@section('content')
    <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase">App installed report</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Report</li>
                            <li class="breadcrumb-item active">App installed</li>
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
                    <div class="row" style="margin-bottom: 20px">
                        <label class="col-sm-3 text-right">Từ ngày</label>
                        <input id="min" type="text" class="datepicker col-sm-2 form-control">

                        <label class="col-sm-3 text-right">Đến ngày</label>
                        <input id="max" type="text" class="datepicker col-sm-2 form-control">
                    </div>
                    <div class="row" style="margin-bottom: 50px">
                        <div class="col text-center">
                            <button class="btn btn-info" onClick="search()">Tìm kiếm</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="appinstallreportday" class="table table-hover table-striped" style="width:100%">
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="appinstallreportweek" class="table table-hover table-striped" style="width:100%">
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="appinstallreportmonth" class="table table-hover table-striped" style="width:100%">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <style>
        .dataTables_wrapper {
            margin-bottom: 50px
        }

        div.dt-buttons {
            float: right
        }
    </style>
@endsection

@push('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>
        const startOfMonth = moment().startOf('month').format('DD-MM-YYYY');
        const endOfMonth   = moment().endOf('month').format('DD-MM-YYYY');
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
        });

        $('#min').datepicker('update', startOfMonth);

        $('#max').datepicker('update', endOfMonth);

        function search() {
            $('#appinstallreportday').DataTable().draw();
            $('#appinstallreportweek').DataTable().draw();
            $('#appinstallreportmonth').DataTable().draw();
        }
    </script>
@endpush