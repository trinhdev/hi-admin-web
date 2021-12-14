@extends('layouts.default')

@section('content')
@if(env('APP_ENV') == 'staging' || env('APP_ENV') == 'local' )
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Check List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Check list</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <!--Accordion wrapper-->
                    <div class="accordion md-accordion accordion-blocks" id="accordionEx78" role="tablist" aria-multiselectable="true">

                        <!-- Accordion card -->
                        <div class="card card-info">

                            <!-- Card header -->
                            <div class="card-header" role="tab">
                                <!-- Heading -->
                                <a data-toggle="collapse" data-parent="#accordionEx78" href="#collapseUnfiled" aria-expanded="true" aria-controls="collapseUnfiled">
                                    <h5 class="mt-1 mb-0">
                                        <span>Send Staff</span>
                                        <i class="fas fa-angle-down rotate-icon"></i>
                                    </h5>
                                </a>
                            </div>
                            <!-- Card body -->
                            <div id="collapseUnfiled" class="collapse" role="tabpanel" data-parent="#accordionEx78">
                                <form action="{{ route('checklistmanage.sendStaff')}}" method="POST" onsubmit="handleSubmit(event,this)">
                                    @csrf
                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="contractNo" placeholder="Enter Contract Number...">
                                        </div>
                                    </div>
                                    <div class="card-footer" style="text-align: center">
                                        <button class="btn btn-info">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Accordion card -->

                        <!-- Accordion card -->
                        <div class="card card-info">

                            <!-- Card header -->
                            <div class="card-header" role="tab">
                                <!-- Heading -->
                                <a data-toggle="collapse" data-parent="#accordionEx78" href="#completeChecklist" aria-expanded="true" aria-controls="collapseUnfiled">
                                    <h5 class="mt-1 mb-0">
                                        <span>Complete</span>
                                        <i class="fas fa-angle-down rotate-icon"></i>
                                    </h5>
                                </a>

                            </div>

                            <!-- Card body -->
                            <div id="completeChecklist" class="collapse" role="tabpanel" data-parent="#accordionEx78">
                                <form action="{{route('checklistmanage.completeChecklist')}}" method="POST" onsubmit="handleSubmit(event,this)">
                                    @csrf
                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="checkListId" placeholder="Enter Id...">
                                        </div>
                                    </div>
                                    <div class="card-footer" style="text-align: center">
                                        <button class="btn btn-info">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Accordion card -->
                    </div>
                    <!--/.Accordion wrapper-->
                </div>
            </div>
            <h4 class="text-muted text-center">List Id</h4>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <ul class="list-group">
                    @php
                        $checklistLength = count($list_checklist_id);
                    @endphp
                        @foreach(array_reverse($list_checklist_id) as $key=>$checklist)
                        <li class="list-group-item d-flex justify-content-around align-items-center">
                        <div class="badge badge-primary">No. {{$checklistLength--}}</div>
                            {{'ID: '. $checklist->ID.' - Hợp đồng: '.$checklist->HD}}
                            <form  action=" {{ route('checklistmanage.completeChecklist')}}" method="POST" onsubmit="handleSubmit(event,this)">
                            @csrf
                                <input type="text" class="form-control" name="checkListId" hidden value="{{$checklist->ID}}">
                                <button class="btn btn-sm btn-outline-success"><i class="fa fa-check" aria-hidden="true"></i></button>
                            </form>
                        </li>
                        @endforeach

                    </ul>
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
@else
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ONLY AVAILABLE ON STAGING</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
