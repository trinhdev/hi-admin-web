@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ ($groupmodule->id) ? 'EDIT' : 'ADD NEW' }} GROUP MODULE</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Modules v1</li>
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
                    <div class="col-sm-6">
                        <form action="/groupmodule{{(!$groupmodule->id) ? '/store' : '/update'}}{{ (!$groupmodule->id) ? '' : '/' . $groupmodule->id }}" method="POST" novalidate="novalidate" autocomplete="off">
                            @csrf
            
                            @if (isset($groupmodule->id) && $groupmodule->id)
                                @method('PUT')
                            @endif
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Group module Info</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="group_module_name">Group module name</label>
                                            <input type="text" id="group_module_name" name="group_module_name" class="form-control @error('group_module_name') is-invalid @enderror" placeholder="Group module name" value="{{ $groupmodule->group_module_name }}" >
                                            @error('group_module_name')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" style="text-align: center">
                                    <a href="/groupmodule" type="button" class="btn btn-default">Cancel</a>
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

@push('scripts')
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    </script>
@endpush