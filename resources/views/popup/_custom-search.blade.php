<div class="container">
    <div class="card-body row form-inline">
        <div class="col-md-4 m-auto">
            <div class="input-group input-group-sm mb-4">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="show_at">Vị Trí Hiển Thị: </label>
                </div>
                <select class="custom-select" name="popupType" id="show_at" placeholder="Show at">
                    <option value=''>Tất Cả</option>
                    @if(!empty($list_template_popup))
                    @foreach($list_template_popup as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    @endif
                </select>
            </div>   
        </div>
    </div>
</div>