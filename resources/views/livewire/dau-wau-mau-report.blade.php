@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $('#daterange').on('change', function(e){
            @this.set('selectedDate', e.target.value)
        });

        $(document).ready(function() {
            $('.daterange-filter').daterangepicker({
                singleDatePicker: true,
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
                    }
                }
            }
        );

        Livewire.on('updateChart', data => {
            console.log(data);
            let nameElement = document.getElementById('name123');
            chart.data = data;
            console.log($('#daterange').val());
            nameElement.textContent = 'Báo cáo ngày ' + data.report_date;

            chart.update();
        });

        $('.daterange-filter').on('apply.daterangepicker', function(ev, picker) {
            Livewire.emit('date-selected', $('#daterange').val())
        });
        // End chart part
    </script>
@endpush
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
</div>

<!--start::Chart-->
<div class="row">
    <div class="col-md-12">
        <header>
            <h3><span id="name123">Báo cáo ngày {{ date('Y-m-d', strtotime('today')) }}</span></h3>
        </header>
        <canvas id="chart" height="50"></canvas>
    </div>
</div>
<!--end::Chart-->
