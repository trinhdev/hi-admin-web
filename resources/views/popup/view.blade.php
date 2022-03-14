@extends('layouts.default')
@section('content')
    <style>
        td {
            word-break: break-all !important;
        }
    </style>
    <div class="content-wrapper" style="min-height: 125px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$detailTemplate->titleVi}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('popupmanage.index') }}">Danh sách Popup</a></li>
                            <li class="breadcrumb-item active">{{$detailTemplate->titleVi}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Chi tiết popup: {{$detailTemplate->titleVi}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="table">
                                <input type="hidden" name="templateId" id="templateId"
                                       value="{{$detailTemplate->templateId}}">
                               <thead>
                                    <tr class="text-center">
                                        <th scope="col">Tiêu đề tiếng việt</th>
                                        <th scope="col">Tiêu đề tiếng anh</th>
                                        <th scope="col">Loại popup</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Nút điều hướng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$detailTemplate->titleVi}}</td>
                                        <td>{{$detailTemplate->titleEn}}</td>
                                        <td>{{$list_type_popup[$detailTemplate->templateType]}}</td>
                                        <td><img width="200px" src="{{env('URL_STATIC').'/upload/images/event/'.$detailTemplate->image}}"></td>
                                        @if(!empty($detailTemplate->buttonImage))
                                        <td><img width="200px" src="{{env('URL_STATIC').'/upload/images/event/'.$detailTemplate->buttonImage}}"></td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Chi tiết popup: {{$detailTemplate->titleVi}}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" onclick="clearForm()" data-toggle="modal" data-target="#myModal">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="templatPersonList" style="width: 100%!important;">
                            <input type="hidden" name="templateId" id="templateId"
                                   value="{{$detailTemplate->templateId}}">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tần suất popup xuất hiện</th>
                                <th>Loại Đối tượng</th>
                                <th>Ngày bắt đầu</th>
                                <th>Loại kết thúc</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($detailTemplate->templatePersonalMaps as $key => $value)
                                <tr>
                                    <td>{{$value->templatePersonalMapId}}</td>
                                    <td>{{config('platform_config.repeatTime')[$value->showOnceTime]}}</td>
                                    <td>{{config('platform_config.object')[$value->pushedObject]}}</td>
                                    <td>{{$value->dateStart}}</td>
                                    <td>{{$value->dateEnd}}</td>
                                    <td style="text-align: center"><a style="" type="button"
                                                                      onclick="getDetailPersonalMaps(this)"
                                                                      personalID="{{$value->templatePersonalMapId}}"
                                                                      class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal popup -->
    <div class="modal fade" id="myModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Chi tiết hiển thị popup </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Loại Đối tượng</label>
                                    <select class="form-control select2" name="objecttype" id="objecttype">
                                        @foreach($object_type as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="">
                                    <label>Tần suất popup xuất hiện</label>
                                    <div class="row">
                                        <div class="col-12">
                                            <select class="form-control select2" name="repeatTime" id="repeatTime">
                                                @foreach($repeatTime as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{--<div class="col-3">--}}
                                        {{--<input type="number" step="1" min="0" class="form-control"--}}
                                        {{--style="display: none;" id="other_min" name="other_min"--}}
                                        {{--placeholder="N (tính theo phút)">--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Đối tượng</label>
                                    <select class="form-control select2" name="object" id="object">
                                        @foreach($object as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="required_red_dot">Thời gian hiển thị:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="timeline"
                                               name="timeline">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="submitTargetPopup()">Save changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        

    </script>
     <script>
        $(document).ready(function() {
            showHide();
        });
    </script>
@endpush