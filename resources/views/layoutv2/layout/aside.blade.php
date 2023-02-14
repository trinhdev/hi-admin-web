<aside id="menu" class="sidebar sidebar">
    <ul class="nav metis-menu" id="side-menu">
        <li class="tw-mt-[63px] sm:tw-mt-0 -tw-mx-2 tw-overflow-hidden sm:tw-bg-neutral-900/50">
            <div id="logo" class="tw-py-2 tw-px-2 tw-h-[63px] tw-flex tw-items-center">
                <a href="{{ url('/testv2') }}" class="!tw-mt-0 logo logo-text">
                    <img src="{{ asset('themes/images/logo-hifpt1.png') }}" alt="Logo"
                         class="img img-responsive staff-profile-image-small tw-ring-offset-2 tw-ring-primary-500 tw-mx-1 tw-mt-2.5">
                    HiFPT
                </a>
            </div>
        </li>
        @php
            $icon = ['fa-user', 'fa-cog', 'fa-repeat', 'fa-life-ring', 'fa-chart-bar', 'fa-cogs', 'fa-cogs', 'fa-cogs'];
            $key = 0;
        @endphp
        @if(!empty($groupModule))
            @foreach($groupModule as $group)
                @if(!empty($group->children))
                    <li class="menu-item-FILE_SHARING">
                        <a href="#" aria-expanded="false">
                            <i class="fa {{ $icon[$key] ?? null }} menu-icon"></i>
                            <span class="menu-text">{{ $group->group_module_name}}</span>
                            <span class="fa arrow pleft5"></span>
                        </a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false">
                            @foreach($group->children as $module)
                                <li class="sub-menu-item-file_sharing_management">
                                    @if(request()->is("/") || $module->uri == "")
                                        <a href="/{{ $module->uri }}">
                                            <i class="fa {{ $module->icon}} menu-icon"></i>
                                            <span class="sub-menu-text">{{ $module->module_name}}</span>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="menu-item-FILE_SHARING">
                        <a href="/{{$group->uri}}" aria-expanded="false">
                            <i class="fa fa-folder menu-icon"></i>
                            <span class="menu-text">{{ $group->group_module_name}}</span>
                            <span class="fa arrow pleft5"></span>
                        </a>
                    </li>
                @endif
                @php
                    $key ++;
                @endphp
            @endforeach
        @endif
        <li class="menu-item-customers">
            <a href="{{ url('/testv2') }}clients" aria-expanded="false">
                <i class="fa-regular fa-user menu-icon"></i>
                <span class="menu-text">Khách hàng</span>
            </a>
        </li>
        <li class="menu-item-FILE_SHARING">
            <a href="#" aria-expanded="false">
                <i class="fa fa-folder menu-icon"></i>
                <span class="menu-text">Chia sẻ file</span>
                <span class="fa arrow pleft5"></span>
            </a>
            <ul class="nav nav-second-level collapse" aria-expanded="false">
                <li class="sub-menu-item-file_sharing_management">
                    <a href="{{ url('/testv2') }}file_sharing/manage">
                        <i class="fa fa-folder-open menu-icon"></i>
                        <span class="sub-menu-text">Quản lý tập tin                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-file_sharing_sharings">
                    <a href="{{ url('/testv2') }}file_sharing/sharing">
                        <i class="fa fa-share-square-o menu-icon"></i>
                        <span class="sub-menu-text">Chia sẻ                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-file_sharing_download_management">
                    <a href="{{ url('/testv2') }}file_sharing/download_management">
                        <i class="fa fa-cloud-download menu-icon"></i>
                        <span class="sub-menu-text">Quản lý tải xuống                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-file_sharing_report">
                    <a href="{{ url('/testv2') }}file_sharing/reports">
                        <i class="fa fa-area-chart menu-icon"></i>
                        <span class="sub-menu-text">
                            Reports                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-file_sharing_setting">
                    <a href="{{ url('/testv2') }}file_sharing/setting">
                        <i class="fa fa-cogs menu-icon"></i>
                        <span class="sub-menu-text">Cài đặt                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item-sales"
        >
            <a href="#" aria-expanded="false"
            >
                <i class="fa-solid fa-receipt menu-icon"></i>
                <span class="menu-text">
                    Doanh số                </span>
                <span class="fa arrow pleft5"></span>
            </a>
            <ul class="nav nav-second-level collapse" aria-expanded="false">
                <li class="sub-menu-item-proposals"
                >
                    <a href="{{ url('/testv2') }}proposals"
                    >
                                                <span class="sub-menu-text">
                            Đề xuất kế hoạch                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-estimates"
                >
                    <a href="{{ url('/testv2') }}estimates"
                    >
                                                <span class="sub-menu-text">
                            Báo giá                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-invoices"
                >
                    <a href="{{ url('/testv2') }}invoices"
                    >
                                                <span class="sub-menu-text">
                            Hóa đơn                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-payments"
                >
                    <a href="{{ url('/testv2') }}payments"
                    >
                                                <span class="sub-menu-text">
                            Thanh toán                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-credit_notes"
                >
                    <a href="{{ url('/testv2') }}credit_notes"
                    >
                                                <span class="sub-menu-text">
                            Credit Notes                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-items"
                >
                    <a href="{{ url('/testv2') }}invoice_items"
                    >
                                                <span class="sub-menu-text">
                            Sản phẩm                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item-subscriptions"
        >
            <a href="{{ url('/testv2') }}subscriptions" aria-expanded="false"
            >
                <i class="fa fa-repeat menu-icon"></i>
                <span class="menu-text">
                    Subscriptions                </span>
            </a>
        </li>
        <li class="menu-item-expenses"
        >
            <a href="{{ url('/testv2') }}expenses" aria-expanded="false"
            >
                <i class="fa-regular fa-file-lines menu-icon"></i>
                <span class="menu-text">
                    Chi phí                </span>
            </a>
        </li>
        <li class="menu-item-contracts"
        >
            <a href="{{ url('/testv2') }}contracts" aria-expanded="false"
            >
                <i class="fa-solid fa-file-contract menu-icon"></i>
                <span class="menu-text">
                    Hợp đồng                </span>
            </a>
        </li>
        <li class="menu-item-projects"
        >
            <a href="{{ url('/testv2') }}projects" aria-expanded="false"
            >
                <i class="fa-solid fa-chart-gantt menu-icon"></i>
                <span class="menu-text">
                    Các dự án                </span>
            </a>
        </li>
        <li class="menu-item-tasks"
        >
            <a href="{{ url('/testv2') }}tasks" aria-expanded="false"
            >
                <i class="fa-regular fa-circle-check menu-icon"></i>
                <span class="menu-text">
                    Công việc                </span>
            </a>
        </li>
        <li class="menu-item-support"
        >
            <a href="{{ url('/testv2') }}tickets" aria-expanded="false"
            >
                <i class="fa-regular fa-life-ring menu-icon"></i>
                <span class="menu-text">
                    Hỗ trợ                </span>
            </a>
        </li>
        <li class="menu-item-leads"
        >
            <a href="{{ url('/testv2') }}leads" aria-expanded="false"
            >
                <i class="fa fa-tty menu-icon"></i>
                <span class="menu-text">
                    Khách tìm năng                </span>
            </a>
        </li>
        <li class="menu-item-estimate_request"
        >
            <a href="{{ url('/testv2') }}estimate_request" aria-expanded="false"
            >
                <i class="fa-regular fa-file menu-icon"></i>
                <span class="menu-text">
                    Estimate request                </span>
            </a>
        </li>
        <li class="menu-item-knowledge-base"
        >
            <a href="{{ url('/testv2') }}knowledge_base" aria-expanded="false"
            >
                <i class="fa-regular fa-folder-closed menu-icon"></i>
                <span class="menu-text">
                    Kiến thức                </span>
            </a>
        </li>
        <li class="menu-item-utilities"
        >
            <a href="#" aria-expanded="false"
            >
                <i class="fa fa-cogs menu-icon"></i>
                <span class="menu-text">
                    Tiện ích                </span>
                <span class="fa arrow pleft5"></span>
            </a>
            <ul class="nav nav-second-level collapse" aria-expanded="false">
                <li class="sub-menu-item-media"
                >
                    <a href="{{ url('/testv2') }}utilities/media"
                    >
                                                <span class="sub-menu-text">
                            Media                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-bulk-pdf-exporter"
                >
                    <a href="{{ url('/testv2') }}utilities/bulk_pdf_exporter"
                    >
                                                <span class="sub-menu-text">
                            Xuất tập tin PDF lớn                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-csv-export"
                >
                    <a href="{{ url('/testv2') }}exports"
                    >
                                                <span class="sub-menu-text">
                            CSV Export                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-calendar"
                >
                    <a href="{{ url('/testv2') }}utilities/calendar"
                    >
                                                <span class="sub-menu-text">
                            Lịch                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-announcements"
                >
                    <a href="{{ url('/testv2') }}announcements"
                    >
                                                <span class="sub-menu-text">
                            Thông báo                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-activity-log"
                >
                    <a href="{{ url('/testv2') }}utilities/activity_log"
                    >
                                                <span class="sub-menu-text">
                            Nhật ký hoạt động                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-ticket-pipe-log"
                >
                    <a href="{{ url('/testv2') }}utilities/pipe_log"
                    >
                                                <span class="sub-menu-text">
                            Ghi chép yêu cầu hỗ trợ                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item-reports"
        >
            <a href="#" aria-expanded="false"
            >
                <i class="fa-regular fa-chart-bar menu-icon"></i>
                <span class="menu-text">
                    Báo cáo                </span>
                <span class="fa arrow pleft5"></span>
            </a>
            <ul class="nav nav-second-level collapse" aria-expanded="false">
                <li class="sub-menu-item-sales-reports"
                >
                    <a href="{{ url('/testv2') }}reports/sales"
                    >
                                                <span class="sub-menu-text">
                            Doanh số                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-expenses-reports"
                >
                    <a href="{{ url('/testv2') }}reports/expenses"
                    >
                                                <span class="sub-menu-text">
                            Chi phí                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-expenses-vs-income-reports"
                >
                    <a href="{{ url('/testv2') }}reports/expenses_vs_income"
                    >
                                                <span class="sub-menu-text">
                            Chi phí và thu nhập                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-leads-reports"
                >
                    <a href="{{ url('/testv2') }}reports/leads"
                    >
                                                <span class="sub-menu-text">
                            Khách hàng mục tiêu                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-timesheets-reports"
                >
                    <a href="{{ url('/testv2') }}staff/timesheets?view=all"
                    >
                                                <span class="sub-menu-text">
                            Tổng quan biểu đồ thời gian                        </span>
                    </a>
                </li>
                <li class="sub-menu-item-knowledge-base-reports"
                >
                    <a href="{{ url('/testv2') }}reports/knowledge_base_articles"
                    >
                                                <span class="sub-menu-text">
                            Kiến thức chuyên môn                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li id="setup-menu-item">
            <a href="#" class="open-customizer"><i class="fa fa-cog menu-icon"></i>
                <span class="menu-text">
                    Thiết lập                                    </span>
            </a>
        </li>
    </ul>
</aside>
