@extends('layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<?php
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý report</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-body col-sm-12">
                <div>
                    <form id="filter-form" class="row form-inline" action="{{ route('laptopordersbyproduct.index') }}" method="GET">
                        {{-- @csrf --}}
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Từ ngày:</label>
                            <div class="col-md-6">
                                <input type="date" name="show_from" class="form-control" id="show_from" value="{{ $filter['show_from'] }}" placeholder="Date From" />
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Đến ngày:</label>
                            <div class="col-md-6">
                                <input type="date" name="show_to" class="form-control" id="show_to" placeholder="Date To" value="{{ $filter['show_to'] }}" />
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Ngành hàng:</label>
                            <div class="col-md-6">
                                <select class="js-example-basic-multiple js-states form-control" name="merchant_id[]" id="order_state" multiple="multiple" data-size="10" id="merchant">
                                    @foreach ($merchants as $merchant)
                                        @if(in_array($merchant['key'], $filter['merchants_id_filter']))
                                            <option value="{{ $merchant['key'] }}" selected>{{ $merchant['value'] }}</option>
                                        @else
                                            <option value="{{ $merchant['key'] }}">{{ $merchant['value'] }}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Nhà cung cấp:</label>
                            <div class="col-md-6">
                                <select class="js-example-basic-multiple js-states form-control" name="agent_id[]" multiple="multiple" style="width: 100%">
                                    @foreach ($agents as $agent)
                                        @if(in_array($agent['agent_id'], $filter['agent_id_filter']))
                                            <option value="{{ $agent['agent_id'] }}" selected>{{ $agent['agent_name'] }}</option>
                                        @else
                                            <option value="{{ $agent['agent_id']  }}">{{ $agent['agent_name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="control-label col-md-6" >Sản phẩm:</label>
                            <div class="col-md-6">
                                <select name="product_id[]" multiple="multiple" data-size="10" id="product" class="js-example-basic-multiple js-states form-control">
                                    @foreach ($products as $product)
                                        @if(in_array($product['product_id'], $filter['product_id_filter']))
                                            <option value="{{ $product['product_id'] }}" selected>{{ $product['sku'] }} - {{ $product['product_name'] }}</option>
                                        @else
                                            <option value="{{ $product['product_id']  }}">{{ $product['sku'] }}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align: center">
                            <input type="submit" id="search" class="btn btn-sm btn-primary" name="submitbutton" value="Search" />
                        </div>
                    </form>
                </div>

                {{ $dataTable->table([], true) }}

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
<!--end::Table-->
@push('scripts')
    <!-- <script src="{{ asset('/custom_js/salereportdatamultiservice.js')}}" type="text/javascript" charset="utf-8"></script> -->
    {{ $dataTable->scripts() }}
    <script>
        // const table = $('#report-data');
        // table.on('preXhr.dt', function(e, settings, data){
        //     data.bannerType = $('#show_at').val();
        //     data.public_date_start = $('#show_from').val();
        //     data.public_date_end = $('#show_to').val();
        // });
        // $(document).ready(function() {
        //     $('#product').select2();
        // });
        $('.js-example-basic-multiple').select2({
            placeholder: 'Nothing selected',
            allowClear: false,
            minimumResultsForSearch: 5
        });

        // $('#merchant').select2({
        //     placeholder: 'Nothing selected',
        //     allowClear: false,
        //     minimumResultsForSearch: 5
        // });
    </script>
@endpush

<style>
    .form-control {
        width: 100%!important
    }

    .form-group {
        margin-bottom: 20px!important
    }

    .form-inline .bootstrap-select, .form-inline .bootstrap-select.form-control:not([class*="col-"]) {
        width: 100%!important
    }

    ul .dropdown-menu {
        margin-top: 0!important;
        margin-bottom: 0!important
    }

    

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black!important
    }

</style>