@if(Auth::user()->role_id == ADMIN)
<a style="float: left; margin-right: 5px" type="button" href="{{ route('popupmanage.view', [$model->id]) }}" class="btn btn-sm fas fa-eye btn-icon bg-primary"></a>
<a style="" type="button" href="{{ route('popupmanage.edit', [$model->id]) }}" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
@endif