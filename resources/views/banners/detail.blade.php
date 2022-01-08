<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-sm-12">
            <form>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title uppercase">Thông tin Banner</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Tiêu đề tiếng Việt</label>
                                <input type="text" name="title_vi" class="form-control" id="BannerDetail_titleVi" disabled>
                            </div>
                            <div class="form-group">
                                <label for="title">Tiêu đề tiếng Anh</label>
                                <input type="text" name="title_en" class="form-control" id="BannerDetail_titleEn" disabled>
                            </div>
                            <div class="form-group">
                                <label for="bannerType">Vị trí hiển thị</label>
                                <input  type="text" name="bannerType" class="form-control" id="BannerDetail_bannerType" disabled/>
                            </div>
                            <div class="form-group" id="path_1">
                                <div><label>Ảnh</label></div>
                                <img  src="http://hiadmin.local/images/image_holder.png" alt="your image" id ="BannerDetail_image" class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px">
                            </div>
                            <div class="form-group" id="path_2" hidden>
                                <img src="http://hiadmin.local/images/image_holder.png" alt="your image" id ="BannerDetail_thump_image"  class="img-thumbnail img_viewable" style="max-width: 150px;padding:10px;margin-top:10px">
                                <span><i>&nbsp; &nbsp;&nbsp;(* đây là ảnh hiển thị ở Home)</i></span>
                            </div>
                            <div class="form-group">
                                <label for="object_type" >Loại Đối tượng</label>
                                <input type="text" name="title_en" class="form-control" value="Nhóm được đăng ký sẵn" disabled>
                            </div>
                            <div class="form-group">
                                <label for="object" >Đối tượng</label>
                                 <input type="text" name="title_en" class="form-control" value="Tất cả KH cài Hi FPT (bao gồm guest)" disabled>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="show_from">Ngày hiển thị </label>
                                    <input type="datetime-local" name="show_from" id="BannerDetail_public_date_start"  class="form-control" disabled>
                                </div>
                                <div class="col">
                                    <label for="show_to"> Ngày kết thúc </label>
                                    <input type="datetime-local" name="show_to" id="BannerDetail_public_date_end" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group" id="show_target_route">
                                <div class="icheck-carrot">
                                    <input type="checkbox" id="has_target_route" name="has_target_route" checked disabled>

                                    <label for="has_target_route">Điều hướng</label>
                                </div>
                                <div class="border box-target" id="box_target">
                                    <label for="target_route">Điều hướng đến</label>
                                    <div id="collapseOne" tyle="transition: height 0.01s;">
                                        <input type="text" name="title_en" class="form-control" value="Tất cả KH cài Hi FPT (bao gồm guest)" disabled/>
                                    </div>
                                    <div class="form-group" id="direction_url">
                                        <label for="direction_url">URL</label>
                                        <input type="text" name="title_en" class="form-control" value="Tất cả KH cài Hi FPT (bao gồm guest)" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="icheck-carrot">
                                    <input type="checkbox" id="isHighlight" name="isHighlight" checked disabled>
                                    <label for="isHighlight">Hiện ở Home</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align: center">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Đóng</button>
                        <a href="http://hiadmin.local/bannermanage" data-dismiss="modal" aria-label="Close" type="button" class="btn btn-info">Chỉnh sửa</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
