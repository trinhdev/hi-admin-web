<form id="formExport">
    @csrf
    <input type="hidden" id="event_id" name="id">
    <div class="card-info">
        <div class="card-body">
            <div class="card-body">
                <div class="form-row">
                    <input class="form-control" id="daterange" type="text" name="daterange" autocomplete="off"/>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="text-align: center">
            <a href="{{ route('bannermanage.index') }}" type="button" class="btn btn-default">Thoát</a>
            <button type="submit" class="btn btn-info">Lưu</button>
        </div>
    </div>
</form>
