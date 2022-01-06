@extends('layouts.default')

@section('content')
@php

@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ (!empty($user)) ? 'EDIT' : 'ADD NEW' }} USER</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-sm-12">
                    @php
                        $action = (empty($user)) ? route('user.store') : route('user.update',$user->id);
                    @endphp
                    <form action="{{$action}}" method="POST" onSubmit="handleSubmit(event,this)">
                        @csrf
                        @if(!empty($user))
                        @method('PUT')
                        @endif
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title uppercase">User Info</h3>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">User name</label>
                                        <input type="text" id="name" name="name"class="form-control" value="{{ !empty($user)?$user->name:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="User Email" value="{{ !empty($user)?$user->email:''}}" {{!empty($user)?'disabled':''}}>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select id="role_id" name="role_id" class="form-control" placeholder="User Email">
                                            <option value selected>None</option>
                                            @foreach($roleList as $role)
                                            <option value="{{$role->id}}" {{(!empty($user) && $user->role_id == $role->id) ? 'selected':''}}>{{$role->role_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(empty($user))
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="User Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="User Password">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: center">
                                <a href="{{ route('user.index') }}" type="button" class="btn btn-default">Cancel</a>
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
