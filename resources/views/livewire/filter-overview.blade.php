@push('script')
    <script>
        $('#filter_date_datatable').on('change', function(e){
            @this.set('filter_date_datatable', e.target.value)
        });
        Livewire.on('overview', data => {
            let action = document.getElementById('total_action');
            action.textContent = data.count_data;
        });
    </script>
@endpush

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="member_filter" class="control-label">Phone hoặc CustomerID</label>
            <input wire:model.debounce.1000ms="customer_id" id="customer_id" class="form-control" type="number" name="customer_id"
                   placeholder="Nhập SDT hoặc ID khách hàng" autocomplete="off"/>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="daterange" class="control-label">Lọc ngày</label>
            <div class="input-group date">
                <input id="filter_date_datatable" class="form-control daterange" type="text"
                       name="filter_date_datatable"
                       placeholder="Nhập ngày hiển thị" autocomplete="off"/>
                <div class="input-group-addon">
                    <i class="fa-regular fa-calendar calendar-icon"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mbot15">
    <div class="col-md-12">
        <h4 class="tw-mt-0 tw-font-semibold tw-text-lg tw-flex tw-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor"
                 class="tw-w-5 tw-h-5 tw-text-neutral-500 tw-mr-1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
            </svg><span> Tổng quan  </span>
        </h4>

    </div>
    <div class="_filters _hidden_inputs">
        <div
            class="col-md-2 col-xs-6 md:tw-border-r md:tw-border-solid md:tw-border-neutral-300 last:tw-border-r-0">
            <a  href="#"
               class="tw-text-neutral-600 hover:tw-opacity-70 tw-inline-flex tw-items-center">
                <span id="total_action" class="tw-font-semibold tw-mr-3 rtl:tw-ml-3 tw-text-lg">0</span>
                <span style="color:#2563eb">Total Action</span>
            </a>
        </div>
        {{--<div
            class="col-md-2 col-xs-6 md:tw-border-r md:tw-border-solid md:tw-border-neutral-300 last:tw-border-r-0">
            <a  href="#"
               class="tw-text-neutral-600 hover:tw-opacity-70 tw-inline-flex tw-items-center">
                <span id="total_session" class="tw-font-semibold tw-mr-3 rtl:tw-ml-3 tw-text-lg">0</span>
                <span style="color:#f97316">Total Session (Unique)</span>
            </a>
        </div>
        <div
            class="col-md-2 col-xs-6 md:tw-border-r md:tw-border-solid md:tw-border-neutral-300 last:tw-border-r-0">
            <a  href="#"
               class="tw-text-neutral-600 hover:tw-opacity-70 tw-inline-flex tw-items-center">
                                            <span id="total_duration"
                                                class="tw-font-semibold tw-mr-3 rtl:tw-ml-3 tw-text-lg">0</span>
                <span style="color:#16a34a"> Total Duration (ms) </span>
            </a>
        </div>--}}
    </div>
</div>
