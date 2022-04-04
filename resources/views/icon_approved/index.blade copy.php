@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="font-weight: bold">Quản lý sản phẩm</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách sản phẩm dịch vụ</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 20px">
                    <div class="card card-body col-sm-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="tab" aria-controls="pills-home" aria-selected="true" href="#pills-home">Trang chủ</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-product-tab" data-toggle="tab" aria-controls="pills-product" aria-selected="false" href="#pills-product">Sản phẩm</a>
                            </li>
                        </ul>
                        <div class="tab-content row" id="pills-tabContent">
                            <div class="tab-pane fade show active col-sm-12" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <table id="icon-management-home" class="display nowrap" style="width: 100%">
                                </table>
                            </div>
                            <div class="tab-pane fade col-sm-12" id="pills-product" role="tabpanel" aria-labelledby="pills-product-tab">
                                <table id="icon-management-product" class="display nowrap" style="width: 100%">
                                </table>
                            </div>
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

        .modem-info {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
@endsection