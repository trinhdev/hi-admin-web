<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-body col-sm-12 mt-2">
            <table id="GetPhoneNumberExport" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>CUSTOMER ID</th>
                        <th>PHONE NUMBER</th>
                    </tr>
                </thead>
                @if(!empty($data))
                <tbody>
                    @forelse($data as $value)
                    <tr>
                        <td>{!! $value['stt'] !!}</td>
                        <td>{{ $value['customer_id'] ?? null }}</td>
                        <td>{{ $value['phone_number'] ?? null }}</td>
                    </tr>
                    @empty
                    <tr>No data</tr>
                    @endforelse
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->
