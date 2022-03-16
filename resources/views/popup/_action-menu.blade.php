@if(Auth::user()->role_id == ADMIN)
<div class="d-flex col-md-12">
    <a style="float: left; margin-right: 5px" type="button" href="{{ route('popupmanage.view', [$model->id ]) }}" class="btn btn-sm fas fa-eye btn-icon bg-primary col-md-6"></a>
    <a style="" type="button" href="{{ route('popupmanage.edit', [$model->id]) }}" class="btn btn-sm fas fa-edit btn-icon bg-olive col-md-6"></a>
</div>
@endif