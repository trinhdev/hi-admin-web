<div class="d-flex justify-content-center">
    <a style="float: left; margin-right: 5px" type="button" href="{{ route('popupmanage.view', [$model->id ]) }}" class="btn btn-sm fa fa-paper-plane btn-icon bg-dark"></a>
    <a id="detailPopup" data-id="{{ $model->id }}" style="float: left; margin-right: 5px" type="button" href="#" class="btn btn-sm fa fa-eye btn-icon bg-dark"></a>
{{--    @if(Auth::user()->role_id == ADMIN || $aclCurrentModule->update == 1)--}}
{{--    <a style="" type="button" href="{{ route('popupmanage.edit', [$model->id]) }}" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>--}}
{{--    @endif--}}

    <a onClick="alert('Chức năng đang update - liên hệ trinhhdp@fpt.com.vn')" type="button" href="#" class="btn btn-sm fas fa-trash-alt btn-icon bg-dark"></a>
</div>
