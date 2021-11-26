@extends('layouts.default')

@section('content')
@php
    $uri_config = $Settings->firstWhere('name','uri_config');
    $list_uri = [];
    if(!empty($uri_config)){
        $list_uri = json_decode($uri_config->value);
    }
@endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ ($setting->id) ? 'EDIT' : 'ADD NEW' }} SETTING</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Setting v1</li>
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
                        <form id="setting-id" action="/settings{{(!$setting->id) ? '/store' : '/update'}}{{ (!$setting->id) ? '' : '/' . $setting->id }}" method="POST" novalidate="novalidate" autocomplete="off" onsubmit="handleSubmit(event,this)">
                            @csrf
            
                            @if (isset($setting->id) && $setting->id)
                                @method('PUT')
                            @endif
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Setting Info</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="module_name">Unique name</label>
                                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Unique name" value="{{ $setting->name }}" {{ (!empty($setting->id)) ? 'readonly' : '' }} >
                                            @error('name')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="value">Value</label>
                                            <input type="hidden" name="value" id="hidden-value" value="{{ $setting->value }}" />
                                            <select id="value" class="form-control selectpicker" data-live-search="true" data-size="10" multiple>
                                                @foreach (json_decode($setting->value) as $one_value)
                                                    <option value="{{ json_encode($one_value) }}" selected>{{ json_encode($one_value) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" style="text-align: center">
                                    <a href="/settings" type="button" class="btn btn-default">Cancel</a>
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
    <style>
        select {
            font-family: 'Lato', 'Font Awesome 5 Free', 'Font Awesome 5 Brands';
        }
    </style>
@endsection