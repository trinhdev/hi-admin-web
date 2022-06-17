<!-- Main content -->
<section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12 mt-2">
                    <table id="phoneExport" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã nhân viên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Tên đầy đủ</th>
                            <th>Đơn vị đầy đủ</th>
                            <th>Đơn vị</th>
                            <th>Đơn vị(theo data)</th>
                            <th>ID vị trí</th>
                            <th>Mã chi nhánh</th>
                            <th>Mã vùng</th>
                            <th>Đơn vị(làm việc)</th>
                            <th>Đang hoạt động</th>
                            <th>Cập nhật</th>
                            <th>dept_id</th>
                            <th>dept_name_1</th>
                            <th>dept_name_2</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Cập nhật từ</th>
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
                        <td>{{ $value['location_id'] ?? null }}</td>
                        <td>{{ $value['branch_code'] ?? null }}</td>
                        <td>{{ $value['area_code'] ?? null }}</td>
                        <td>{{ $value['organizationCode'] ?? null }}</td>
                        <td>{{ $value['isActive'] ?? null }}</td>
                        <td>{{ $value['checkUpdate'] ?? null }}</td>
                        <td>{{ $value['dept_id'] ?? null }}</td>
                        <td>{{ $value['dept_name_1'] ?? null }}</td>
                        <td>{{ $value['dept_name_2'] ?? null }}</td>
                        <td>{{ $value['created_at'] ?? null }}</td>
                        <td>{{ $value['updated_at'] ?? null }}</td>
                        <td>{{ $value['updated_from'] ?? null }}</td>
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
