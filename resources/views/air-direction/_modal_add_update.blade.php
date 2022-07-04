{{--
Create by: trinhdev
Update at: 2022/06/22
Contact: trinhhuynhdp@gmail.com

ADD FIELD
    'name' x
    'description' x
    'value' x
END ADD FIELD

--}}

<div id="push_air_direction" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Thông tin điều hướng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span></button>
            </div>
            <div class="modal-body" id="modal-detail-popup">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">
                            <p>*** LƯU Ý ***<br>
                                - Các trường có kí hiệu <span class="text-bold text-danger">(*)</span> là những
                                trường bắt buộc phải nhập <br>
                                - Field giá trị điều hướng bắt buộc là một URL <br>
                                - Các trường hợp xảy ra lỗi ngoại lệ vui lòng liên hệ
                                <a href="https://zalo.me/0354370175" target="_blank"><b> hỗ trợ</b></a>
                            </p> <br>
                        </li>
                    </ol>
                </nav>
                <form id="formActionAirDiretion" enctype="multipart/form-data">
                    <input type="hidden" id="id_air_direction" name="id">
                    <div class="col-12 d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_air_direction" class="required_red_dot">Tên điều hướng</label>
                                <input type="text" class="form-control" id="name_air_direction"
                                       name="name" placeholder="Tiêu đề tiếng việt (Nếu có)">
                            </div>

                            <div class="form-group">
                                <label for="decription_air_direction" class="required_red_dot">Mô tả điều hướng</label>
                                <textarea name="decription" cols="10" rows="5" class="form-control"
                                          id="decription_air_direction"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="value_air_direction" class="required_red_dot">Giá trị điều hướng</label>
                                <textarea class="form-control" name="value"
                                          id="value_air_direction"
                                          scols="10" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info float-right" id="submit">Lưu</button>
            </div>
        </div>
    </div>
</div>
