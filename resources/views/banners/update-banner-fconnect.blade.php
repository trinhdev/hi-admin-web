<div class="modal fade" id="showFormUpdateFconnect_Modal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Update banner fconnect</h4>
            </div>
            <div class="modal-body">
                <form id="formUpdateBanner" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group" id="bannerImage1">
                                    <label class="required_red_dot">Ảnh</label>
                                    <input type="file" accept="image/*" name="bannerImage1" class="form-control" onchange="handleUploadImage(this)" />
                                    <img id="img_bannerImage1" src="{{ asset('/images/image_holder.png') }}" alt="your image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px" />
                                    <input name="imageFileName" id="img_bannerImage1_name" value="" hidden />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitAjaxUpdate" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
