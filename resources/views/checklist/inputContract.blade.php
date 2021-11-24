@extends('layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">CLOSE HELP REQUEST</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <div class="col-sm-6">
                    <!--Accordion wrapper-->
                    <div class="accordion md-accordion accordion-blocks" id="accordionEx78" role="tablist" aria-multiselectable="true">

                        <!-- Accordion card -->
                        <div class="card">

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
                                <form action="/checklistmanage/sendStaff" action="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="contractNo" placeholder="Enter Contract Number...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Accordion card -->

                        <!-- Accordion card -->
                        <div class="card">

                            <!-- Card header -->
                            <div class="card-header" role="tab">
                                <!-- Heading -->
                                <a data-toggle="collapse" data-parent="#accordionEx78" href="#completeChecklist" aria-expanded="true" aria-controls="collapseUnfiled">
                                    <h5 class="mt-1 mb-0">
                                        <span>Complete Checklist</span>
                                        <i class="fas fa-angle-down rotate-icon"></i>
                                    </h5>
                                </a>

                            </div>

                            <!-- Card body -->
                            <div id="completeChecklist" class="collapse" role="tabpanel" data-parent="#accordionEx78">
                                <form action="/checklistmanage/completeChecklist" action="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="checkListId"placeholder="Enter Checklist Id...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Accordion card -->
                    </div>
                    <!--/.Accordion wrapper-->
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
