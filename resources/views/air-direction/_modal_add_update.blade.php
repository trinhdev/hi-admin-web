{{--
Create by: trinhdev
Update at: 2022/06/22
Contact: trinhhuynhdp@gmail.com
--}}

<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                    <p>*** LƯU Ý ***<br>
                        - Các trường có kí hiệu <span class="text-bold text-danger">(*)</span> là những
                        trường bắt buộc phải nhập <br>
                        - Field giá trị điều hướng bắt buộc là một URL <br>
                        - Các trường hợp xảy ra lỗi ngoại lệ vui lòng liên hệ
                        <a href="https://zalo.me/0354370175" target="_blank"><b> hỗ trợ</b></a>
                    </p>
                </li>
            </ol>
        </nav>
        <form id="formActionAirDiretion" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" id="id_air_direction" name="id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_air_direction" class="required_red_dot"><small class="req text-danger">* </small>Tên điều hướng</label>
                                <input type="text" class="form-control" id="name_air_direction"
                                       name="name" placeholder="Tên điều hướng">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="key_air_direction" class="required_red_dot"><small class="req text-danger">* </small>Khóa điều hướng</label>
                                <select class="form-control selectpicker" id="key_air_direction"
                                        name="key" placeholder="Khóa điều hướng">
                                    <option value="0" selected>In app</option>
                                    <option value="1">Webkit</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="decription_air_direction" class="required_red_dot"><small class="req text-danger">* </small>Mô tả điều hướng</label>
                                <textarea name="decription" cols="10" rows="5" class="form-control"
                                          id="decription_air_direction"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="value_air_direction" class="required_red_dot"><small class="req text-danger">* </small>Giá trị điều hướng</label>
                                <textarea class="form-control" name="value"
                                          id="value_air_direction"
                                          scols="10" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="modal-footer">
            <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info float-right" id="submit">Lưu</button>
        </div>
    </div>
</div>
