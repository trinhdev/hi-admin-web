<form id="formExport">
    <input type="hidden" id="event_id" name="id">
    <div class="card-info">
        <div class="card-body">
            <div class="col-md-12">
                <div class="input-group mb-4">
                    <div class="input-group-prepend ">
                        <div class="input-group-text"><i class="fa fa-calendar"></i>&nbsp;</div>
                    </div>
                    <input class="form-control" id="daterange" type="text" name="daterange" autocomplete="off"/>
                </div>
            </div>
        </div>
        <div class="card-footer" style="text-align: center">
            <a href="{{ route('popupmanage.index') }}" type="button" class="btn btn-default">Thoát</a>
            <button type="submit" class="btn btn-info">Lưu</button>
        </div>
    </div>
</form>
