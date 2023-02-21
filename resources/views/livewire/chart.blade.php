
<!--start::Chart-->
<div class="row">
    <div class="col-md-12">
        <header>
            <h2>DAU <small>Analytics</small></h2>
        </header>

        <div wire:ignore wire:key={{ $chart->id }}>
            @if($chart)
                {!! $chart->container() !!}
            @endif
        </div>
    </div>
</div>
<!--end::Chart-->

@if($chart)
    @push('script')
        <script>
            window.livewire.on('chartUpdate', (chartId, labels, datasets) => {
                let chart = window[chartId].chart;

                chart.data.datasets.forEach((dataset, key) => {
                    dataset.data = datasets[key];
                });

                chart.data.labels = labels;

                chart.update();
            });
        </script>
        {!! $chart->script() !!}
    @endpush
@endif

