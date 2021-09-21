
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.user_create')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="username"> User name</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter user name">
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Group</label>
        <select class="form-control" id="exampleFormControlSelect1" name="group_id">
        <option>1</option>
        <option>2</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

