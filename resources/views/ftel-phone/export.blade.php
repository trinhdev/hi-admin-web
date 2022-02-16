<!-- Main content -->
<section class="content">
            <div class="container-fluid">
                        @if(isset($data))
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
                    @if(isset($data))
                    <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value['number_phone'] }}</td>
                        <td>{{ $value['code'] }}</td>
                        <td>{{ $value['emailAddress'] }}</td>
                        <td>{{ $value['fullName'] }}</td>    
                        <td>{{ $value['organizationCodePath'] }}</td>                        
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- /.content -->
        