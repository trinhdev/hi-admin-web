@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<p>Tên: {{ $user->name ?? $user->name}}</p>
<p>User Name: {{ $user->username ?? $user->username}} </p>
<p>Email: {{ $user->email ?? $user->email}} </p>
<p>Ngày tham gia: {{ $user->created_at ?? date('d-m-Y H:i',strtotime($user->created_at))}}</p>
<p>Nhóm: {{ ($user->group_id == 1) ? "User" : "Admin" }}</p>

