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
                    <h1 class="m-0">{{ (!empty($user)) ? 'EDIT' : 'ADD NEW' }} BANNER</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('bannermanage.index')}}">Banner</a></li>
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
                    $action = (empty($banner)) ? route('bannermanage.store') : route('bannermanage.update',$banner->id);
                    @endphp
                    <form action="{{$action}}" method="POST" onSubmit="handleSubmit(event,this)">
                        @csrf
                        @if(!empty($banner))
                        @method('PUT')
                        @endif
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Banner Info</h3>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">title</label>
                                        <input type="text" name="title" class="form-control" value="{{ !empty($banner)?$banner->name:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="show_at">Show At</label>
                                        <select type="text" name="show_at" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="show_at">File</label>
                                        <input type="file" name="path_1" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="path_2" class="form-control" />
                                    </div>
                                    <div class="form-inline">
                                        <label for="show_at">Show From: </label>
                                        <input type="date" name="show_from" class="form-control" />
                                        <label for="show_to">  Show To: </label>
                                        <input type="date" name="show_to" class="form-control" />
                                    </div>
                                    <div class="form-group" id="show_target_route">
                                        <div class="icheck-carrot">
                                                <input type="checkbox" id="type_phone" name="platform" value="phone" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"/>
                                                <label for="type_phone">Has Target Route</label>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#show_target_route">
                                            <select type="file" name="target_route" class="form-control">
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: center">
                                <a href="{{ route('bannermanage.index') }}" type="button" class="btn btn-default">Cancel</a>
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
