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
                    {!! Form::open(array('url' => route('roles.save'),'method'=>'post' ,'id' => 'form-view','action' =>'index','class'=>'form-horizontal','enctype' =>'multipart/form-data','onsubmit'=>"handleSubmit(event,this)")) !!}
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title uppercase">{{ (!empty($id)) ? 'Cập nhật' : 'Thêm' }} Danh Mục</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <div class="card-body" style="max-height: 600px; overflow-y: scroll"> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group" style="text-align: center">
                                        <img id="img_icon" src="/images/image_logo.png" alt="" width="150" class="mb-4">
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
                                            <input type="name" style="margin-bottom: 15px" class="form-control" id="vi-name" placeholder="Tên tiếng Việt" name="group_name" value="">
                                            <input type="name" class="form-control" id="en-name" placeholder="Tên tiếng Anh" name="group_name" value="">
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
                                                    <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-7 offset-sm-1">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Ngày bắt đầu</label>
                                                <div class="col-sm-7">
                                                    <input type="datetime-local" name="show_from" class="form-control" id="show_from" placeholder="Date From" onchange="filterData()" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Danh sách sản phẩm</label>
                                <div class="row">
                                    <div class="direct-chat-msg">
                                        <img class="direct-chat-img" src="/images/information.png" alt="">
                                        <div class="direct-chat-text">Kéo thả sản phẩm từ bên dưới danh sách <b><i>"Tất cả sản phẩm"</i></b> vào ô thứ tự để sắp xếp vị trí tương ứng</div>
                                    </div>
                                </div>
                                <div class="card card-info">
                                    <div class="card-body">
                                        <div class="row">
                                            <ul style="list-style: none; display: contents;" id="selected-product">
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Tất cả sản phẩm</label>
                                <div class="card card-info">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <ul id="all-product" style="list-style: none;">
                                                    <li>
                                                        <div class="card" style="background-color: #F5F7FA">
                                                            <div class="card-content">
                                                              <div class="card-body">
                                                                <div class="media d-flex">
                                                                    <div class="align-self-center">
                                                                        <img src="/images/image_logo.png" alt="" width="80px">
                                                                    </div>
                                                                    <div class="media-body text-right">
                                                                        <h4 style="font-weight: bold; color: #228E3B">Lịch phát sóng</h4>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="card" style="background-color: #F5F7FA">
                                                            <div class="card-content">
                                                              <div class="card-body">
                                                                <div class="media d-flex">
                                                                    <div class="align-self-center">
                                                                        <img src="/images/image_logo.png" alt="" width="80px">
                                                                    </div>
                                                                    <div class="media-body text-right">
                                                                        <h4 style="font-weight: bold; color: #228E3B">Lịch phát sóng</h4>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right" style="margin-left: 5px">Lưu</button>
                            <a href="/{{$controller}}" class="btn btn-default float-right" style="margin-left: 5px">Đóng</a>
                            @if (!empty($id))
                            <button type="button" onClick="deleteProduct('{{ $data['productNameVi'] }}')" class="btn btn-secondary float-right" style="margin-left: 5px">Xóa</button>
                            @endif
                        </div>
                        <!-- /.card-footer -->
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
        display: inline-grid
    }

    .close-thik {
        color: #777;
        font: 14px/100% arial, sans-serif;
        position: absolute;
        right: 3px;
        text-decoration: none;
        text-shadow: 0 1px 0 #fff;
        top: -6px;
    }

    .close-thik:after {
        content: '✖'; /* UTF-8 symbol */
    }
</style>

<script id="product-list-template" type="text/x-jquery-tmpl">
    <li class="col-sm-1" style="text-align: center">
        <a href="#" class="close-thik" onClick="deleteProduct('${productNameVi}')"></a>
        <img src="${iconUrl}" alt="${productNameVi}" class="img-thumbnail">
        <h5><span class="badge badge-primary">${productNameVi}</span></h5>
        <h6><span class="badge badge-warning">${no}</span></h6>
    </li>
</script>
@endsection
