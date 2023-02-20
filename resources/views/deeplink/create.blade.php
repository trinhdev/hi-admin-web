@extends('layoutv2.layout.app')

@section('content')
    <div id="wrapper">
        <div class="content">
            <form action="{{ route('deeplink.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!-- begin::title -->
                        <div class="tw-flex tw-justify-between tw-mb-2">
                            <h4 class="tw-mt-0 tw-font-semibold tw-text-neutral-700">
                                <span class="tw-text-lg">Thêm mới deeplink</span>
                            </h4>
                        </div>
                        <!-- end::title -->
                        <div class="panel_s">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="name" class="control-label">
                                        <i class="fa-regular fa-circle-question" data-toggle="tooltip"
                                           data-title="Tên deeplink, e.q. Gói SOC 1Gbps, F-Share ."
                                           data-original-title="" title=""></i>
                                        Tên deeplink
                                    </label>
                                    <input type="text" id="name" name="name" class="form-control"
                                           placeholder="Tên deeplink" value="{{ old('name') }}"/>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="control-label">
                                        <i class="fa-regular fa-circle-question" data-toggle="tooltip"
                                           data-title="Điều hướng, e.q. Sản phẩm -> Gói SOC 1Gbps , Sản phẩm -> FPT iHome ."
                                           data-original-title="" title=""></i>
                                        Điều hướng
                                    </label>
                                    <input type="text" id="direction" name="direction" class="form-control"
                                           placeholder="Điều hướng" value="{{ old('direction') }}"/>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="control-label">
                                        <i class="fa-regular fa-circle-question" data-toggle="tooltip"
                                           data-title="URL, e.q. https://hi.fpt.vn/dr/Sqsw , https://hi.fpt.vn/dr/Sqsw ."
                                           data-original-title="" title=""></i>
                                        URL
                                    </label>
                                    <input type="text" id="url" name="url" class="form-control"
                                           placeholder="URL" value="{{ old('url') }}"/>
                                </div>
                                <!-- begin::tabContent -->
                                <div
                                    class="btn-bottom-toolbar bottom-transaction text-right sm:tw-flex sm:tw-items-center sm:tw-justify-between">
                                    <p class="no-mbot pull-left mtop5 btn-toolbar-notice tw-hidden sm:tw-block">
                                        <b>Vui lòng kiểm tra kỹ các thông tin trước khi gửi!</b>
                                    </p>
                                    <div>
                                        <button type="submit" name="action" value="stay"
                                                class="btn btn-default mleft10 proposal-form-submit save-and-send transaction-submit">
                                            Save and edit
                                        </button>
                                        <button
                                            class="btn btn-primary mleft5 proposal-form-submit transaction-submit"
                                            type="submit" name="action" value="back"> Save
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
