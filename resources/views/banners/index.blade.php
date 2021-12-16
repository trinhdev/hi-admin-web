@extends('layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="float: left; margin-right: 20px">Banner Manage</h1>
                    @if(Auth::user()->role_id == config('constants.ADMIN') || $aclCurrentModule->create == 1)
                    <a href="{{ route('bannermanage.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add new Banner
                    </a>
                    @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Banner Manage</li>
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
                    <div class="card-body row col-sm-9">
                        <div class="col md-3 form-inline" >
                            <label for="show_at">Show At: </label>
                            <select class="form-control" name="position" id="show_at" placeholder="Show at" onchange="filterData()">
                                <option>1</option>
                                <option>hahahahahah</option>
                            </select>
                        </div>
                        <div class="col md-3 form-inline">
                            <label for="show_from">Show From: </label>
                            <input type="date" name="show_from"class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                        </div>
                        <div class="col md-3 form-inline">
                            <label for="show_to">Show To: </label>
                            <input type="date" name="show_to"class="form-control" id="show_to" placeholder="Date To" onchange="filterData()"/>
                        </div>
                    </div>
                </div>

                <table id="banner_manage" class="display nowrap" style="width:100%">
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
