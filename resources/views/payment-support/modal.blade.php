<div class="row justify-content-md-center">
    <div class="col-sm-12">
        <form id="formData">
            <div class="card-body">
                <div class="form-group">
                    <label for="bannerType" class="required_red_dot">Trạng thái lỗi thanh toán</label>
                    <select type="text" name="status" class="form-control" id="event_type">
                        <option value="0">Chưa tiếp nhận</option>
                        <option value="1">Đã xử lí</option>
                        <option value="2">Hủy bỏ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description_error_code" class="required_red_dot">Ghi chú</label>
                    <textarea name="description_error_code" class="form-control" id="description_error_code"
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
