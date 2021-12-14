@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px">Settings Table</h1>
                        @if(Auth::user()->role_id == config('constants.ADMIN') || $aclCurrentModule->create == 1)
                        <a href="/settings/create" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add new setting
                        </a>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Setting v1</li>
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
                    <table id="settings" class="display nowrap" style="width:100%">
                        </thead>
                    </table>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <style>
        table.dataTable.nowrap td {
            white-space: unset;
        }
    </style>
@endsection