@push('script')
    <script>
        $(document).ready(function() {
            $('#daterange').on('change', function(e){
                @this.set('selectedDate', e.target.value)
            });
        });
    </script>
@endpush
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="daterange" class="control-label">Lọc ngày</label>
            <div class="input-group date">
                <input id="daterange"
                       class="form-control daterange" type="text" name="daterange"
                       placeholder="Nhập ngày hiển thị" autocomplete="off"/>
                <div class="input-group-addon">
                    <i class="fa-regular fa-calendar calendar-icon"></i>
                </div>
            </div>
        </div>
    </div>
</div>
