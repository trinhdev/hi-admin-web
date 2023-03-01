@extends('layoutv2.layout.app')
@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="_buttons">
                        <div class="visible-xs">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            <livewire:dau-wau-mau-report/>
                            {{-- <livewire:chart-filter/> --}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel_s tw-mt-2 sm:tw-mt-4">
                        <div class="panel-body">
                            {!! $dataTable->table(['id' => 'dau-report']) !!}
                            <!--end::Table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
@endsection

@push('script')
    {!! $dataTable->scripts() !!}

    <script>
        let table = $('#dau-report');
        table.on('preXhr.dt', function (e, settings, data) {
            data.daterange = $('#daterange').val();
            data.location_zone = $('#zones').select2("val");
            console.log(data.location_zone);
        });
    </script>
@endpush
