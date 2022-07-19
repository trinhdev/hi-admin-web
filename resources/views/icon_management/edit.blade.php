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
                    {!! Form::open(array('url' => route('iconmanagement.save'),'method'=>'post' ,'id' => 'icon-form','action' =>'index','class'=>'form-horizontal','enctype' =>'multipart/form-data','onsubmit'=>"handleSubmit(event,this)")) !!}
                    @csrf
                    <input type="hidden" name="productId" value="{{ @$data['productId'] }}" />
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title uppercase">{{ (!empty($data['productId'])) ? 'Cập nhật' : 'Thêm' }} Sản Phẩm</h3>
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
                                        <img id="img_icon" src="{{ (!empty($data['iconUrl']) ? $data['iconUrl'] : '/images/image_logo.png') }}" alt="" width="200" class="mb-4">
                                        <!-- Upload image input-->
                                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-gray shadow-sm">
                                            <input id="iconUrl" name="iconUrl" type="hidden" value="{{ @$data['iconUrl'] }}" />
                                            <input id="upload" type="file" onchange="readURL(this, '{{ route('iconmanagement.upload') }}');" class="form-control border-0">
                                            <label id="upload-label" for="upload" style="color: white; font-weight: bold">Upload image</label>
                                            <div class="input-group-append">
                                                <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                            </div>
                                        </div>
                                        <div style="color: #ffaf8d">
                                            <p class="font-italic text-center" style="margin-bottom: 0">Các kiểu định dạng file được chấp nhận</p>
                                            <p class="font-italic text-center"><b>jpeg, png, jpg, gif, svg</b></p>
                                            <p class="font-italic text-center">Dung lượng upload tối đa: <b>2048</b></p>
                                            <p style="font-weight: bold" class="font-italic text-center required">Xin vui lòng upload hình ảnh sản phẩm</p>
                                            @error('iconUrl')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Tên sản phẩm <span class="required">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="name" style="margin-bottom: 15px" class="form-control @error('productNameVi') is-invalid @enderror" id="vi-name" placeholder="Tên tiếng Việt" name="productNameVi" value="{{ @$data['productNameVi'] }}">
                                            @error('productNameVi')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <input type="name" class="form-control" id="en-name" placeholder="Tên tiếng Anh" name="productNameEn" value="{{ (!empty($data['productNameEn'])) ? $data['productNameEn'] : '' }}">
                                            @error('productNameEn')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Mô tả sản phẩm</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="decriptionVi" rows="4" id="decriptionVi">{{ @$data['decriptionVi'] }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Định danh sản phẩm</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="4" id="data" name="data" value={{ @$data['data'] }}></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái hiển thị</label>
                                <div class="row">
                                    <div class="col-sm-2 offset-sm-1">
                                        <div class="icheck-sunflower">
                                            <input type="radio" id="status-show" name="isDisplay" value="1" {{ (isset($data['isDisplay']) && $data['isDisplay'] == '1') ? 'checked' : '' }} />
                                            <label for="status-show">Bật</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="icheck-sunflower">
                                            <input type="radio" id="status-hide" name="isDisplay" value="0" {{ (!isset($data['isDisplay']) || (isset($data['isDisplay']) && $data['isDisplay'] == '0')) ? 'checked' : '' }} />
                                            <label for="status-hide">Tắt</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-11 offset-sm-1">
                                        <div class="form-group">
                                            <div class="icheck-sunflower">
                                                <input type="radio" id="status-clock" name="isDisplay" value="2" {{ (isset($data['isDisplay']) && $data['isDisplay'] == '2') ? 'checked' : '' }} />
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
                                                    <input type="text" name="displayBeginDay" class="form-control" id="show_from" placeholder="yyyy-mm-dd hh:mm:ss" value="{{ (!empty($data['displayBeginDay'])) ? date('Y-m-d H:i:s', strtotime($data['displayBeginDay'])) : date('Y-m-d H:i:s', strtotime('today midnight')) }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-7 offset-sm-1">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Ngày kết thúc</label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="displayEndDay" class="form-control" id="show_to" placeholder="yyyy-mm-dd hh:mm:ss" value="{{ !empty($data['displayEndDay']) ? date('Y-m-d H:i:s', strtotime($data['displayEndDay'])) : date('Y-m-d H:i:s', strtotime('tomorrow midnight')) }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2">Hiển thị icon "Mới"</label>
                                <div class="icheck-primary" style="width: auto">
                                    <input type="checkbox" id="is-new-show" name="isNew" value="1" {{ (isset($data['isNew'])) && ($data['isNew'] == "1" || $data['isNew'] == "2") ? "checked" : "" }} />
                                    <label for="is-new-show"></label>
                                </div>
                            </div>
                            <div id="is-new-icon-show-date-time" style="display: none">
                                <div class="row">
                                    <div class="col-sm-7 offset-sm-1">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5">Ngày bắt đầu</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="newBeginDay" class="form-control" id="new_from" placeholder="yyyy-mm-dd hh:mm:ss" value="{{ (!empty($data['newBeginDay'])) ? date('Y-m-d H:i:s', strtotime($data['newBeginDay'])) : date('Y-m-d H:i:s', strtotime('today midnight')) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-7 offset-sm-1">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5">Ngày kết thúc</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="newEndDay" class="form-control" id="new_to" placeholder="yyyy-mm-dd hh:mm:ss" value="{{ (!empty($data['newEndDay'])) ? date('Y-m-d H:i:s', strtotime($data['newEndDay'])) : date('Y-m-d H:i:s', strtotime('tomorrow midnight')) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label class="col-sm-6" style="padding-right: 0" for="action">Loại điều hướng</label>
                                        <select name="actionType" id="action" class="selectpicker col-sm-6" data-live-search="true" data-size="10">
                                            @foreach ($loai_dieu_huong as $item)
                                            <option value="{{ $item['key'] }}" {{ ((!empty($data['actionType']) && $data['actionType'] == $item['key']) || $item['key'] == 'go_to_screen') ? 'selected' : '' }}>{{ $item['value'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7 offset-sm-1">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 col-form-label">Link production <span class="required">*</span></label>
                                        <div class="col-sm-7">
                                            <input id="dataActionProduction" type="textbox" name="dataActionProduction" class="form-control @error('dataActionProduction') is-invalid @enderror" value="{{ @$data['dataActionProduction'] }}" />
                                            @error('dataActionProduction')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7 offset-sm-1">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-5 col-form-label">Link staging <span class="required">*</span></label>
                                        <div class="col-sm-7">
                                            <input id="dataActionStaging" type="textbox" name="dataActionStaging" class="form-control @error('dataActionStaging') is-invalid @enderror" value="{{ @$data['dataActionStaging'] }}" />
                                            @error('dataActionStaging')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
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
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{-- @if(auth()->user()->cannot('icon-check-data-permission') && auth()->user()->cannot('icon-approve-data-permission'))
                                <button id="submit-button" type="submit" class="btn btn-info float-right" style="margin-left: 5px" disabled>Lưu</button>
                            @endif --}}
                            <button id="submit-button" type="submit" class="btn btn-info float-right" style="margin-left: 5px" disabled>Lưu</button>
                            <button type="button" onClick="cancelButton('{{ (!empty(Session::get('approved_data'))) ? route('iconapproved.index') : route('iconmanagement.index') }}')" class="btn btn-default float-right" style="margin-left: 5px">Đóng</button>
                            @if (isset($data['productId']))
                                @if(auth()->user()->can('icon-approve-data-permission'))
                                    <button type="button" onClick="deleteButton('icon_management', '#icon-form', '{{ @$data['productNameVi'] }}', '{{ route('iconapproved.destroyByApprovedRole') }}')" class="btn btn-secondary float-right" style="margin-left: 5px">Xóa</button>
                                @else
                                    <button type="button" onClick="deleteButton('icon_management', '#icon-form', '{{ @$data['productNameVi'] }}', '{{ route('iconmanagement.destroy') }}')" class="btn btn-secondary float-right" style="margin-left: 5px">Xóa</button>
                                @endif
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

    .required {
        color: red
    }

    /*
    *
    * ==========================================
    * FOR DEMO PURPOSES
    * ==========================================
    *
    */
</style>
@endsection

{{-- @section('scripts')
{!! Html::script(asset('/custom_js/iconmanagement.js')) !!}
@stop --}}
@push('scripts')
    <script src="{{ asset('/custom_js/iconmanagement.js') }}"></script>
    <script src="{{ asset('/custom_js/javascript.icon.js')}}"></script>
@endpush
