@extends('layouts.default')
@section('content')

    <div class="content-wrapper" style="min-height: 125px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chi tiết popup {{ $id }}</h1>
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
    </div>
    <!-- Modal popup public-->
    {{-- <form> --}}
    <div class="modal fade" id="popupModal" style="display: none;" aria-hidden="true">
    <form id="formPopup" data-action="{{ route('popupmanage.pushPopupTemplate') }}">
        <input type="hidden" name="templateId" id="templateId" value="{{ $id }}">
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
                                    <label for="objecttype">Loại Đối tượng</label>
                                    <select class="form-control" name="objecttype" id="objecttype">
                                        @foreach($object_type as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
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
                                <div class="form-group row" >
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
                        <button id="submitButton" type="button" class="btn btn-primary">Save changes</button>
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
            pushTemplateAjaxPopup();
        });
    </script>
@endpush
