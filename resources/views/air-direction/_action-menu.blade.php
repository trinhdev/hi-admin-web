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
    <a onclick="dialogConfirmWithAjax(deleteAirDirection, this)" data-key="{{ $model->key }}" data-id="{{ $model->id }}"
       style="float: left; margin-right: 5px;"
       type="button" href="#" class="btn btn-sm bg-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
    <a id="detailAirDirection" data-id="{{ $model->id }}"
       style="float: left; margin-right: 5px; background: #007bff" type="button" href="#"
       class="btn btn-sm fas fa-edit btn-icon bg-primary"></a>
</div>
