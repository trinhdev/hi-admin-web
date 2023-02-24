@extends('layoutv2.layout.app')

@section('content')
    <div id="wrapper" style="min-height: 3494px;">
        <div class="content">
            <div class="row">
                <div class="col-md-7">
                    <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">
                        <h4 class="tw-my-0 tw-font-semibold tw-text-lg tw-text-neutral-700">
                            Thêm vị trí mới </h4>
                    </div>
                    <div class="panel_s">
                        <div class="panel-body">
                            <form action="{{ route('role.store') }}" method="post" accept-charset="utf-8"
                                  novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="control-label">
                                        <small class="req text-danger">* </small>Tên vị trí
                                    </label>
                                    <input type="text" id="name" name="name" class="form-control" autofocus="1" >
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered roles no-margin">
                                        <thead>
                                            <tr>
                                                <th style="width: 5px;"></th>
                                                <th>Tính năng</th>
                                                <th>Quyền hạn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($permission as $key => $value)
                                            <tr data-name="{{ $key }}">
                                                <td>
                                                    <div class="checkbox tw-ml-2">
                                                        <input onclick="check_value(this)" id="{{ $key }}" type="checkbox" class="capability"><label></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <b>{{ $key }}</b>
                                                </td>
                                                <td>
                                                    @foreach($value as $k => $val)
                                                        <div class="checkbox tw-ml-2">
                                                            <input id="{{$key.'_'.$val}}" type="checkbox" class="capability" name="permissions[]"
                                                                   value="{{(int) $k}}">
                                                            <label for="{{$key.'_'.$val}}"> {!! $val !!} </label>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary pull-right">Lưu lại</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('script')
    <script>
        function check_value(element){
            let id1 = element.id;
            console.log(id1);
            console.log($("input[id*='articles_]").val());
            $("div[id^='articles_]").not(this).prop('checked', this.checked);
        }
    </script>
@endpush
