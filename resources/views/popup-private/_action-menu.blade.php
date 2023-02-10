{{--
Create by: trinhdev
Update at: 2022/06/22
Contact: trinhhuynhdp@gmail.com

ACTION PAGE
    * detail button
    * delete button (done)
END ACTION PAGE

--}}

<div class="d-flex justify-content-center m-auto">
    <div class="btn-group dropleft">
        <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
            Action
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu m-80" role="menu">
            @if($model->isActive == 1)
                <a onclick="dialogConfirmWithAjax(deletePopUpPrivate, this)" id="deletePopup" data-check-delete="{{ $model->isActive }}" data-id="{{ $model->id }}"
                   style="float: left; margin-right: 5px;"
                   type="button" href="#" class="dropdown-item">Stop</a>
            @else
                <a onclick="dialogConfirmWithAjax(deletePopUpPrivate, this)" id="deletePopup"
                   data-check-delete="{{ $model->isActive }}" data-id="{{ $model->id }}" data-dateend="{{ $model->dateEnd }}"
                   style="float: left; margin-right: 5px;"
                   type="button" href="#" class="dropdown-item"><i class="fa fa-play" aria-hidden="true"></i></a>
            @endif
            <a id="detailPopup" data-id="{{ $model->id }}" class="dropdown-item">{{__('Edit')}}</a>
            <a id="updatePhoneNumber" data-id="{{ $model->id }}" class="dropdown-item">{{__('Import phone')}}</a>
            <a id="exportPopup" data-id="{{ $model->temPerId }}" class="dropdown-item">{{__('Export phone click')}}</a>
        </div>
    </div>

</div>
