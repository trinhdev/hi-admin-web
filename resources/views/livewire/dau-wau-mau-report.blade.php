<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#daterange').on('change', function(e){
            @this.set('selectedDate', e.target.value)
        });

        $(document).ready(function() {
            $('.daterange-filter').daterangepicker({
                // singleDatePicker: true,
                showDropdowns: true,
                // ranges: {
                //     'Hôm nay': [moment(), moment()],
                //     'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                //     '7 ngày qua': [moment().subtract(6, 'days'), moment()],
                //     '30 ngày qua': [moment().subtract(29, 'days'), moment()],
                //     '60 ngày qua': [moment().subtract(59, 'days'), moment()],
                //     'Trong tháng này': [moment().startOf('month'), moment().endOf('month')],
                //     'Trong tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                // },
                // autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: "YYYY-MM-DD",
                }
            });

            $('#zones').select2({
                placeholder: "Chọn vùng",
                multiple: true,
                allowClear: true,
            });

            // $('#type').select2({
            //     placeholder: "Chọn loại báo cáo",
            //     multiple: true,
            //     allowClear: true,
            // });

            $('#zones').on('change', function (e) {
                var data = $('#zones').select2("val");
                let closeButton = $('.select2-selection__clear')[0];
                if(typeof(closeButton)!='undefined'){
                    if(data.length<=0)
                    {
                        $('.select2-selection__clear')[0].children[0].innerHTML = '';
                    } else{
                        $('.select2-selection__clear')[0].children[0].innerHTML = 'x';
                    }
                }
                @this.set('selectedZones', data);
            });

            $('#type').on('change', function(e){
                @this.set('selectedType', $("#type").val());
            });
            // $('#type').on('change', function (e) {
            //     var data = $('#type').select2("val");
            //     let closeButton = $('.select2-selection__clear')[0];
            //     if(typeof(closeButton)!='undefined'){
            //         if(data.length<=0)
            //         {
            //             $('.select2-selection__clear')[0].children[0].innerHTML = '';
            //         } else{
            //             $('.select2-selection__clear')[0].children[0].innerHTML = 'x';
            //         }
            //     }
            //     @this.set('selectedType', data);
            // });
        });

        // Chart part
        const footer = (tooltipItems) => {
            let sum = 0;

            tooltipItems.forEach(function(tooltipItem) {
                sum += tooltipItem.parsed.y;
            });
            return 'Sum: ' + Number((sum).toFixed(1)).toLocaleString();
        };
        const chart = new Chart(
            document.getElementById('chart'), {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: @json($dataset)
                },
                options: {
                    plugins: {
                        display: true,
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            mode: 'point',
                            position: 'nearest',
                            callbacks: {
                                footer: footer,
                            }
                        }
                    },
                    scales: {
                        x: {
                            display: true,
                            ticks: {
                                autoSkip: false,
                            },
                            // stacked: true

                        },
                        y: {
                            display: true,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Value',
                                color: '#000',
                            },
                            ticks: {
                                autoSkip: false,
                                min: 0
                            },
                        }
                    },
                    legend: {
                        display: false
                    },
                    plugins: {
                        datalabels: {
                            formatter: function(value, context) {
                                return value.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                            }
                        }
                    }
                }
            }
        );

        Livewire.on('updateChart', data => {
            let nameElement = document.getElementById('name123');
            chart.data = data;
            nameElement.textContent = 'Báo cáo ngày ' + data.report_date;

            // let dau_total = document.getElementById('dau-total');
            // let wau_total = document.getElementById('wau-total');
            // let mau_total = document.getElementById('mau-total');
            // dau_total.textContent = Number((data.total.DAU).toFixed(1)).toLocaleString();
            // wau_total.textContent = Number((data.total.WAU).toFixed(1)).toLocaleString();
            // mau_total.textContent = Number((data.total.MAU).toFixed(1)).toLocaleString();

            chart.update();
        });

        function search() {
            var data = $('#zones').select2("val");
            var type = $('#type').val();
            Livewire.emit('date-selected', $('#daterange').val(), data, type);
            var table = $('#dau-report').DataTable();
            table.on('preXhr.dt', function (e, settings, data) {
                data.daterange = $('#daterange').val();
                data.selectedZones = $('#zones').select2("val");
                data.selectedType = $('#type').val();
            });
            table.ajax.reload();
        }

        // $('.daterange-filter').on('apply.daterangepicker', function(ev, picker) {
        //     Livewire.emit('date-selected', $('#daterange').val(), @this.get('zones'));
        // });
        // End chart part
    </script>
@endpush
<div class="row" style="margin-bottom: 20px;">
    <div class="col-sm-3"><h3>Tổng quan</h3></div>
    <div class="col-sm-3"><h2>DAU <span id="dau-total" style="background-color: #28A745; color: white; font-size: 17px" class="badge badge-secondary">{{ number_format($total['DAU']) }}</span></h2></div>
    <div class="col-sm-3"><h2>WAU <span id="wau-total" style="background-color: #007BFF; color: white; font-size: 17px" class="badge badge-secondary">{{ number_format($total['WAU']) }}</span></h2></div>
    <div class="col-sm-3"><h2>MAU <span id="mau-total" style="background-color: #17A2B8; color: white; font-size: 17px" class="badge badge-secondary">{{ number_format($total['MAU']) }}</span></h2></div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="daterange" class="control-label">Lọc ngày</label>
            <div class="input-group date">
                <input wire:model="selectedDate" id="daterange"
                       class="form-control daterange-filter" type="text" name="daterange"
                       placeholder="Nhập ngày hiển thị" autocomplete="off" value="{{ now() }}"/>
                <div class="input-group-addon">
                    <i class="fa-regular fa-calendar calendar-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="zones" class="control-label">Vùng</label>
            <select id="zones" class="form-control" name="selectedZones[]" multiple>
                {{-- <option value="line" data-subtext="Biểu đồ đường" >Line</option>
                <option value="bar" data-subtext="Biểu đồ cột">Bar</option> --}}
                @foreach ($zones as $zone)
                <option value="{{ $zone }}" {{ (in_array($zone, ['Quest', 'Ftel'])) ? 'selected="selected"' : '' }}>{{ $zone }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="type" class="control-label">Loại</label>
            <select id="type" class="form-control" name="selectedType">
                {{-- <option value="line" data-subtext="Biểu đồ đường" >Line</option>
                <option value="bar" data-subtext="Biểu đồ cột">Bar</option> --}}
                <option value="DAU">DAU</option>
                <option value="WAU">WAU</option>
                <option value="MAU">MAU</option>
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="submit" class="control-label"></label>
            <div class="input-group date">
                <button class="tw-mt-1 btn btn-info" onClick="search()">Tìm kiếm</button>
            </div>
            
        </div>
    </div>
</div>

<!--start::Chart-->
<div class="row">
    <div class="col-md-12">
        <header>
            <h3><span id="name123">Báo cáo ngày {{ date('Y-m-d', strtotime('today')) }}</span></h3>
        </header>
        <canvas id="chart" height="50"></canvas>
        <div id="legend-container"></div>
    </div>
</div>
<!--end::Chart-->
