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
                        <li class="breadcrumb-item active">Icon config</li>
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
                    {!! Form::open(array('url' => route('iconconfig.save'),'method'=>'post' ,'id' => 'icon-config-form','action' =>'index','class'=>'form-horizontal','enctype' =>'multipart/form-data', 'onsubmit'=>"onsubmitIconForm(event,this,'selected-product-config')")) !!}
                    @csrf
                    <input type="hidden" name="productConfigId" value="{{ @$data['productConfigId'] }}"/>
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title uppercase">{{ (!empty($data['productConfigId'])) ? 'Cập nhật' : 'Thêm' }} Vị Trí</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <div class="card-body" style="max-height: 600px; overflow-y: scroll"> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên vị trí</label>
                                        <div class="col-sm-9">
                                            <input type="name" class="form-control" id="vi-name" placeholder="Tên vị trí" name="titleVi" value="{{ @$data['titleVi'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên vị trí - code</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="code-name" placeholder="Tên vị trí - code" name="name" value="{{ @$data['name'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Mô tả</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="4" id="description" placeholder="Mô tả"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Số icon trên 1 dòng</label>
                                        <div class="col-sm-3">
                                            <input type="number" class="form-control" id="icon-per-row" placeholder="Số icon trên 1 dòng" name="iconsPerRow" value="{{ @$data['iconsPerRow'] }}">
                                        </div>
                                        <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Số dòng tối đa</label>
                                        <div class="col-sm-3">
                                            <input type="number" class="form-control" id="row-on-page" placeholder="Số dòng tối đa" name="rowOnPage" value="{{ @$data['rowOnPage'] }}">
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
                            </div>
                            <div class="form-group row">
                                <div class="icheck-amethyst">
                                    <input type="radio" id="category-add" name="prod_add" value="category_add" />
                                    <label for="category-add">Thêm danh mục</label>
                                    <p style="font-size: 13px">(Hiển thị tất cả danh mục OFF/ON & các sản phẩm trong danh mục)</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="icheck-amethyst">
                                    <input type="radio" id="product-add" name="prod_add" value="product_add" checked />
                                    <label for="product-add">Thêm sản phẩm</label>
                                    <p style="font-size: 13px">(Hiển thị sản phẩm sau khi đã chọn)</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Danh sách sản phẩm</label>
                                <input type="hidden" name="arrayId" id="selected-prod-id">
                                <div class="row product-add">
                                    <div class="direct-chat-msg">
                                        <img class="direct-chat-img" src="/images/information.png" alt="">
                                        <div style="background-color: #6C757D; color: #ffffff" class="direct-chat-text">Kéo thả sản phẩm từ bên dưới danh sách <b><i>"Tất cả sản phẩm"</i></b> vào ô thứ tự để sắp xếp vị trí tương ứng</div>
                                    </div>
                                </div>
                                <div class="row category-add" style="display: none">
                                    <div class="direct-chat-msg">
                                        <img class="direct-chat-img" src="/images/information.png" alt="">
                                        <div style="background-color: #6C757D; color: #ffffff" class="direct-chat-text">Click chọn danh mục từ <b><i>"Tất cả danh mục"</i></b> để thêm tất cả sản phẩm trong danh mục</div>
                                    </div>
                                </div>
                                <div class="card card-info">
                                    <div class="card-body">
                                        <ul class="row" style="list-style: none; min-height: 100px; max-width: {{ (!empty($data['iconsPerRow'])) ? $data['iconsPerRow'] * 100 / 5 : 100 }}%" id="selected-product-config">
                                            @foreach ($data['productListInConfig'] as $key => $value)
                                                <li class="selected-li" id="{{ @$value['productId'] }}-selected-product-config" data-prodid="{{ @$value['productId'] }}">
                                                    <img src="{{ $value['iconUrl'] }}" alt="{{ $value['productNameVi'] }}">
                                                    <br>
                                                    <button type="button" class="close-thik" onClick="removeFromSelectedProduct('{{ @$value['productId'] }}-selected-product-config')"><i class="fas fa-times-circle"></i></button>
                                                    <h6><span class="badge badge-dark">{{ $value['productNameVi'] }}</span></h6>
                                                    <h6><span class="badge badge-warning position">{{ $key + 1 }}</span></h6>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group product-add">
                                <label for="">Tất cả sản phẩm</label>
                                <div class="card card-info">
                                    <div class="card-body" style="background-color: #6C757D">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <ul id="all-product-config" style="list-style: none">
                                                    @foreach ($data['productList'] as $key => $value)
                                                        <li id="{{ @$value['productId'] }}" data-prodid="{{ @$value['productId'] }}">
                                                            <img src="{{ $value['iconUrl'] }}" alt="{{ $value['productNameVi'] }}">
                                                            <br>
                                                            <button type="button" class="close-thik" onClick="removeFromSelectedProduct('{{ @$value['productId'] }}-selected-product-config')"><i class="fas fa-times-circle"></i></button>
                                                            <h6><span class="badge badge-light">{{ $value['productNameVi'] }}</span></h6>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group category-add" style="display: none">
                                <label for="">Tất cả danh mục</label>
                                <div class="card card-info">
                                    <div class="card-body" style="background-color: #6C757D">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <ul id="all-title-config" style="list-style: none">
                                                    @foreach ($data['list_category'] as $key => $value)
                                                        <li id="{{ @$value['productTitleId'] }}" onClick="changeSelectedProduct({{ json_encode($value['productListInTitle'], JSON_UNESCAPED_UNICODE) }})">
                                                            <img src="{{ (!empty($value['iconUrl'])) ? $value['iconUrl'] : '/images/image_logo.png' }}">
                                                            {{-- <img src="{{ (!empty($value['iconUrl'])) ? $value['iconUrl'] : 'images/image_logo.png' }}" alt="{{ $value['productTitleNameVi'] }}"> --}}
                                                            <br>
                                                            <button type="button" class="close-thik" onClick="removeFromSelectedProduct('{{ @$value['productTitleId'] }}-selected-title')"><i class="fas fa-times-circle"></i></button>
                                                            <h6><span class="badge badge-light">{{ $value['productTitleNameVi'] }}</span></h6>
                                                        </li>
                                                    @endforeach
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
                            <button type="button" onClick="cancelButton('{{ route('iconconfig.index') }}')" class="btn btn-default float-right" style="margin-left: 5px">Đóng</button>
                            @if (!empty($id))
                            <button type="button" onClick="deleteButton(JSON.stringify(serializeObject($('#icon-config-form').serializeArray())), '{{ $data['name'] }}', '{{ route('iconconfig.destroy') }}')" class="btn btn-secondary float-right" style="margin-left: 5px">Xóa</button>
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
    
    /* #selected-product-config {
        display: table-row;
    } */

    #selected-product-config li {
        margin-bottom: 20px;
        width: 186px!important;
        text-align: center;
    }

    #selected-product-config li img {
        width: 40%;
        margin-bottom: -10px
    }

    #all-product-config li {
        text-align: center;
    }

    #all-product-config li img {
        width: 30%;
        margin-bottom: 10px
    }

    #all-product-config button {
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

    #all-title-config li {
        text-align: center;
        cursor: pointer;
    }

    #all-title-config li img {
        width: 30%;
        margin-bottom: 10px
    }

    #all-title-config button {
        display: none;
    }
</style>
@endsection
