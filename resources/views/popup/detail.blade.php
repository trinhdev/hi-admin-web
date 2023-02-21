<div class="row">
    <div class="col-md-12">
        <form id="formAction" action="{{route('popupmanage.save')}}" method="POST">
            <input type="hidden" id="id_popup" name="id_popup" value="">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titleVi" class="required_red_dot">Tiêu đề tiếng việt</label>
                            <input type="text" class="form-control" id="titleVi_popup" name="titleVi"
                                   placeholder="Tiêu đề tiếng việt" value="">
                        </div>
                        <div class="form-group" id="image">
                            <label class="required_red_dot">Ảnh</label>
                            <input type="file" accept="image/*" name="image" class="form-control"
                                   onchange="handleUploadImagePopup(this,event)"/>
                            <img id="image_popup"
                                 src=""
                                 alt="your image" class="img-thumbnail img_viewable"
                                 style="max-width: 150px;padding:10px;margin-top:10px"/>
                            <input name="image_popup_name" id="image_popup_name" value="" hidden/>
                        </div>
                        <div class="form-group">
                            <label class="required_red_dot">Loại popup</label>
                            <select class="form-control" name="templateType" id="templateType_popup"
                                    style="width: 100%;">
                                <option value="">-- Chọn loại popup --</option>
                                @foreach($list_type_popup as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="dieuhuong">
                            <label>Điều hướng</label>
                            <select class="form-control" name="directionId" id="directionId_popup"
                                    style="width: 100%;">
                                <option value="">-- Chọn nơi điều hướng --</option>
                                @if($list_route)
                                    @foreach($list_route as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titleEn" class="required_red_dot">Tiêu đề tiếng anh</label>
                            <input type="input" class="form-control" id="titleEn_popup" name="titleEn"
                                   placeholder="Tiêu đề tiếng anh">
                        </div>
                        <div class="form-group" id="buttonImage">
                            <label>Nút điều hướng</label>
                            <input type="file" accept="image/*" name="buttonImage" class="form-control"
                                   onchange="handleUploadImagePopup(this,event)"/>
                            <img id="buttonImage_popup"
                                 src=""
                                 alt="Hình ảnh" class="img-thumbnail img_viewable"
                                 style="max-width: 150px;padding:10px;margin-top:10px"/>
                            <input name="buttonImage_popup_name" id="buttonImage_popup_name" hidden/>
                        </div>

                        <div class="form-group" style="display: none" id="form_directionUrl">
                            <label for="exampleInputEmail1">URL điều hướng</label>
                            <input type="input" class="form-control" id="dataAction_popup" name="directionUrl"
                                   placeholder="URL điều hướng">
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.card-body -->
            <div class="model-footer" style="float: right">
                <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                <button type="button" onclick="storePopup()" class="btn btn-info">Submit</button>
            </div>
        </form>

    </div>
</div>
