<form id="formUpdateBanner" enctype="multipart/form-data">
    <input type="hidden" id="event_id" name="id">
    <div class="card-info">
        <div class="card-body">
            <div class="card-body">
                <div class="form-group" id="bannerImage1">
                    <label class="required_red_dot">Ảnh</label>
                    <input type="file" accept="image/*" name="bannerImage1" class="form-control" onchange="handleUploadImage(this)" />
                    <img id="img_bannerImage1" src="{{ asset('/images/image_holder.png') }}" alt="your image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px" />
                    <input name="imageFileName" id="img_bannerImage1_name" value="" hidden />
                </div>

            </div>
        </div>
        <div class="card-footer" style="text-align: center">
            <a href="{{ route('bannermanage.index') }}" type="button" class="btn btn-default">Thoát</a>
            <button type="submit" id="submitAjaxUpdate" class="btn btn-info">Lưu</button>
        </div>
    </div>
</form>
