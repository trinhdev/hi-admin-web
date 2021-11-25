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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                        <form action="/hidepayment/hide" method="POST" autocomplete="off" onsubmit="handleSubmit(event,this)">
                            @csrf

                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Hide payment by version</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="phone">Version</label>
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
                                        <div class="form-check form-check-inline" style="width: 50%">
                                            <input class="form-check-input" name="isUpStoreAndroid" type="checkbox" value="1" id="isUpStoreAndroid">
                                            <label class="form-check-label" for="isUpStoreAndroid">
                                                Is Hide Payment Up Store Android
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="isUpStoreIos" type="checkbox" value="1" id="isUpStoreIos">
                                            <label class="form-check-label" for="isUpStoreIos">
                                                Is Hide Payment Up Store Ios
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer" style="text-align: center">
                                    <button type="submit" class="btn btn-info">Hide payment</button>
                                </div>
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