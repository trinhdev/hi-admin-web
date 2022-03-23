<!-- Main content -->
<section class="content">
            <div class="container-fluid">
                <div class="card card-body col-sm-12 mt-2">
                    <table id="phoneExport" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Số điện thoại nhân viên</th>
                            <th>Mã số nhân viên</th>
                            <th>Email</th>
                            <th>Tên đầy đủ</th>
                            <th>Đơn vị đầy đủ</th>
                            <th>Đơn vị công ty</th>
                            <th>Đơn vị phòng ban</th>
                        </tr>
                    </thead>
                    @if(isset($data))
                    <tbody>
                    @foreach($data as $key => $value)
                    @php 
                        $codePath = explode('/', $value['organizationCodePath']);
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value['code'] }}</td>
                        <td>{{ $value['phoneNumber'] }}</td>
                        <td>{{ $value['emailAddress'] }}</td>
                        <td>{{ $value['fullName'] }}</td>    
                        <td>{{ $value['organizationCodePath'] }}</td>
                        <td>{{ $codePath[0] }}</td>
                        <td>{{ $codePath[2] }}</td>                                    
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- /.content -->
        