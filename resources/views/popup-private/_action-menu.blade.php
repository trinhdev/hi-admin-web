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
        <a id="deletePopup" data-check-delete="{{ $model->isActive }}" data-id="{{ $model->id }}"
           style="float: left; margin-right: 5px;"
           type="button" href="#" class="btn btn-sm bg-primary"><i class="fa fa-pause" aria-hidden="true"></i></a>
    @else
        <a id="deletePopup" data-check-delete="{{ $model->isActive }}" data-id="{{ $model->id }}"
           style="float: left; margin-right: 5px;"
           type="button" href="#" class="btn btn-sm bg-primary"><i class="fa fa-play" aria-hidden="true"></i></a>
    @endif
    <a id="detailPopup" data-id="{{ $model->id }}"
       style="float: left; margin-right: 5px; background: #007bff" type="button" href="#"
       class="btn btn-sm fas fa-edit btn-icon bg-primary"></a>
</div>
