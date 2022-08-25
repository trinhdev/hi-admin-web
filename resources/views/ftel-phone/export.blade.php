<!-- Main content -->
<style>
    .Edit {
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="card card-body col-sm-12 mt-2">
            <table id="phoneExport" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã nhân viên</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Tên đầy đủ</th>
                    <th>Đơn vị đầy đủ</th>
                    <th>Đơn vị</th>
                    <th>Đơn vị(theo data)</th>
                    <th>Phòng ban</th>
                    <th>Location ID</th>
                    <th>Code</th>
                    <th>Branch Code</th>
                    <th>Branch Name</th>
                    <th>Đơn vị(làm việc)</th>
                    <th>Đang hoạt động</th>
                    <th>Cập nhật</th>
                    <th>dept_id</th>
                    <th>dept_name_1</th>
                    <th>dept_name_2</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Cập nhật từ</th>
{{--                    <th>Nhân viên FPT</th>--}}
                    <th>Action</th>
                </tr>
                </thead>
                @if(isset($data))
                    <tbody>
                    @foreach($data as $value)
                        @php
                            $codePath = explode('/', $value['organizationCodePath'] ?? null);
                            $key = 0;
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value['code'] ?? null }}</td>
                            <td>{{ $value['name'] ?? null }}</td>
                            <td>{{ $value['phoneNumber'] ?? null }}</td>
                            <td>{{ $value['emailAddress'] ?? null }}</td>
                            <td>{{ $value['fullName'] ?? null }}</td>
                            <td>{{ $value['organizationCodePath'] ?? null }}</td>
                            <td>{{ $codePath[0] ?? null }}</td>
                            <td>{{ $codePath[1] ?? null }}</td>
                            <td>{{ $codePath[count($codePath)-2] ?? null }}</td>
                            <td>{{ $value['location_id'] ?? null }}</td>
                            <td>{{ $value['branch_code'] ?? null }}</td>
                            <td>{{ $value['branch_name'] ?? null }}</td>
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
                            {{--<td>
                                @if(!empty($value['check']))
                                    @if($value['check']==='TRUE')
                                        <div class="text-success text-bold">TRUE</div>
                                    @elseif($value['check']==='FALSE')
                                        <div class="text-danger text-bold">FALSE</div>
                                    @else
                                        <i>null</i>
                                    @endif
                                @else
                                    null
                                @endif
                            </td>--}}
                            @if(isset($value['id']) && Auth::user()->role_id == ADMIN || Auth::user()->role_id == DOISOAT)
                                <td>
                                    <a href="{{ route('ftel_phone.edit', [$value['id']]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            @else
                                <td><button class=" btn btn-sm btn-primary" onclick="alert('Chức năng không hỗ trợ! Vui lòng lấy thông tin từ Database')">Edit</button></td>
                            @endif
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->
