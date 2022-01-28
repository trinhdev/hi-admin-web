@extends('layouts.default')

@section('content')
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="iconModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết vị trí</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="icon-modal-body"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <!-- Modal -->

    {{-- Modal filter --}}
    <div class="modal fade" id="filter-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lọc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><b>Trạng thái</b></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-6">Tất cả</label>
                        <div class="col-sm-6 icheck-primary" style="width: auto">
                            <input type="checkbox" id="status-all" value="all" />
                            <label class="float-right" for="status-all"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-6">Trạng thái hiện</label>
                        <div class="col-sm-6 icheck-primary" style="width: auto">
                            <input type="checkbox" id="status-show" name="status" value="1" />
                            <label class="float-right" for="status-show"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-6">Trạng thái ẩn</label>
                        <div class="col-sm-6 icheck-primary" style="width: auto">
                            <input type="checkbox" id="status-hide" name="status" value="0" />
                            <label class="float-right" for="status-hide"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12"><b>Phê duyệt</b></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-6">Tất cả</label>
                        <div class="col-sm-6 icheck-primary" style="width: auto">
                            <input type="checkbox" id="pheduyet-all" value="all" />
                            <label class="float-right" for="pheduyet-all"></label>
                        </div>
                    </div>
                    @foreach($icon_approve as $approve)
                    <div class="form-group row">
                        <label class="col-form-label col-sm-6">{{ $approve['value'] }}</label>
                        <div class="col-sm-6 icheck-primary" style="width: auto">
                            <input type="checkbox" id="pheduyet-{{ strtolower(str_replace(' ', '', convert_vi_to_en($approve['value']))) }}" name="pheduyet" value="{{ $approve['value'] }}" />
                            <label class="float-right" for="pheduyet-{{ strtolower(str_replace(' ', '', convert_vi_to_en($approve['value']))) }}"></label>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onClick="filterStatusPheDuyet('#icon-category')">Lọc</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="float: left; margin-right: 20px" class="uppercase">Quản lý danh mục sản phẩm</h1>
                        @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->create == 1)
                        <a href="{{$controller}}/{{$action_edit}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Thêm mới danh mục
                        </a>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách danh mục</li>
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
                        <table id="icon-category" class="display nowrap" style="width: 100%">
                        </table>                                          
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

        .df-switch {
            margin-top: 20px;
            padding: 2rem;
            /* text-align: center; */
        }
        .btn-toggle {
            top: 50%;
            transform: translateY(-50%);
        }
        .btn-toggle {
            margin: 0 4rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.5rem;
            width: 5rem;
            border-radius: 1.5rem;
            color: #6b7381;
            background: #0885da;
        }
        .btn-toggle:focus,
        .btn-toggle.focus,
        .btn-toggle:focus.active,
        .btn-toggle.focus.active {
            outline: none;
        }
        .btn-toggle:before,
        .btn-toggle:after {
            line-height: 1.5rem;
            width: 4rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }
        .btn-toggle:before {
            content: 'SHOW';
            left: -5rem;
            color: #109fff;
        }
        .btn-toggle:after {
            content: 'HIDE';
            right: -5rem;
            opacity: 0.5;
            color: #F47280;
        }
        .btn-toggle > .inner-handle {
            border-radius: 13px;
            width: 65px;
            height: 13px;
            position: absolute;
            top: 6px;
            left: 8px;
            background-color: #0f71bd;
            box-shadow: inset 1px 1px 2px -1px black;
        }
        .btn-toggle.active > .inner-handle {
            background-color: #BD4053;
        }
        .btn-toggle > .handle:before {
            content: "";
            position: absolute;
            height: 34px;
            width: 34px;
            top: 35%;
            left: 11px;
            background-image: radial-gradient(circle at center, #0785da 5px, transparent 5px);
            background-size: 10px 10px;
            background-repeat: no-repeat;
        }
        .btn-toggle.active > .handle:before {
            background-image: radial-gradient(circle at center, #F47280 5px, transparent 5px);
        }
        .btn-toggle > .handle {
            position: absolute;
            top: -0.2875rem;
            left: 0.3875rem;
            width: 2.125rem;
            height: 2.125rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
            border: 1px solid #ccc;
        }
        .btn-toggle.active {
            transition: background-color 0.25s;
        }
        .btn-toggle.active > .handle {
            left: 2.4175rem;
            transition: left 0.25s;
        }
        .btn-toggle.active:before {
            opacity: 0.5;
        }
        .btn-toggle.active:after {
            opacity: 1;
            color: #F47280;
        }
        .btn-toggle.active {
            background-color: #F47280;
        }

        .product-detail {
            width: 100%; margin: 0 20px
        }

        .product-detail .title {
            width: 25%;
            font-weight: bold
        }

        #icon-category_filter {
            float: left;
        }

        .dt-buttons {
            float: right;
        }

        #filter-status .col-form-label {
            font-weight: unset!important;
        }

        #filter-status .form-group {
            margin-bottom: 0
        }
    </style>

    <script id="product-title-detail-template" type="text/x-jquery-tmpl">
        
    </script>

    <script id="product-in-product-title-detail-template" type="text/x-jquery-tmpl">
        <li>${productNameVi}</li>
    </script>
@endsection