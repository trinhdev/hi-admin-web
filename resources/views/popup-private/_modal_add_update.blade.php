{{--
Create by: trinhdev
Update at: 2022/06/22
Contact: trinhhuynhdp@gmail.com

ADD FIELD
    'type' x (loại popup - get data form api list_route)
    'actionType'
    'dataAction' x (nơi hiều hướng)
    'iconButtonUrl' (ảnh button)
    'iconUrl' x (ảnh)
    'dateBegin'
    'dateEnd'
    'phoneList' x
    'titleVi' x
    'titleEn' x
    'desVi' x
    'desEn' x
    'popupGroupId'
    'temPerId'

END ADD FIELD

--}}

<div id="show_detail_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Thông tin pop up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span></button>
            </div>
            <div class="modal-body" id="modal-detail-popup">
                <form id="formAction" action="{{route('popupmanage.save')}}" method="POST"
                      onchange="checkEnableSavePopup(this)" onSubmit="validateDataPopup(event,this)">
                    @csrf
                    <div class="col-12 d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="titleVi_popup">Tiêu đề tiếng việt</label>
                                <input type="text" class="form-control" id="titleVi_popup"
                                       name="titleVi" placeholder="Tiêu đề tiếng việt (Nếu có)" value="">
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
                            <div class="form-group" id="image">
                                <label class="required_red_dot">Ảnh</label>
                                <input type="file" accept="image/*" name="image" class="form-control"
                                       onchange="handleUploadImagePopup(this,event)"/>
                                <img id="image_popup" src=""
                                     alt="Ảnh Popup" class="img-thumbnail img_viewable"
                                     style="max-width: 150px;padding:10px;margin-top:10px"/>
                                <input name="iconUrl" id="image_popup_name" value="" hidden/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required_red_dot">Loại popup</label>
                                <select class="form-control select2" name="type"
                                        id="templateType_popup"
                                        style="width: 100%;">
                                    <option value="">-- Chọn loại popup --</option>
                                    @foreach($list_type_popup as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="dieuhuong">
                                <label>Điều hướng</label>
                                <select class="form-control select2" name="dataAction"
                                        id="directionId_popup"
                                        style="width: 100%;">
                                    <option value="" selected>-- Chọn nơi điều hướng --</option>
                                    @if($list_route)
                                        @foreach($list_route as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group" id="buttonImage">
                                <label>Nút điều hướng</label>
                                <input type="file" accept="image/*" name="buttonImage" class="form-control"
                                       onchange="handleUploadImagePopup(this,event)"/>
                                <img id="buttonImage_popup"
                                     src="/images/image_holder.png"
                                     alt="Ảnh button" class="img-thumbnail img_viewable"
                                     style="max-width: 150px;padding:10px;margin-top:10px"/>
                                <span class="warning-alert" id="path_2_required_alert" hidden>This field is
                                        required!</span>
                                <input name="iconButtonUrl" id="buttonImage_popup_name" hidden/>
                            </div>
                            <div class="form-group" id="form_directionUrl">
                                <label for="buttonActionValue_popup">URL điều hướng</label>
                                <input type="input" class="form-control" id="buttonActionValue_popup"
                                       name="dataAction" placeholder="URL điều hướng">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tần suất popup xuất hiện</label>
                            <div class="row">
                                <div class="col-12">
                                    <select class="form-control" name="repeatTime" id="repeatTime">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Đối tượng</label>
                            <select class="form-control" name="object" id="object">

                            </select>
                        </div>
                        <div class="form-group row">
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
                        <div class="form-group">
                            <label for="number_phone">Danh sách số điện thoại cần hiển thị</label>
                            <textarea type="text" id="number_phone" name="number_phone" class="form-control" placeholder="Có thể thêm nhiều số điện thoại cách nhau bằng dấu phẩy ','" ></textarea>
                        </div>
                    </div>
                </form>
                <div class="col-md-12">
                    <form action="{{route('ftel_phone.import')}}" id="importExcel" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="" for="number_phone_import">Upload phone with excel</label>
                            <input onchange="uploadFile()" type="file" id="number_phone_import" name="excel"
                                   class="form-control @error('exel') is-invalid @enderror"
                                   accept=".xlsx, .csv">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info float-right" id="submit_data" disabled>Lưu</button>
            </div>
        </div>
    </div>
</div>
