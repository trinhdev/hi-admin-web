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
            chart.data = data;
            chart.update();
        });
    </script>
@endpush
<!--start::Chart-->
<div class="row">
    <div class="col-md-12">
        <header>
            <h2>DAU <small>Analytics</small></h2>
        </header>
        <canvas id="chart" width="800" height="200"></canvas>
    </div>
</div>
<!--end::Chart-->
