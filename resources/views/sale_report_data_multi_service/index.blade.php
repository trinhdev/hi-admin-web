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
                    <form id="filter-form" class="row form-inline" action="{{ route('salereportdatamultiservice.index') }}" method="GET">
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
                            <label class="control-label col-md-6" >SDT khách hàng:</label>
                            <div class="col-md-6">
                                <input type="text" name="customer_phone" class="form-control" id="customer_phone" value="{{ $filter['customer_phone'] }}" placeholder="Nhập số điện thoại khách hàng cần tìm" />
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Trạng thái đơn hàng:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="order_state[]" id="order_state" multiple="multiple">
                                    @foreach ($order_states as $order_state)
                                        @if(in_array($order_state, $filter['order_state_selected']))
                                            <option value="{{ $order_state }}" selected>{{ $order_state }}</option>
                                        @else
                                            <option value="{{ $order_state }}">{{ $order_state }}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Phương thức thanh toán:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="payment_method[]" multiple="multiple">
                                    @foreach ($payment_methods as $payment_method)
                                        @if(in_array($payment_method, $filter['payment_method_selected']))
                                            <option value="{{ $payment_method }}" selected>{{ $payment_method }}</option>
                                        @else
                                            <option value="{{ $payment_method }}">{{ $payment_method }}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>  
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Trạng thái thanh toán:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="payment_status[]" multiple="multiple">
                                    @foreach ($payment_statuses as $payment_state)
                                        @if(in_array($payment_state, $filter['payment_status_selected']))
                                            <option value="{{ $payment_state }}" selected>{{ $payment_state }}</option>
                                        @else
                                            <option value="{{ $payment_state }}">{{ $payment_state }}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Vùng:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="zone[]" multiple="multiple" id="zone">
                                    @foreach ($zones as $zone)
                                        @if(in_array($zone['location_zone'], $filter['zone_selected']))
                                            <option value="{{ $zone['location_zone'] }}" selected rel="{{ str_replace(' ', '', $zone['location_zone']) }}">{{ $zone['location_zone']}}</option>
                                        @else
                                            <option value="{{ $zone['location_zone'] }}" rel="{{ str_replace(' ', '', $zone['location_zone']) }}">{{ $zone['location_zone']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Chi nhánh:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="branch_code[]" multiple="multiple" data-size="10" id="branch_code">
                                    @foreach ($branch_codes as $branch_code)
                                        @if(in_array($branch_code['location_code'], $filter['branch_code_selected']))
                                            <option value="{{ $branch_code['location_code'] }}" data-locationId="{{ $branch_code['customer_location_id'] }}" rel="{{ str_replace(' ', '', $branch_code['location_zone']) }}" selected>{{ $branch_code['location_name_vi']}}</option>
                                        @else
                                            <option value="{{ $branch_code['location_code'] }}" data-locationId="{{ $branch_code['customer_location_id'] }}" rel="{{ str_replace(' ', '', $branch_code['location_zone']) }}">{{ $branch_code['location_name_vi']}}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Chi nhánh chi tiết:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="ftel_branch[]" multiple="multiple" data-size="10" id="ftel_branch">
                                    @foreach ($ftel_branchs as $ftel_branch)
                                        @if(in_array($ftel_branch['branch_name'], $filter['ftel_branch_selected']))
                                            <option value="{{ $ftel_branch['branch_name'] }}" rel="{{ $ftel_branch['location_id'] }}" selected>{{ $ftel_branch['branch_name'] }}</option>
                                        @else
                                            <option value="{{ $ftel_branch['branch_name'] }}" rel="{{ $ftel_branch['location_id'] }}">{{ $ftel_branch['branch_name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Loại dịch vụ:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="service_type[]" multiple="multiple" data-size="10" id="service_type">
                                    @foreach ($service_types as $service_type)
                                        @if(in_array($service_type['key'], $filter['service_type_selected']))
                                            <option value="{{ $service_type['key'] }}" selected>{{ $service_type['value']}}</option>
                                        @else
                                            <option value="{{ $service_type['key'] }}">{{ $service_type['value']}}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="control-label col-md-6" >Query and service type:</label>
                            <div class="col-md-6">
                                <input class="form-check-input" type="checkbox" id="is-and-service-type" name="isAndServiceType" {{ !empty($filter['isAndServiceType']) ? 'checked' : '' }}>
                                {{-- <label class="form-check-label">Option 1</label>   --}}
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align: center">
                            <input type="submit" class="btn btn-sm btn-primary" name="submitbutton" value="Search" />
                            <input type="submit" class="btn btn-sm btn-success" name="submitbutton" value="Phone export" />
                            <input type="submit" class="btn btn-sm btn-warning" name="submitbutton" value="All export" />
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
    <script src="{{ asset('/custom_js/salereportdatamultiservice.js')}}" type="text/javascript" charset="utf-8"></script>
    {{ $dataTable->scripts() }}
    {{-- <script>
        const table = $('#helper');
        table.on('preXhr.dt', function(e, settings, data){
            data.bannerType = $('#show_at').val();
            data.public_date_start = $('#show_from').val();
            data.public_date_end = $('#show_to').val();
        });
    </script> --}}
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
</style>