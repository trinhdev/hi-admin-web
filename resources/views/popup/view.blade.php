@extends('layoutv2.layout.app')

@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        <a data-toggle="modal" data-target="#popupModal" href="#" class="btn btn-primary mright5 test pull-left display-block">
                            <i class="fa-regular fa-plus tw-mr-1"></i>
                            Push popup</a>
                        <a href="#" onclick="alert('Liên hệ trinhhdp@fpt.com.vn nếu xảy ra lỗi không mong muốn!')" class="btn btn-default pull-left display-block mright5">
                            <i class="fa-regular fa-user tw-mr-1"></i>Liên hệ
                        </a>
                        <div class="visible-xs">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <div class="panel-table-full">
                                {{ $dataTable->table(['id' => 'popup_detail_table'], $footer = false) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popupModal" aria-hidden="true">
        <form id="formPopup" data-action="{{ route('popupmanage.pushPopupTemplate') }}">
            <input type="hidden" name="templateId" id="templateId" value="{{ $id }}">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Chi tiết hiển thị popup </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="objecttype">Loại Đối tượng</label>
                                    <select class="form-control selectpicker" name="objecttype" id="objecttype">
                                        @foreach($object_type as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tần suất popup xuất hiện</label>
                                    <select class="form-control selectpicker" name="repeatTime" id="repeatTime">
                                        @foreach($repeatTime as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Đối tượng</label>
                                    <select class="form-control selectpicker" name="object" id="object">
                                        @foreach($object as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <label class="required_red_dot">Thời gian hiển thị</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control float-right daterange" id="daterange"
                                               name="daterange" autocomplete="off" placeholder="Chọn ngày hiển thị">
                                        <div class="input-group-addon">
                                            <i class="fa-regular fa-calendar calendar-icon"></i>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submitButton" type="button" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('script')
    {{ $dataTable->scripts() }}
    <script>
        $('#formPopup').on('click', '#submitButton', function (e){
            e.preventDefault();
            const form = document.querySelector('#formPopup');
            const data = Object.fromEntries(new FormData(form).entries());
            let url = $(form).data('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                cache: false,
                success: (data) => {
                    if(data.data.statusCode === 0){
                        var table = $('#popup_detail_table').DataTable();
                        table.ajax.reload(null, false);
                        $('#popupModal').modal('toggle');
                        alert_float('success','Thành công');
                    }else{
                        alert_float('danger',data.data.message);
                    }
                },
                error: function (xhr) {
                    var errorString = '';
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        errorString = value;
                        return false;
                    });
                    $('#popupModal').modal('toggle');
                    alert_float('danger',errorString);
                }
            });
        });
    </script>

@endpush




