<form id="formExport">
    <input type="hidden" id="event_id" name="id">
    <div class="card-info">
        <div class="card-body">
            <div class="card-body">
                <div class="form-row">
                    <div class="col">
                        <label for="show_from" class="required_red_dot">Ngày bắt đầu </label>
                        <input type="datetime-local" name="show_from" value="{{ old('show_from') }}" id="public_date_start" class="form-control" onchange="changePublicDateTime(this)" />
                    </div>
                    <div class="col">
                        <label for="show_to" class="required_red_dot"> Ngày kết thúc </label>
                        <input type="datetime-local" name="show_to" value="{{ old('show_to') }}" id="public_date_end" class="form-control" onchange="changePublicDateTime(this)" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer" style="text-align: center">
            <a href="{{ route('bannermanage.index') }}" type="button" class="btn btn-default">Thoát</a>
            <button type="submit" id="submitAjaxExport" class="btn btn-info">Lưu</button>
        </div>
    </div>
</form>
