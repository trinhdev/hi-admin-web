<div class="row justify-content-md-center">
    <div class="col-sm-12">
        <form id="formData">
            <div class="card-body">
                <div class="form-group">
                    <label for="bannerType" class="required_red_dot">Trạng thái lỗi thanh toán</label>
                    <select type="text" name="status" class="form-control" id="status">
                        <option value="0">Chưa tiếp nhận</option>
                        <option value="1">Đã chuyển tiếp</option>
                        <option value="2">Đang xử lí</option>
                        <option value="3">Đã xử lí</option>
                        <option value="4">Hủy bỏ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="required_red_dot">Mô tả trạng thái lỗi</label>
                    <input type="text" name="description_error" list="description_error" class="form-control description_error" autocomplete="off">
                    <datalist id="description_error">
                        @foreach(explode(',', setting('hi_admin_web_service_payment_support_description')) as $value)
                            <option value="{!! $value !!}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="form-group">
                    <label for="description" class="required_red_dot">Ghi chú</label>
                    <textarea name="description" class="form-control" id="description"
                              placeholder="Nếu đã xử lí, lưu lại mô tả ở đây ..."></textarea>
                </div>
            </div>
            <div class="card-footer" style="text-align: center">
                <a href="{{ route('paymentSupport.index') }}" type="button" class="btn btn-default">Thoát</a>
                <button type="submit" id="submitAjax" class="btn btn-info">Lưu</button>
            </div>
        </form>
    </div>
</div>
