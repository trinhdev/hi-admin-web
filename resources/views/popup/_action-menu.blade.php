<div class="d-flex justify-content-center">
    <a style="float: left; margin-right: 5px" type="button" href="{{ route('popupmanage.view', [$model->id ]) }}" class="btn btn-sm fa fa-paper-plane btn-icon bg-primary"></a>
    <a id="detailPopup" data-id="{{ $model->id }}" style="float: left; margin-right: 5px" type="button" href="#" class="btn btn-sm fa fa-edit btn-icon bg-primary"></a>
    <a id="exportPopup" data-id="{{ $model->id }}" type="button" href="#" class="btn btn-sm fas fa-file btn-icon bg-primary"></a>
</div>
