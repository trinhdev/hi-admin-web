{{--
Create by: trinhdev
Update at: 2022/06/22
Contact: trinhhuynhdp@gmail.com

ADD FIELD
    'type' x (loại popup - get data form api list_route)
    'actionType' x (nơi hiều hướng)
    'dataAction' x (nơi hiều hướng)
    'iconButtonUrl' (ảnh button)
    'iconUrl' x (ảnh)
    'dateBegin' x
    'dateEnd' x
    'phoneList' x
    'titleVi' x
    'titleEn' x
    'desVi' x
    'desEn' x

END ADD FIELD

--}}
<div class="row">
    <div class="col-md-12">
        <form id="formActionPrivate" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <p>*** LƯU Ý ***<br>
                            - Trong một phút chỉ được thêm tối đa 5 popup <br>
                            - Các trường có kí hiệu <span class="text-bold text-danger">(*)</span> là những
                            trường bắt buộc phải nhập
                        </p></div>
                    <input type="hidden" id="id_popup" name="id">
                    <input type="hidden" id="temPerId_popup" name="temPerId">
                    <input type="hidden" id="popupGroupId_popup" name="popupGroupId">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="titleVi_popup">Tiêu đề tiếng việt</label>
                                <input type="text" class="form-control" id="titleVi_popup"
                                       name="titleVi" placeholder="Tiêu đề tiếng việt (Nếu có)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="titleEn_popup">Tiêu đề tiếng anh</label>
                                <input type="input" class="form-control" id="titleEn_popup"
                                       name="titleEn" placeholder="Tiêu đề tiếng anh (Nếu có)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"><small class="req text-danger">* </small>Loại popup</label>
                                <select class="form-control" name="type"
                                        id="type_popup"
                                        style="width: 100%;">
                                    <option value="">-- Chọn loại popup --</option>
                                    @foreach($list_type_popup as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="dieuhuong">
                                <label for="actionType_popup" class="control-label"><small class="req text-danger">* </small>Điều hướng</label>
                                <select class="form-control" name="actionType"
                                        id="actionType_popup"
                                        style="width: 100%;">
                                    <option value="">-- Chọn nơi điều hướng --</option>
                                    @if($list_route)
                                        @foreach($list_route as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="iconUrl">
                                <label class="control-label"><small class="req text-danger">* </small>Ảnh</label>
                                <input type="file" accept="image/*" name="iconUrl" class="form-control"
                                       onchange="handleUploadImagePopup(this,event)"/>
                                <img id="iconUrl_popup" src=""
                                     alt="Ảnh Popup" class="img-thumbnail img_viewable"
                                     style="max-width: 150px;padding:10px;margin-top:10px"/>
                                <input name="iconUrl" id="iconUrl_popup_name" value="" hidden/>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group" id="iconButtonUrl">
                                <label>Nút điều hướng</label>
                                <input type="file" accept="image/*" name="iconButtonUrl" class="form-control"
                                       onchange="handleUploadImagePopup(this,event)"/>
                                <img id="iconButtonUrl_popup"
                                     src="/images/image_holder.png"
                                     alt="Ảnh button" class="img-thumbnail img_viewable"
                                     style="max-width: 150px;padding:10px;margin-top:10px"/>
                                <input name="iconButtonUrl" id="iconButtonUrl_popup_name" hidden/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label"><small class="req text-danger">* </small>Thời gian hiển thị</label>
                                <div class="input-group">
                                    <input type="text" class="form-control float-right daterange" id="timeline"
                                           name="timeline">
                                    <div class="input-group-addon">
                                        <i class="fa-regular fa-calendar calendar-icon"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="form_directionUrl">
                                <label class="control-label" for="dataAction_popup"><small class="req text-danger">* </small> URL điều hướng </label>
                                <input type="input" class="form-control" id="dataAction_popup"
                                       name="dataAction" placeholder="URL điều hướng">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info float-right" id="submit">Lưu</button>
            </div>
        </form>
    </div>
</div>

