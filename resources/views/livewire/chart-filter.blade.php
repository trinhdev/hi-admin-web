@once
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush
@endonce

@push('script')
    <script>
        const footer = (tooltipItems) => {
            let sum = 0;

            tooltipItems.forEach(function(tooltipItem) {
                sum += tooltipItem.parsed.y;
            });
            return 'Sum: ' + Number((sum).toFixed(1)).toLocaleString();
        };
        const chart = new Chart(
            document.getElementById('chart'), {
                type: 'line',
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
                            stacked: true

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
            let nameElement = document.getElementById('name123');
            chart.data = data;
            nameElement.textContent = data.chart;
            console.log(data);
            chart.config.type = data.type;
            if(data.chart === 'DSD' || data.chart === 'MSD') {
                chart.options.plugins.tooltip.mode = 'point';
                chart.options.plugins.tooltip.mode = 'Millisecond';
            } else {
                chart.options.plugins.tooltip.mode = 'index';
                chart.options.plugins.tooltip.mode = 'Click';
            }
            chart.update();
        });
    </script>
@endpush

<!--start::Chart-->
<div class="row">
    <div class="col-md-12">
        <header>
            <h2><span id="name123">Không có dữ liệu</span> <small> Analytics</small></h2>
        </header>
        <canvas id="chart" height="110"></canvas>
    </div>
</div>
<!--end::Chart-->
