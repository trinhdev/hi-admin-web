@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <?php
    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase">App Log</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">App Log</li>
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
                    <div class="container">
                        <div class="card-body row form-inline">
                            <div class="col-md-4">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Vị Trí Hiển Thị: </div>
                                    </div>
                                    <select class="form-control" name="position" id="show_at" placeholder="Show at">
                                        <option value=''>Tất Cả</option>
                                        @if(!empty($type))
                                            @foreach($type as $value)
                                                <option value="{{$value['type']}}">{{$value['type']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Từ: </div>
                                    </div>
                                    <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Đến: </div>
                                    </div>
                                    <input type="datetime-local" name="show_to" class="form-control" id="show_to" placeholder="Date To" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Table-->
                        {!! $dataTable->table() !!}
                    {{print_r($filter)}}
                    <!--end::Table-->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        const table = $('#app_table');
        table.on('preXhr.dt', function(e, settings, data){
            data.type = $('#show_at').val();
            data.public_date_start = $('#show_from').val();
            data.public_date_end = $('#show_to').val();
        });
    </script>

@endpush
