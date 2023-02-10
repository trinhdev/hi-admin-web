<div class="table-wrapper">
    {{--@if ($table->isHasFilter())
        <div class="table-configuration-wrap" @if (request()->has('filter_table_id')) style="display: block;" @endif>
            <span class="configuration-close-btn btn-show-table-options"><i class="fa fa-times"></i></span>
            {!! $table->renderFilter() !!}
        </div>
    @endif--}}
    {{--end filter--}}
    <div class="portlet light bordered portlet-no-padding">
        <div class="portlet-title">
            <div class="caption">
                <div class="wrapper-action">
                    @if ($actions)
                        <div class="btn-group">
                            <a class="btn btn-secondary dropdown-toggle" href="#" data-bs-toggle="dropdown">Hành động
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($actions as $action)
                                    <li>
                                        {!! $action !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($table->isHasFilter())
                        <button class="btn btn-primary btn-show-table-options">{{ __('Lọc dữ liệu') }}</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-responsive @if ($actions) table-has-actions @endif @if ($table->isHasFilter()) table-has-filter @endif">
                @section('main-table')
                    {!! $dataTable->table(compact('id', 'class'), false) !!}
                @show
            </div>
        </div>
    </div>
</div>
@include('table.modal')

@push('footer')
    {!! $dataTable->scripts() !!}
@endpush
