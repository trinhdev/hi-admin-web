@extends('layouts.default')

@section('content')
<div class="content-wrapper" id="content-wrapper-new">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Icon management</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-sm-9">
                    {!! Form::open(array('url' => route('iconcategory.save'),'method'=>'post' ,'id' => 'icon-category-form','action' =>'index','class'=>'form-horizontal','enctype' =>'multipart/form-data', 'onsubmit'=>"onsubmitIconForm(event,this,'selected-product')")) !!}
                    @csrf
                    <input type="hidden" name="productTitleId" value="{{ @$data['productTitleId'] }}" />
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title uppercase">{{ (!empty($data['productTitleId'])) ? 'Cập nhật' : 'Thêm' }} Danh Mục</h3>
                            @if(Session::get('approved_data'))
                            <h3 class="card-title uppercase" style="color: red; font-weight: bold; float: right">*{{ (!empty(Session::get('approved_data.user_requested_by.name'))) ? Session::get('approved_data.user_requested_by.name') : Session::get('approved_data.requested_by') }} đã yêu cầu @switch(Session::get('approved_data.approved_type'))
                                @case('create')
                                    <span>thêm</span>
                                    @break
                                @case('update')
                                    <span>cập nhật</span>
                                    @break
                                @case('delete')
                                    <span>xóa</span>
                                    @break
                            
                                @default
                                    
                            @endswitch sản phẩm này</h3>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <div class="card-body" style="max-height: 600px; overflow-y: scroll"> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group" style="text-align: center">
                                        <img id="img_icon" src="{{ (!empty($data['iconUrl'])) ? $data['iconUrl'] : '/images/image_logo.png' }}" alt="" width="150" class="mb-4">
                                        <!-- Upload image input-->
                                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-gray shadow-sm">
                                            <input id="upload" name="icon_img" type="file" onchange="readURL(this);" class="form-control border-0">
                                            <label id="upload-label" for="upload" style="color: white; font-weight: bold">Upload image</label>
                                            <div class="input-group-append">
                                                <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                            </div>
                                        </div>
                                        <div style="color: #ffaf8d">
                                            <p class="font-italic text-center" style="margin-bottom: 0">Các kiểu định dạng file được chấp nhận</p>
                                            <p class="font-italic text-center"><b>jpeg, png, jpg, gif, svg</b></p>
                                            <p class="font-italic text-center">Dung lượng upload tối đa: <b>2048</b></p>
                                        </div>
                                        
                                        <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Tên danh mục</label>
                                        <div class="col-sm-9">
                                            <input type="name" style="margin-bottom: 15px" class="form-control" id="vi-name" placeholder="Tên tiếng Việt" name="productTitleNameVi" value="{{ @$data['productTitleNameVi'] }}">
                                            <input type="name" class="form-control" id="en-name" placeholder="Tên tiếng Anh" name="productTitleNameEn" value="{{ @$data['productTitleNameEn'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Mô tả danh mục</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="4" id="comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái hiển thị</label>
                                <div class="row">
                                    <div class="col-sm-2 offset-sm-1">
                                        <div class="icheck-sunflower">
                                            <input type="radio" id="status-show" name="status" value="hide" checked />
                                            <label for="status-show">Bật</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="icheck-sunflower">
                                            <input type="radio" id="status-hide" name="status" value="show" />
                                            <label for="status-hide">Tắt</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-11 offset-sm-1">
                                        <div class="form-group">
                                            <div class="icheck-sunflower">
                                                <input type="radio" id="status-clock" name="status" value="clock" />
                                                <label for="status-clock">Hẹn giờ bật hiển thị</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="status-clock-date-time" style="display: none">
                                    <div class="row">
                                        <div class="col-sm-7 offset-sm-1">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Ngày bắt đầu</label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="show_from" class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-7 offset-sm-1">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Ngày bắt đầu</label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="show_from" class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Danh sách sản phẩm</label>
                                <input type="hidden" id="selected-prod-id" name="arrayId" value="{{ $data['arrayId'] }}"/>
                                <div class="row">
                                    <div class="direct-chat-msg">
                                        <img class="direct-chat-img" src="/images/information.png" alt="">
                                        <div style="background-color: #6C757D; color: #ffffff" class="direct-chat-text">Kéo thả sản phẩm từ bên dưới danh sách <b><i>"Tất cả sản phẩm"</i></b> vào ô thứ tự để sắp xếp vị trí tương ứng</div>
                                    </div>
                                </div>
                                <div class="card card-info">
                                    <div class="card-body">
                                        <ul class="row" style="list-style: none; min-height: 100px" id="selected-product">
                                            @foreach ($data['productListInTitle'] as $key => $value)
                                                <li class="col-sm-2" style="text-align: center" id="{{ @$value['productId'] }}-selected-product" data-prodid="{{ @$value['productId'] }}">
                                                    <img src="{{ $value['iconUrl'] }}" alt="{{ $value['productNameVi'] }}">
                                                    <br>
                                                    <button type="button" class="close-thik" onClick="removeFromSelectedProduct('{{ @$value['productId'] }}-selected-product')"><i class="fas fa-times-circle"></i></button>
                                                    <h6><span class="badge badge-dark">{{ $value['productNameVi'] }}</span></h6>
                                                    <h6><span class="badge badge-warning position">{{ $key + 1 }}</span></h6>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Tất cả sản phẩm</label>
                                <div class="card card-info">
                                    <div class="card-body" style="background-color: #6C757D">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <ul id="all-product" style="list-style: none">
                                                    @foreach ($data['productList'] as $key => $value)
                                                        <li style="text-align: center" id="{{ @$value['productId'] }}" data-prodid="{{ @$value['productId'] }}">
                                                            <img src="{{ $value['iconUrl'] }}" alt="{{ $value['productNameVi'] }}">
                                                            <br>
                                                            <button type="button" class="close-thik" onClick="removeFromSelectedProduct('{{ @$value['productId'] }}-selected-product')"><i class="fas fa-times-circle"></i></button>
                                                            <h6><span class="badge badge-light">{{ $value['productNameVi'] }}</span></h6>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (Session::get('approved_data'))
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label class="col-sm-6" style="padding-right: 0" for="action">Thông tin cập nhật</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7 offset-sm-1">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 col-form-label">Ngày cập nhật</label>
                                        <div class="col-sm-7">
                                            <span>{{ (!empty(Session::get('approved_data.created_at'))) ? Session::get('approved_data.created_at') : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7 offset-sm-1">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 col-form-label">Nhân viên cập nhật</label>
                                        <div class="col-sm-7">
                                            <span>{{ (!empty(Session::get('approved_data.user_requested_by.name'))) ? Session::get('approved_data.user_requested_by.name') : Session::get('approved_data.requested_by') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7 offset-sm-1">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 col-form-label">Nhân viên kiểm tra</label>
                                        <div class="col-sm-7">
                                            <span>{{ (!empty(Session::get('approved_data.user_checked_by.name'))) ? Session::get('approved_data.user_checked_by.name') : Session::get('approved_data.checked_by') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7 offset-sm-1">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 col-form-label">Nhân viên phê duyệt</label>
                                        <div class="col-sm-7">
                                            <span>{{ (!empty(Session::get('approved_data.user_approved_by.name'))) ? Session::get('approved_data.user_approved_by.name') : Session::get('approved_data.approved_by') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            @if(auth()->user()->cannot('icon-check-data-permission') && auth()->user()->cannot('icon-approve-data-permission'))
                                <button type="submit" class="btn btn-info float-right" style="margin-left: 5px">Lưu</button>
                            @endif
                            <button type="button" onClick="cancelButton('{{ (!empty(Session::get('approved_data'))) ? route('iconapproved.index') : route('iconcategory.index') }}')" class="btn btn-default float-right" style="margin-left: 5px">Đóng</button>
                            @if (!empty($id))
                            <button type="button" onClick="deleteButton('#icon-category-form', '{{ @$data['productTitleNameVi'] }}', '{{ route('iconcategory.destroy') }}', 'selected-product')" class="btn btn-secondary float-right" style="margin-left: 5px">Xóa</button>
                            @endif
                            @if (Session::get('approved_data'))
                                @can('icon-check-data-permission')
                                    <button type="button" style="margin-left: 5px" class="btn btn-warning float-right" {{ (!empty(Session::get('approved_data.approved_status')) && Session::get('approved_data.approved_status') != 'chokiemtra') ? 'disabled' : '' }} onClick="approve({'id': {{ (!empty(Session::get('approved_data.id')) ? Session::get('approved_data.id') : '' ) }}, 'approved_status': 'kiemtrathatbai'})">DỮ LIỆU KHÔNG HỢP LỆ</button>
                                    <button type="button" style="margin-left: 5px" class="btn btn-success float-right" {{ (!empty(Session::get('approved_data.approved_status')) && Session::get('approved_data.approved_status') != 'chokiemtra') ? 'disabled' : '' }} onClick="approve({'id': {{ (!empty(Session::get('approved_data.id')) ? Session::get('approved_data.id') : '' ) }}, 'approved_status': 'chopheduyet'})">DỮ LIỆU HỢP LỆ</button>
                                @endcan
                                @can('icon-approve-data-permission')
                                    <button type="button" style="margin-left: 5px" class="btn btn-warning float-right" {{ (!empty(Session::get('approved_data.approved_status')) && in_array(Session::get('approved_data.approved_status'), ['kiemtrathatbai', 'dapheduyet', 'pheduyetthatbai'])) ? 'disabled' : '' }} onClick="approve({'id': {{ (!empty(Session::get('approved_data.id')) ? Session::get('approved_data.id') : '' ) }}, 'approved_status': 'pheduyetthatbai'})">KHÔNG PHÊ DUYỆT</button>
                                    <button type="button" style="margin-left: 5px" class="btn btn-success float-right" {{ (!empty(Session::get('approved_data.approved_status')) && in_array(Session::get('approved_data.approved_status'), ['kiemtrathatbai', 'dapheduyet', 'pheduyetthatbai'])) ? 'disabled' : '' }} onClick="approve({'id': {{ (!empty(Session::get('approved_data.id')) ? Session::get('approved_data.id') : '' ) }}, 'approved_status': 'dapheduyet'})">HOÀN TẤT PHÊ DUYỆT</button>
                                @endcan
                            @endif
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            
        </div>
    </section>
    <!-- /.content -->
</div>

<style>
    /*
    *
    * ==========================================
    * CUSTOM UTIL CLASSES
    * ==========================================
    *
    */
    #content-wrapper-new {
        height: calc(100% - 200px)!important;
    }

    #upload {
        opacity: 0;
    }

    #upload-label {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
    }

    .image-area {
        border: 2px dashed rgba(255, 255, 255, 0.7);
        padding: 1rem;
        position: relative;
    }

    .image-area::before {
        content: 'Uploaded image result';
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 0.8rem;
        z-index: 1;
    }

    .image-area img {
        z-index: 2;
        position: relative;
    }

    .dropdown {
        padding-left: 0!important
    }

    .delete-button {
        line-height: 28px;
        width: 30px;
        font-size: 16pt;
        font-family: ;
        margin-top: 1px;
        margin-right: 2px;
        position: absolute;
        top: -10px;
        right: -10px;
        border-radius: 50%;
        font-weight: bold;
        border: none;
        background-color: #2a2d30;
        color: #fff;
    }

    /* 
        Carousel
    */
    @media (max-width: 767px) {
        .carousel-inner .carousel-item > div {
            display: none;
        }
        .carousel-inner .carousel-item > div:first-child {
            display: block;
        }
    }
    
    .carousel-inner .carousel-item.active,
    .carousel-inner .carousel-item-next,
    .carousel-inner .carousel-item-prev {
        display: flex;
    }
    
    /* medium and up screens */
    @media (min-width: 768px) {
    
        .carousel-inner .carousel-item-end.active,
        .carousel-inner .carousel-item-next {
            transform: translateX(25%);
        }
        
        .carousel-inner .carousel-item-start.active,
        .carousel-inner .carousel-item-prev {
            transform: translateX(-25%);
        }
    }
    
    .carousel-inner .carousel-item-end,
    .carousel-inner .carousel-item-start {
        transform: translateX(0);
    }

    /* dragula */
    .gu-unselectable {
        list-style: none;
    }
    
    /* #selected-product {
        display: table-row;
    } */

    #selected-product li {
        margin-bottom: 20px;
        text-align: center;
    }

    #selected-product li img {
        width: 40%;
        margin-bottom: -10px
    }

    #all-product li {
        text-align: center;
    }

    #all-product li img {
        width: 30%;
        margin-bottom: 10px
    }

    #all-product button {
        display: none;
    }

    .direct-chat-text::after, .direct-chat-text::before {
        border-right-color: #6C757D
    }

    .close-thik {
        position: relative;
        left: 20%;
        bottom: 45%;
        background-color: transparent;
        border: none
    }
</style>
@endsection
