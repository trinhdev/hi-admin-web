@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px">Modules Tables</h1>
                        <a href="/modules/create" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add new module
                        </a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Modules v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="col-sm-12">
                    <table id="modules" class="display nowrap" style="width:100%">
                        {{-- <thead>
                            <tr>
                                <th>Module name</th>
                                <th>Uri</th>
                                <th>Created at</th>
                                <th>Created by</th>
                                <th>Updated at</th>
                                <th>Updated by</th>
                                <th></th>
                            </tr> --}}
                        </thead>
                    </table>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection