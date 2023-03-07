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
    @if(!empty($data))
        <tbody>
        @forelse($data as $value)
            {{--<tr>
                <td>{!! $value[0] !!}</td>
                <td>{{ $value[1] ?? null }}</td>
                <td>{{ $value[2] ?? null }}</td>
                <td>{{ $value[3] ?? null }}</td>
                <td>{{ $value[4] ?? null }}</td>
            </tr>--}}
            <tr>
                <td>{!! $value['name'] !!}</td>
                <td>{{ $value['0_'] ?? null }}</td>
                <td>{{ $value['1_2'] ?? null }}</td>
                <td>{{ $value['3_4'] ?? null }}</td>
                <td>{{ $value['5_'] ?? null }}</td>
            </tr>
            {{--<tr>
                <td>{!! 'hehe' !!}</td>
                <td>{{ $value[0] ?? null }}</td>
                <td>{{ $value[1] ?? null }}</td>
                <td>{{ $value[2] ?? null }}</td>
                <td>{{ $value[3] ?? null }}</td>
            </tr>--}}
        @empty
            <tr>No data</tr>
        @endforelse
        @endif
        </tbody>
</table>
