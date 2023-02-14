@extends('layoutv2.layout.app')

@section('content')
    <div id="wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <a href="new_announcement"
                       class="btn btn-primary tw-mb-2 sm:tw-mb-4">
                        <i class="fa-regular fa-plus tw-mr-1"></i>
                        new_announcement
                    </a>
                    <div class="panel_s">
                        <div class="panel-body panel-table-full">
{{--                            <?php render_datatable([_l('name'), _l('announcement_date_list')], 'announcements'); ?>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
