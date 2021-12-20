@extends('layouts.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ (!empty($user)) ? 'EDIT' : 'ADD NEW' }} BANNER</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('bannermanage.index')}}">Banner</a></li>
                        <li class="breadcrumb-item active">{{ (!empty($user)) ? 'edit' : 'create' }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                    @php
                    $action = (empty($banner)) ? route('bannermanage.store') : route('bannermanage.update',$banner->id);
                    @endphp
                    <form action="{{$action}}" method="POST" onSubmit="validateData(event,this)" onchange="checkEnableSave(this)">
                        @csrf
                        @if(!empty($banner))
                        @method('PUT')
                        @endif
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Banner Info</h3>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">title VI(*)</label>
                                        <input type="text" name="title_vi" class="form-control" value="{{ !empty($banner)?$banner->titleVi:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">title EN(*)</label>
                                        <input type="text" name="title_en" class="form-control" value="{{ !empty($banner)?$banner->titleEN:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="show_at">Show At(*)</label>
                                        <select type="text" name="show_at" class="form-control" onchange="onchangeTypeBanner(this)" hi>
                                            @if(!empty($list_type_banner))
                                            @foreach($list_type_banner as $type)
                                            <option value='{{$type->id}}'>{{$type->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group" id="path_1">
                                        <label>File (*)</label>
                                        <input type="file" accept="image/*" name="path_1" class="form-control" onchange="handleUploadImage(this,event)" />
                                        <img id="img_path_1" src="#" alt="your image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px" />
                                    </div>
                                    <div class="form-group" id="path_2" hidden>
                                        <input type="file" accept="image/*" name="path_2" class="form-control" onchange="handleUploadImage(this,event)" />
                                        <img id="img_path_2" src="#" alt="your image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px" />
                                        <span class="warning-alert" id="path_2_required_alert" hidden>This field is required!</span>
                                    </div>
                                    <div class="modal fade" id="img_view_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div id="image-viewer modal-body">
                                                    <img class="modal-content" id="full-image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="show_at">Object Type</label>
                                        <select type="text" name="object_type" class="form-control">
                                            <option value="topic">Nhóm được đăng ký sẵn</option>
                                            <option value="location">Vùng miền</option>
                                            <option value="contract_phone">Số điện thoại</option>
                                            <option value="contract_no">Số hợp đồng</option>
                                            <option value="hifpt_id">ID của user HiFPT</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="show_at">Object</label>
                                        <select type="text" name="object" class="form-control">
                                            <option value="all">Tất cả KH cài Hi FPT (bao gồm guest)</option>
                                            <option value="all_hifpt">Tất cả KH có dùng dịch vụ (không bao gồm guest)</option>
                                            <option value="guest">Tất cả KH không dùng dịch vụ (guest)</option>
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="show_at">Show From(*): </label>
                                            <input type="datetime-local" name="show_from" value="{{ !empty($banner)?$banner->show_from:''}}" class="form-control" />
                                        </div>
                                        <div class="col">
                                            <label for="show_to"> Show To(*): </label>
                                            <input type="datetime-local" name="show_to" value="{{ !empty($banner)?$banner->show_to:''}}" class="form-control" />   
                                        </div>
                                    </div>
                                    <div class="form-group" id="show_target_route">
                                        <div class="icheck-carrot">
                                            <input type="checkbox" id="has_target_route" name="has_target_route" onchange="onchangeDirection()"/>
                                            <label for="has_target_route" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Has Target Route</label>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#show_target_route"  style="transition: height 0.01s;">
                                            <select type="file" name="target_route" class="form-control" id="target_route" onchange="onchangeDirection()">
                                                @if(!empty($list_target_route))
                                                @foreach($list_target_route as $target)
                                                <option value='{{$target->id}}'>{{$target->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="direction_url" hidden>
                                        <label for="direction_url">Target URL</label>
                                        <input type="text" name="direction_url" class="form-control" value="{{ !empty($banner)?$banner->direction_url:''}}">
                                        <span class="warning-alert" id="direction_url_required_alert" hidden>This field is required!</span>
                                    </div>
                                    <div class="form-group">
                                        <div class="icheck-carrot">
                                            <input type="checkbox" id="isHighlight" name="isHighlight" />
                                            <label for="isHighlight" >Highlight</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: center">
                                <a href="{{ route('bannermanage.index') }}" type="button" class="btn btn-default">Cancel</a>
                                <button type="submit" class="btn btn-info" disabled>Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
