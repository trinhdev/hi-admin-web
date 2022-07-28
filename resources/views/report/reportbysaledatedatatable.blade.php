<div class="col-sm-12">
    <div class="card col-sm-9">
        {{-- <h4 class="card-title">{{ $service }}</h4> --}}
        <h4 class="card-title">test</h4>
        <div class="card-body"></div>
    </div>

    {{ $dataTable->table([], true) }}

</div>

@push('scripts')
    {{-- <script src="{{ asset('/custom_js/supportsystem.js')}}" type="text/javascript" charset="utf-8"></script> --}}
    {{ $dataTable->scripts() }}
@endpush