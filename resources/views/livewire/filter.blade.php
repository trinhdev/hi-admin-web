@push('script')
    <script>
        $('#daterange').on('change', function(e){
        @this.set('selectedDate', e.target.value)
        });

        $('#select_type').on('change', function(e){
        @this.set('selectedType', e.target.value)
        });

        $('#select_chart').on('change', function(e){
        @this.set('selectedChart', e.target.value)
        });
        $(document).ready(function() {
            $('.daterange').daterangepicker({
                showDropdowns: true,
                ranges: {
                    'Hôm nay': [moment(), moment()],
                    'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 ngày qua': [moment().subtract(6, 'days'), moment()],
                    '30 ngày qua': [moment().subtract(29, 'days'), moment()],
                    '60 ngày qua': [moment().subtract(59, 'days'), moment()],
                    'Trong tháng này': [moment().startOf('month'), moment().endOf('month')],
                    'Trong tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: "YYYY-MM-DD",
                },
            }).on('show.daterangepicker', function(ev, picker) {
                picker.autoUpdateInput = true;
            });;
        });

    </script>
@endpush
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="select_chart" class="control-label">Loại biểu đồ</label>
            <select wire:change="showDiv" id="select_chart" class="form-control">
                <option value="" >Chọn loại biểu đồ</option>
                @foreach(config('charts.charts') as $key => $value)
                    <option value="{{ $key }}" data-subtext="{{ $value }}" >{{ $key }} - {{ $value }}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="col-md-3">
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
    <div class="col-md-2">
        <div class="form-group">
            <label for="select_type" class="control-label">Kiểu hiển thị</label>
            <select wire:model="selectedType" id="select_type" class="form-control">
                <option value="line" data-subtext="Biểu đồ đường" >Line</option>
                <option value="bar" data-subtext="Biểu đồ cột">Bar</option>
            </select>
        </div>
    </div>
    @if (!empty($showDiv))
    <div class="col-md-2">
        <div class="form-group">
            <label for="limit" class="control-label">Top Screen Limit</label>
            <input wire:model="selectedLimit" id="limit" min="0" max="500"
                   class="form-control" type="number" name="limit"
                   placeholder="Số giới hạn top màn hình" autocomplete="off"/>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="duration" class="control-label">Screen Duration </label>
            <input wire:model="selectedDuration" id="duration" min="0" max="500000"
                   class="form-control" type="number" name="duration"
                   placeholder="Duration lớn hơn bao nhiêu (s)" autocomplete="off"/>
        </div>
    </div>
    @endif
</div>
