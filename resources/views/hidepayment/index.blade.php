@extends('layouts.default')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Hide payment</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Hide payment v1</li>
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
                        <form action="{{ route('hidepayment.hide')}}" method="POST" autocomplete="off" onsubmit="handleSubmit(event,this)">
                            @csrf

                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Hide payment by version</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="version">Version</label>
                                            <select name="version" id="version" class="form-control selectpicker @error('version') is-invalid @enderror" data-live-search="true" data-size="10">
                                                <option value="">Please choose version</option>
                                                @foreach ($hidepayment->versions as $version)
                                                    <option value="{{ $version }}">{{ $version }}</option>
                                                @endforeach
                                            </select>
                                            @error('version')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="platform">Platform</label>
                                            <div class="form-check">
                                                <label class="form-check-label" for="isUpStoreAndroid">
                                                    <input type="radio" class="form-check-input" id="platform" name="platform" value="isUpStoreAndroid" checked>Android
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label" for="isUpStoreIos">
                                                    <input type="radio" class="form-check-input" id="platform" name="platform" value="isUpStoreIos">IOS
                                                </label>
                                            </div>
                                            @error('platform')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="action">Action</label>
                                            <select name="action" id="action" class="form-control selectpicker @error('action') is-invalid @enderror" data-live-search="true" data-size="10">
                                                <option value="">Please choose action</option>
                                                <option value="1">Hide</option>
                                                <option value="0">Show</option>
                                            </select>
                                            @error('version')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                @can('hide-payment')
                                    <div class="card-footer" style="text-align: center">
                                        <button type="submit" class="btn btn-info">Action</button>
                                    </div>
                                @endcan
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px">
                    <div class="col-sm-12">
                        <table id="hide-payment" class="display nowrap" style="width:100%">
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <style>
        select {
            font-family: 'Lato', 'Font Awesome 5 Free', 'Font Awesome 5 Brands';
        }
    </style>
@endsection