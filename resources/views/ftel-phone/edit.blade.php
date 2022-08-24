@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update information employees FPT Telecom</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-sm-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title uppercase">Form Phone Number </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('ftel_phone.update', [$data->id]) }}" method="post"
                                      onSubmit="handleSubmit(event,this)">
                                    @csrf
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="phone">Số điện thoại</label>
                                        <input class="col-md-8 form-control" type="text" name="phone"
                                               value="{{ $data->phone }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="name">Tên</label>
                                        <input class="col-md-8 form-control" type="text" name="name"
                                               value="{{ $data->name }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="full_name">Tên đầy đủ</label>
                                        <input class="col-md-8 form-control" type="text" name="full_name"
                                               value="{{ $data->full_name }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="emailAddress">Email</label>
                                        <input class="col-md-8 form-control" type="text" name="emailAddress"
                                               value="{{ $data->emailAddress }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="location_id">ID vị trí</label>
                                        <input class="col-md-8 form-control" type="text" name="location_id"
                                               value="{{ $data->location_id }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="branch_code">Mã chi nhánh</label>
                                        <input class="col-md-8 form-control" type="text" name="branch_code"
                                               value="{{ $data->branch_code }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="description">Mô tả</label>
                                        <input class="col-md-8 form-control" type="text" name="description"
                                               value="{{ $data->description }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="code">code</label>
                                        <input class="col-md-8 form-control" type="text" name="code"
                                               value="{{ $data->code }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="organizationCode">organizationCode</label>
                                        <input class="col-md-8 form-control" type="text" name="organizationCode"
                                               value="{{ $data->organizationCode }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="organizationCodePath">organizationCodePath</label>
                                        <input class="col-md-8 form-control" type="text" name="organizationCodePath"
                                               value="{{ $data->organizationCodePath }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="location">Vị trí</label>
                                        <input class="col-md-8 form-control" type="text" name="location"
                                               value="{{ $data->location }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="employee_code">Mã nhân viên</label>
                                        <input class="col-md-8 form-control" type="text" name="employee_code"
                                               value="{{ $data->employee_code }}" readonly>
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="organizationNamePath">organizationNamePath</label>
                                        <input class="col-md-8 form-control" type="text" name="organizationNamePath"
                                               value="{{ $data->organizationNamePath }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="dept_id">dept_id</label>
                                        <input class="col-md-8 form-control" type="text" name="dept_id"
                                               value="{{ $data->dept_id }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2" for="branch_name">Tên chi nhánh</label>
                                        <input class="col-md-8 form-control" type="text" name="branch_name"
                                               value="{{ $data->branch_name }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2"
                                               for="organization_zone_name">organization_zone_name</label>
                                        <input class="col-md-8 form-control" type="text" name="organization_zone_name"
                                               value="{{ $data->organization_zone_name }}">
                                    </div>
                                    <div class="form-group d-flex">
                                        <label class="col-md-2"
                                               for="organization_branch_code">organization_branch_code</label>
                                        <input class="col-md-8 form-control" type="text" name="organization_branch_code"
                                               value="{{ $data->organization_branch_code }}">
                                    </div>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <ul>
                                                <b>Note</b>: Thông tin nhân viên cần độ chính xác cao, vui lòng xem kĩ trước khi update dữ liệu, mọi yêu cầu hỗ trợ khi gặp sự cố vui lòng liên hệ <a
                                                    href="https://zalo.me/0354370175"
                                                    target="_blank"> <b> zalo</b><a/>)
                                            </ul>
                                        </ol>
                                    </nav>
                                    <div class="card-footer" style="text-align: center">
                                        <button name="button" type="submit" class="btn btn-info">Update
                                        </button>
                                        <a href="{{ route('ftel_phone.index') }}" type="button"
                                           class="btn btn-default">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <style>
        select {
            font-family: 'Lato', 'Font Awesome 5 Free', 'Font Awesome 5 Brands';
        }
    </style>
@endsection
