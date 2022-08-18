{{--
Create by: trinhdev
Update at: 2022/06/22
Contact: trinhhuynhdp@gmail.com

ACTION PAGE
    * detail button
    * delete button (done)
END ACTION PAGE

--}}

<div class="d-flex justify-content-center">
    @if($model->isActive == 1)
        <a onclick="dialogConfirmWithAjax(deletePopUpPrivate, this)" id="deletePopup" data-check-delete="{{ $model->isActive }}" data-id="{{ $model->id }}"
           style="float: left; margin-right: 5px;"
           type="button" href="#" class="btn btn-sm bg-primary"><i class="fa fa-pause" aria-hidden="true"></i></a>
    @else
        <a onclick="dialogConfirmWithAjax(deletePopUpPrivate, this)" id="deletePopup"
           data-check-delete="{{ $model->isActive }}" data-id="{{ $model->id }}" data-dateend="{{ $model->dateEnd }}"
           style="float: left; margin-right: 5px;"
           type="button" href="#" class="btn btn-sm bg-primary"><i class="fa fa-play" aria-hidden="true"></i></a>
    @endif
    <a id="detailPopup" data-id="{{ $model->id }}"
       style="float: left; margin-right: 5px; background: #007bff"
       class="btn btn-sm fas fa-edit bg-primary"></a>
    <a id="updatePhoneNumber" data-id="{{ $model->id }}"
       style="float: left; margin-right: 5px; background: #007bff"
       class="btn btn-sm fas fa-clipboard btn-icon bg-primary"></a>
</div>
