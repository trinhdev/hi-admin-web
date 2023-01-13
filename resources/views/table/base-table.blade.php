<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="float: left; margin-right: 20px" class="uppercase"> Quản lí error payment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Phone</li>
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
                        <form class="form-inline">
                            <div class="col-md-3">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="show_at">Type</label>
                                    </div>
                                    <select class="form-control" name="show_at" id="show_at">
                                        <option value="">-- Select --</option>
                                        <option value="0">Chưa tiếp nhận</option>
                                        <option value="1">Đã xử lí</option>
                                        <option value="2">Hủy bỏ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Phone</div>
                                    </div>
                                    <input class="form-control" id="phone_filter" placeholder="Phone Filter" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">From</div>
                                    </div>
                                    <input type="datetime-local" name="show_from" class="form-control" id="show_from"
                                           placeholder="Date From"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">To</div>
                                    </div>
                                    <input type="datetime-local" name="show_to" class="form-control" id="show_to"
                                           placeholder="Date To"/>
                                </div>
                            </div>
                            <div class="filter-class" style="width: 100%; text-align: center">
                                <button type="button" id="filter_condition" class="btn btn-sm btn-primary mb-4">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--begin::Table-->
                <div class="table-wrapper">
                    <div class="portlet light bordered portlet-no-padding">
                        <div class="portlet-body">
                            <div class="table-responsive @if ($table->isHasFilter()) table-has-filter @endif">
                                @section('main-table')
                                    {!! $dataTable->table(['id', 'class'], false) !!}
                                @show
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Table-->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('table.modal')

@push('footer')
    {!! $dataTable->scripts() !!}
@endpush
