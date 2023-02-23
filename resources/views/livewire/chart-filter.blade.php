@once
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush
@endonce

@push('script')
    <script>
        const chart = new Chart(
            document.getElementById('chart'), {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: @json($dataset)
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true
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
            chart.update();
        });
    </script>
@endpush

<!--start::Chart-->
<div class="row">
    <div class="col-md-12">
        <header>
            <h2><span id="name123">DAU</span> <small>Analytics</small></h2>
        </header>
        <canvas id="chart" width="800" height="250"></canvas>
    </div>
</div>
<!--end::Chart-->
