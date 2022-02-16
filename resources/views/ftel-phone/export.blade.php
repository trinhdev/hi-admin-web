<!-- Main content -->
<section class="content">
            <div class="container-fluid">
                        @if($data!=null && Auth::user()->role_id == ADMIN)
                        <form action="{{ route('ftel_phone.export') }}" type="POST" novalidate="novalidate" autocomplete="off">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="data" value="{{ json_encode($data,TRUE)}}" />
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </form>
                        @endif
                <div class="card card-body col-sm-12 mt-2">
                    <table id="phoneExport" class="display nowrap" style="width:100%">

                    @if($data!=null)
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phone</th>
                            <th>Mã số nhân viên</th>
                            <th>Email</th>
                            <th>Tên đầy đủ</th>
                            <th>Đơn vị</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($data as $data)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $data['number_phone'] }}</td>
                        <td>{{ $data['code'] }}</td>
                        <td>{{ $data['emailAddress'] }}</td>
                        <td>{{ $data['fullName'] }}</td>    
                        <td>{{ $data['organizationCodePath'] }}</td>                        
                    </tr>
                    @endforeach
                    @else
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phone</th>
                            <th>Mã số nhân viên</th>
                            <th>Email</th>
                            <th>Tên đầy đủ</th>
                            <th>Đơn vị</th>
                        </tr>
                    </thead>
                    @endif
                    </tbody>
                    </table>
                    
                </div>
            </div>
        </section>
        <!-- /.content -->
        