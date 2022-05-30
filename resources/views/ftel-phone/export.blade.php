<!-- Main content -->
<section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12 mt-2">
                    <table id="phoneExport" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã số nhân viên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Tên đầy đủ</th>
                            <th>Đơn vị đầy đủ</th>
                            <th>Đơn vị</th>
                            <th>Đơn vị(theo data)</th>
                            <th>Đơn vị/Phòng ban</th>
                            <th>Nhân viên FPT</th>
                        </tr>
                    </thead>
                    @if(isset($data))
                    <tbody>
                    @foreach($data as $key => $value)
                    @php 
                        $codePath = explode('/', $value['organizationCodePath'] ?? null);
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value['code'] ?? null }}</td>
                        <td>{{ $value['phoneNumber'] ?? null }}</td>
                        <td>{{ $value['emailAddress'] ?? null }}</td>
                        <td>{{ $value['fullName'] ?? null }}</td>    
                        <td>{{ $value['organizationCodePath'] ?? null }}</td>
                        <td>{{ $codePath[0] ?? null }}</td>
                        <td>{{ $codePath[1] ?? null }}</td>
                        <td>{{ $codePath[2] ?? null }}</td>
                        <td>{{ $value['check'] ?? $value['check'] = null }}</td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- /.content -->
        