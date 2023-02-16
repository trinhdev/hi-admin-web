<div class="row">
    <div class="col-md-3">
        <div class="form-group" app-field-wrapper="member_filter">
            <label for="member_filter" class="control-label">Vị trí hiển thị</label>
            <div class="dropdown bootstrap-select show-tick bs3" style="width: 100%;">
                <select id="select_filter" class="selectpicker" data-actions-box="1" data-width="100%"
                        data-none-selected-text="Không có mục nào được chọn"
                        data-live-search="true" tabindex="-98">
                    <option data-subtext="Không có mục nào được chọn"></option>
                    @forelse($list_type_banner as $type)
                        <option class="text-capitalize" value="{{$type->key}}" data-subtext="{{$type->key}}">{{$type->name}}</option>
                    @empty
                        <option value="1" data-subtext="Trình">Huỳnh</option>
                    @endforelse
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group" app-field-wrapper="from_date">
            <label for="daterange" class="control-label">Từ ngày</label>
            <div class="input-group date">
                <input id="daterange"  class="form-control daterange" type="text" name="daterange"
                       placeholder="Nhập ngày hiển thị" autocomplete="off"/>
                <div class="input-group-addon">
                    <i class="fa-regular fa-calendar calendar-icon"></i>
                </div>
            </div>
        </div>
    </div>
</div>
