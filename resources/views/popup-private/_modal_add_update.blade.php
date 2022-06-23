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

<div id="push_popup_private" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Thông tin pop up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span></button>
            </div>
            <div class="modal-body" id="modal-detail-popup">
                <div class="col-12">
                    <form id="importExcel">
                        <div class="form-group">
                            <label class="" for="number_phone_import">Upload phone with excel</label>
                            <input onchange="uploadFile();" type="file" id="number_phone_import" name="excel"
                                   class="form-control"
                                   accept=".xlsx, .csv">
                        </div>
                    </form>
                </div>
                <form id="formActionPrivate" enctype="multipart/form-data">
                    <input type="hidden" id="id_popup" name="id">
                    <input type="hidden" id="temPerId_popup" name="temPerId">
                    <input type="hidden" id="popupGroupId_popup" name="popupGroupId">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="required_red_dot" for="number_phone">Danh sách số điện thoại cần hiển
                                thị</label>
                            <textarea type="text" id="number_phone" name="number_phone" class="form-control"
                                      placeholder="Có thể thêm nhiều số điện thoại cách nhau bằng dấu phẩy ','"></textarea>
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
                    <hr>
                    <div class="col-12 d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="titleVi_popup">Tiêu đề tiếng việt</label>
                                <input type="text" class="form-control" id="titleVi_popup"
                                       name="titleVi" placeholder="Tiêu đề tiếng việt (Nếu có)">
                            </div>

                            <div class="form-group">
                                <label for="titleEn_popup">Tiêu đề tiếng anh</label>
                                <input type="input" class="form-control" id="titleEn_popup"
                                       name="titleEn" placeholder="Tiêu đề tiếng anh (Nếu có)">
                            </div>

                            <div class="form-group">
                                <label for="desVi_popup">Mô tả tiếng việt</label>
                                <textarea name="desVi" id="desVi_popup" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="desEn_popup">Mô tả tiếng anh</label>
                                <textarea name="desEn" id="desEn_popup" class="form-control"></textarea>
                            </div>

                            <div class="form-group" id="iconUrl">
                                <label class="required_red_dot">Ảnh</label>
                                <input type="file" accept="image/*" name="iconUrl" class="form-control"
                                       onchange="handleUploadImagePopup(this,event)"/>
                                <img id="iconUrl_popup" src=""
                                     alt="Ảnh Popup" class="img-thumbnail img_viewable"
                                     style="max-width: 150px;padding:10px;margin-top:10px"/>
                                <input name="iconUrl" id="iconUrl_popup_name" value="" hidden/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required_red_dot">Loại popup</label>
                                <select class="form-control select2" name="type"
                                        id="type_popup"
                                        style="width: 100%;">
                                    <option value="">-- Chọn loại popup --</option>
                                    @foreach($list_type_popup as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="dieuhuong">
                                <label for="actionType_popup" class="required_red_dot">Điều hướng</label>
                                <select class="form-control select2" name="actionType"
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

                            <div class="form-group" id="form_directionUrl">
                                <label for="dataAction_popup"> URL điều hướng </label>

                                <input type="input" class="form-control" id="dataAction_popup"
                                       name="dataAction" placeholder="URL điều hướng">
                            </div>
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
                    <br>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">
                                <p>*** LƯU Ý ***<br>
                                    - Chỉ được tải lên tối đa 30.000 số điện thoại (chuẩn số điện thoại Việt Nam)<br>
                                    - Trong một phút chỉ được thêm tối đa 5 popup <br>
                                    - Các trường có kí hiệu <span class="text-bold text-danger">(*)</span> là những
                                    trường bắt buộc phải nhập <br>
                                    - Các trường hợp xảy ra lỗi ngoại lệ vui lòng liên hệ <a
                                        href="https://zalo.me/0354370175" target="_blank">hỗ trợ</a>
                                </p> <br>
                            </li>
                        </ol>
                    </nav>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info float-right" id="submit">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
