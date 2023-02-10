<div class="card-info">
    <div class="card-body">
        <form id="importExcel" enctype="multipart/form-data" action="{{ $action }}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" id="id_popup_phone" name="id">
            <div class="form-group">
                <label for="number_phone"><span
                        class="required_red_dot">Nhập vào danh sách số điện thoại</span> <br>
                    <p class="fa-xs">hoặc tải file excel
                        <input type="file" id="number_phone_import" name="excel[]"
                               accept=".xlsx, .csv" multiple></p>
                </label>
                <div class="form-group">
                                            <textarea rows="6" type="text" id="number_phone" name="number_phone"
                                                      class="form-control"
                                                      placeholder="Có thể thêm nhiều số điện thoại cách nhau bằng dấu phẩy ','"></textarea>
                </div>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <span><b>LƯU Ý</b></span>
                    <ul>
                        <li>Nếu như tải lên file exel, lưu số điện thoại theo 1 cột duy nhất
                            theo hàng dọc, Tải file mẫu
                            <a href="https://docs.google.com/spreadsheets/d/1ifAR0UwfdV03Sidcshjvwl1pn1YmYBD9/edit?usp=sharing&ouid=113322866597815571901&rtpof=true&sd=true"
                               target="_blank"> <b> tại đây</b> <a/>
                        </li>
                        <li>Tải lên tối đa 5 file, mỗi file chỉ được chứa tối đa <b>100.000</b> số
                            điện thoại
                        </li>
                        <li>Các trường hợp xảy ra lỗi ngoại lệ vui lòng liên hệ
                            <a href="https://zalo.me/0354370175" target="_blank"><b> hỗ trợ</b></a>
                        </li>
                    </ul>
                </ol>
            </nav>

            <div class="card-footer d-flex container-fluid justify-content-center" style="text-align: center">
                {!! $button !!}
            </div>
        </form>
    </div>
</div>

