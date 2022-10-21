<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-body col-sm-12 mt-2">
            <table id="behaviorExport" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>Thời gian/Lượt tương tác</th>
                    <th>0</th>
                    <th>=<2</th>
                    <th>2-4</th>
                    <th>>=5</th>
                </tr>
                </thead>
                @if(isset($data))
                    <tbody>
                    @foreach($data as $key => $value)
                        <tr>
                            <td>{{ $value['name'] }}</td>
                            <td>{{ $value['0_'] ?? null }}</td>
                            <td>{{ $value['1_2'] ?? null }}</td>
                            <td>{{ $value['3_4'] ?? null }}</td>
                            <td>{{ $value['5_'] ?? null }}</td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->
