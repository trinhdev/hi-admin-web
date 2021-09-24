
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.user_update',['user' => $user->user_id]) }}" method="POST">
    @csrf
    <input name="_method" type="hidden" value="PUT">

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
    </div>
    
    <div class="form-group">
        <label for="exampleFormControlSelect1">Group</label>
        <select class="form-control" id="exampleFormControlSelect1" name="group_id">
        <option>1</option>
        <option>2</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

