@extends('layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="float: left; margin-right: 20px" class="uppercase">Quản Lý Popup</h1>
                    @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)
                    <a href="{{ route('popupmanage.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Thêm Mới
                    </a>
                    @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý Popup</li>
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
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Vị Trí Hiển Thị: </div>
                                </div>
                                <select class="form-control" name="popupType" id="show_at" placeholder="Show at" onchange="filterData()">
                                    <option value=''>Tất Cả</option>
                                    @if(!empty($list_template_popup))
                                    @foreach($list_template_popup->type as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Từ: </div>
                                </div>
                                <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Đến: </div>
                                </div>
                                <input type="datetime-local" name="show_to" class="form-control" id="show_to" placeholder="Date To" onchange="filterData()" />
                            </div>
                        </div>
                    </div>
                </div>

                <table id="popup_manage" class="display" style="width:100%;">
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    <script>
        var listTemplateJson = '{!! json_encode($list_template_popup->type) !!}';
        var tempRouteView = '{{ route('popupmanage.view') }}';
        var tempRouteEdit = '{{ route('popupmanage.edit') }}';
    </script>
@endsection
