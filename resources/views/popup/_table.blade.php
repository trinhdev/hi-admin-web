<!--begin::Table-->
{{ $dataTable->table([], true) }}
<!--end::Table-->
@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        const table = $('#popup_manage_table');
        table.on('preXhr.dt', function(e, settings, data){
            data.templateType = $('#show_at').val();
        });
    </script>
@endpush
