@extends('app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <div class="card mb-5 mb-xxl-10">
            <div class="card-header">
                <!--begin::Title-->
                <div class="card-title">
                    <h3>Create User</h3>
                </div>
                <!--end::Title-->

            </div>

            <div class="card-body py-10">
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
            </div>
        </div>
    </div>
</div>
@endsection('content')
