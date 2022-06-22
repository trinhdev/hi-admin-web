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
    <a id="detailPopup" data-id="{{ $model->id }}" style="float: left; margin-right: 5px" type="button" href="#" class="btn btn-sm fa fa-eye btn-icon bg-dark"></a>
    <a id="deletePopup"  data-id="{{ $model->id }}"  data-check-delete="{{ $model->isActive }}" type="button" href="#" class="btn btn-sm fas fa-trash-alt btn-icon bg-dark"></a>
</div>
