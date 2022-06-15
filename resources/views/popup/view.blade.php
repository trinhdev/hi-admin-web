@extends('layouts.default')
@section('content')

    <div class="content-wrapper" style="min-height: 125px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chi tiết popup</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('popupmanage.index') }}">Danh sách Popup</a></li>
                            <li class="breadcrumb-item active">Chi tiết popup</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12">
                    @include('popup._table')
                </div>
            </div>
        </section>
        <!-- /.content -->
{{--        <section class="content">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="card card-info">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3 class="card-title">Lịch sử Push của Template "{{$detailTemplate->titleVi}}"</h3>--}}
{{--                        <div class="card-tools">--}}
{{--                        @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->update == 1)--}}
{{--                            <button type="button" class="btn btn-tool" onclick="clearForm()" data-toggle="modal" data-target="#popupModal">--}}
{{--                                <i class="fas fa-plus-circle"> PUSH</i>--}}
{{--                            </button>--}}
{{--                        @endif--}}
{{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                                <i class="fas fa-minus"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <table class="table" id="templatPersonList" style="width: 100%!important;">--}}
{{--                            <input type="hidden" name="templateId" id="templateId"--}}
{{--                                   value="{{$detailTemplate->templateId}}">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>ID</th>--}}
{{--                                <th>Ngày Push</th>--}}
{{--                                <th>Tần suất popup xuất hiện</th>--}}
{{--                                <th>Loại Đối tượng</th>--}}
{{--                                <th>Ngày bắt đầu</th>--}}
{{--                                <th>Ngày kết thúc</th>--}}
{{--                                <th>Trạng Thái</th>--}}
{{--                                --}}{{-- <th>Hành động</th> --}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($detailTemplate->templatePersonalMaps as $key => $value)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$value->templatePersonalMapId}}</td>--}}
{{--                                    <td>{{$value->date_created}}</td>--}}
{{--                                    <td>{{config('platform_config.repeatTime')[$value->showOnceTime]}}</td>--}}
{{--                                    @if($value->pushedObject == "fpt_customer")--}}
{{--                                    <td>{{config('platform_config.object')['all_hifpt']}}</td>--}}
{{--                                    @else--}}
{{--                                    <td>{{config('platform_config.object')[$value->pushedObject]}}</td>--}}
{{--                                    @endif--}}
{{--                                    <td>{{$value->dateStart}}</td>--}}
{{--                                    <td>{{$value->dateEnd}}</td>--}}
{{--                                    <td>--}}
{{--                                    @if($value->process_status == 'deleted')--}}
{{--                                    <b class ="badge badge-success">Thành công</b>--}}
{{--                                    @else--}}
{{--                                    <b class="badge badge-danger">Thất Bại</b>--}}
{{--                                    @endif--}}
{{--                                    </td>--}}
{{--                                    --}}{{-- <td style="text-align: center"><a style="" type="button"--}}
{{--                                                                      onclick="getDetailPersonalMaps(this)"--}}
{{--                                                                      personalID="{{$value->templatePersonalMapId}}"--}}
{{--                                                                      class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>--}}
{{--                                    </td> --}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
    </div>
    <!-- Modal popup -->
    {{-- <form> --}}
    <div class="modal fade" id="popupModal" style="display: none;" aria-hidden="true">
    <form action="{{ route('popupmanage.pushPopupTemplate') }}" method="POST">
    @csrf
    <input type="hidden" name="templateId" id="templateId" value="{{--$detailTemplate->templateId--}}">
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
                                    <select class="form-control" name="objecttype" id="objecttype">
                                        @foreach($object_type as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="">
                                    <label>Tần suất popup xuất hiện</label>
                                    <div class="row">
                                        <div class="col-12">
                                            <select class="form-control" name="repeatTime" id="repeatTime">
                                                @foreach($repeatTime as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Đối tượng</label>
                                    <select class="form-control" name="object" id="object">
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
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
@endsection
@push('scripts')
     <script>
        $(document).ready(function() {
            showHide();
        });
    </script>
@endpush
