<div class="row">
    <div class="col-md-12">
        <form id="formBanner" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" id="event_id" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="control-label"><small class="req text-danger">* </small>Tiêu đề tiếng Việt</label>
                                <input type="text" name="titleVi" class="form-control" id="title_vi" value="{{ old('titleVi') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="control-label"><small class="req text-danger">* </small>Tiêu đề tiếng Anh</label>
                                <input type="text" name="titleEn" class="form-control" id="title_en" value="{{ old('titleEn') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bannerType" class="control-label"><small class="req text-danger">* </small>Vị trí hiển thị</label>
                        <select type="text" name="bannerType" class="form-control selectpicker" id="event_type"
                                onchange="onchangeTypeBanner(this)" data-actions-box="1" data-width="100%"
                                data-none-selected-text="Không có mục nào được chọn"
                                data-live-search="true" tabindex="-98">
                            @forelse($list_type_banner as $type)
                                <option value="{{$type->key}}">{{ $type->name }}</option>
                            @empty
                                <option>Error data</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="path_1">
                                <label class="control-label"><small class="req text-danger">* </small>Ảnh</label>
                                <input type="file" accept="image/*" name="path_1" class="form-control" onchange="handleUploadImage(this)"/>
                                <img id="img_path_1" src="{{ asset('/images/image_holder.png') }}" alt="your image"
                                     class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px"/>
                                <input name="imageFileName" id="img_path_1_name" value="" hidden/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="path_2" style="display: none">
                                <label class="control-label"><small class="req text-danger">* </small>Ảnh hiển thị ở home</label>
                                <input type="file" accept="image/*" name="path_2" class="form-control" onchange="handleUploadImage(this)"/>
                                <img id="img_path_2" src="{{ $banner['thumb_image'] ?? asset('/images/image_holder.png') }}" alt="your image"
                                     class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px"/>
                                <input name="thumbImageFileName" id="img_path_2_name" value="" hidden/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="objectType" class="control-label"><small class="req text-danger">* </small>Loại Đối tượng</label>
                                <select type="text" name="objectType" class="form-control selectpicker" data-actions-box="1" data-width="100%"
                                        data-none-selected-text="Không có mục nào được chọn"
                                        data-live-search="true" tabindex="-98">
                                    <option value="topic" selected>Nhóm được đăng ký sẵn</option>
                                    <option value="location">Vùng miền</option>
                                    <option value="contract_phone">Số điện thoại</option>
                                    <option value="contract_no">Số hợp đồng</option>
                                    <option value="hifpt_id">ID của user HiFPT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="objects" class="control-label"><small class="req text-danger">* </small>Đối tượng</label>
                                <select type="text" name="objects" class="form-control selectpicker" data-actions-box="1" data-width="100%"
                                        data-none-selected-text="Không có mục nào được chọn"
                                        data-live-search="true" tabindex="-98">
                                    <option value="all" selected>Tất cả KH cài Hi FPT (bao gồm guest)</option>
                                    <option value="all_hifpt">Tất cả KH có dùng dịch vụ (không bao gồm guest)</option>
                                    <option value="guest">Tất cả KH không dùng dịch vụ (guest)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="show_from" class="control-label"><small class="req text-danger">* </small>Ngày hiển thị </label>
                                <input type="text" name="show_from" value="{{ old('show_from') }}" id="public_date_start"
                                       class="form-control datetimepicker" onchange="changePublicDateTime(this)" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="show_to" class="control-label"><small class="req text-danger">* </small> Ngày kết thúc </label>
                                <input type="text" name="show_to" value="{{ old('show_to') }}" id="public_date_end"
                                       class="form-control datetimepicker" onchange="changePublicDateTime(this)" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="show_target_route">
                        <div class="icheck-carrot">
                            <input type="checkbox" id="has_target_route" name="has_target_route" onchange="onchangeDirection()"
                                   value="checked"/>
                            <label for="has_target_route">Điều hướng</label>
                        </div>
                        <div class="border box-target" id="box_target" style="display: none">
                            <label for="target_route">Điều hướng đến</label>
                            <div id="collapseOne" style="transition: height 0.01s;">
                                {{-- <label for="target_route">Target Id</label> --}}
                                <select data-actions-box="1" data-width="100%"
                                        data-none-selected-text="Không có mục nào được chọn"
                                        data-live-search="true" tabindex="-98" type="file" name="direction_id"
                                        class="form-control p selectpicker" id="direction_id" onchange="onchangeTargetRoute()"
                                        data-live-search="true" data-size="10">
                                    @forelse($list_target_route as $target)
                                        <option value="{{$target->id}}">{{ $target->name }}</option>
                                    @empty
                                        <option>Error data</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group" id="direction_url">
                                <label for="event_url">URL</label>
                                <input type="text" id="event_url" name="directionUrl" value="{{ old('directionUrl') }}"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div id="isShowHomeGroup" class="form-group" style="display: none">
                        <div class="icheck-carrot">
                            <input type="checkbox" id="isShowHome" name="isShowHome" checked/>
                            <label for="isShowHome">Hiện ở Home</label>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <div class="model-footer" style="float: right">
            <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
            <button type="submit" id="submitAjax" class="btn btn-info">Submit</button>
        </div>
    </div>
</div>
