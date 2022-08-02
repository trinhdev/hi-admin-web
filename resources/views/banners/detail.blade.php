<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-sm-12">
            <form id="formBanner" enctype="multipart/form-data">
                <input type="hidden" id="event_id" name="id">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title uppercase">Thông tin Banner</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title" class="required_red_dot">Tiêu đề tiếng Việt</label>
                                <input type="text" name="titleVi" class="form-control" id="title_vi" value="{{ old('titleVi') }}">
                            </div>
                            <div class="form-group">
                                <label for="title" class="required_red_dot">Tiêu đề tiếng Anh</label>
                                <input type="text" name="titleEn" class="form-control" id="title_en" value="{{ old('titleEn') }}">
                            </div>
                            <div class="form-group">
                                <label for="bannerType" class="required_red_dot">Vị trí hiển thị</label>
                                <select type="text" name="bannerType" class="form-control" id="event_type" onchange="onchangeTypeBanner(this)">
                                    @forelse($list_type_banner as $type)
                                        <option value="{{$type->key}}">{{ $type->name }}</option>
                                    @empty
                                        <option>Error data</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group" id="path_1">
                                <label class="required_red_dot">Ảnh</label>
                                <input type="file" accept="image/*" name="path_1" class="form-control" onchange="handleUploadImage(this)" />
                                <img id="img_path_1" src="{{ asset('/images/image_holder.png') }}" alt="your image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px" />
                                <input name="imageFileName" id="img_path_1_name" value="" hidden />
                            </div>
                            <div class="form-group" id="path_2" style="display: none">
                                <input type="file" accept="image/*" name="path_2" class="form-control" onchange="handleUploadImage(this)" />
                                <img id="img_path_2" src="{{ $banner['thumb_image'] ?? asset('/images/image_holder.png') }}" alt="your image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px" />
                                <span><i>&nbsp; &nbsp;&nbsp;(* đây là ảnh hiển thị ở Home)</i></span>
                                <span class="warning-alert" id="path_2_required_alert" hidden>Dữ liệu này bắt buộc!</span>
                                <input name="thumbImageFileName" id="img_path_2_name" value="" hidden />
                            </div>
                            <div class="form-group">
                                <label for="objectType" class="required_red_dot">Loại Đối tượng</label>
                                <select type="text" name="objectType" class="form-control">
                                    <option value="topic" selected>Nhóm được đăng ký sẵn</option>
                                    <option value="location">Vùng miền</option>
                                    <option value="contract_phone">Số điện thoại</option>
                                    <option value="contract_no">Số hợp đồng</option>
                                    <option value="hifpt_id">ID của user HiFPT</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="objects" class="required_red_dot">Đối tượng</label>
                                <select type="text" name="objects" class="form-control">
                                    <option value="all" selected>Tất cả KH cài Hi FPT (bao gồm guest)</option>
                                    <option value="all_hifpt">Tất cả KH có dùng dịch vụ (không bao gồm guest)</option>
                                    <option value="guest">Tất cả KH không dùng dịch vụ (guest)</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="show_from" class="required_red_dot">Ngày hiển thị </label>
                                    <input type="datetime-local" name="show_from" value="{{ old('show_from') }}" id="public_date_start" class="form-control" onchange="changePublicDateTime(this)" />
                                </div>
                                <div class="col">
                                    <label for="show_to" class="required_red_dot"> Ngày kết thúc </label>
                                    <input type="datetime-local" name="show_to" value="{{ old('show_to') }}" id="public_date_end" class="form-control" onchange="changePublicDateTime(this)" />
                                </div>
                            </div>
                            <div class="form-group" id="show_target_route">
                                <div class="icheck-carrot">
                                    <input type="checkbox" id="has_target_route" name="has_target_route" onchange="onchangeDirection()" value="checked"/>
                                    <label for="has_target_route">Điều hướng</label>
                                </div>
                                <div class="border box-target" id="box_target" style="display: none">
                                    <label for="target_route">Điều hướng đến</label>
                                    <div id="collapseOne" style="transition: height 0.01s;">
                                        {{-- <label for="target_route">Target Id</label> --}}
                                        <select type="file" name="direction_id" class="form-control p" id="direction_id" onchange="onchangeTargetRoute()" data-live-search="true" data-size="10">
                                            @forelse($list_target_route as $target)
                                                <option value="{{$target->id}}">{{ $target->name }}</option>
                                            @empty
                                                <option>Error data</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group" id="direction_url" >
                                        <label for="event_url">URL</label>
                                        <input type="text" id="event_url" name="directionUrl" value="{{ old('directionUrl') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div id="isShowHomeGroup" class="form-group" style="display: none">
                                <div class="icheck-carrot">
                                    <input type="checkbox" id="isShowHome" name="isShowHome" checked />
                                    <label for="isShowHome">Hiện ở Home</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align: center">
                        <a href="{{ route('bannermanage.index') }}" type="button" class="btn btn-default">Thoát</a>
                        <button type="submit" id="submitAjax" class="btn btn-info">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
