<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-body col-sm-12 mt-2">
            <table id="GetPhoneNumberExport" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Customer ID</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                @if(!empty($data))
                <tbody>
                    @forelse($data as $key => $value)
                    <tr>
                        <td>{!! $key !!}</td>
                        <td>{{ $value->customer_id ?? null }}</td>
                        <td>{{ $value->phone ?? null }}</td>
                    </tr>
                    @empty

                    @endforelse
                @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->
