<form id="formExport">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" id="event_id" name="id">
            <div class="form-row">
                <input class="form-control daterange" type="text" name="daterange" autocomplete="off"/>
            </div>
            <div class="modal-footer" style="float: right">
                <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Download</button>
            </div>
        </div>
    </div>
</form>
