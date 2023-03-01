@extends('layoutv2.layout.app')

@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        <a href="#" onclick="alert('Liên hệ zalo 0354370175 nếu xảy ra lỗi không mong muốn!')" class="btn btn-default pull-left display-block mright5">
                            <i class="fa-regular fa-user tw-mr-1"></i>Liên hệ
                        </a>
                        <div class="visible-xs">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <div class="row">
                                <form action="{{route('logactivities.clearLog')}}" method="POST" onsubmit="handleSubmit(event, this)">
                                    @csrf
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="member_filter" class="control-label">Xóa</label>
                                            <div class="dropdown bootstrap-select show-tick bs3" style="width: 100%;">
                                                <select name="clear_log_option" id="select_filter" class="selectpicker" data-actions-box="1" data-width="100%"
                                                        data-none-selected-text="Không có mục nào được chọn"
                                                        data-live-search="true" tabindex="-98">
                                                    <option data-subtext="Không có mục nào được chọn"></option>
                                                    @foreach(config('constants.ClEAR_LOG_OPTIONS') as $option)
                                                        <option value={{$option}}>
                                                            @if($option == 0)
                                                                Clear all
                                                            @else
                                                                Clear {{$option}} days before
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit" class="control-label"></label>
                                            <div class="input-group date">
                                                <button type="submit"  class="tw-mt-1 btn btn-info" type="submit"
                                                       value="Submit" autocomplete="off">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="panel-table-full">
                                {{ $dataTable->table(['id' => 'log_manage'], $footer = false) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{ $dataTable->scripts() }}
    <script>
        function deleteModules(data){
            let dataPost = {};
            dataPost.id = $(data).data('id');
            $.post('/logactivities/clearLog', dataPost).done(function(response) {
                alert_float('success', response.message);
                $('#log_manage').DataTable().ajax.reload(null,false);
            });
        }
    </script>
@endpush
