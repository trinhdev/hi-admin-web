@extends('app')

@section('title','Role')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Roles List</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="../../demo13/dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">User Management</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Roles</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Roles List</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-1">
                <!--begin::Wrapper-->
                <div class="me-4">
                    <!--begin::Menu-->
                    <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Filter</a>
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61356fb5baadb">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Menu separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Menu separator-->
                        <!--begin::Form-->
                        <div class="px-7 py-5">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-bold">Status:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div>
                                    <select class="form-select form-select-solid select2-hidden-accessible" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61356fb5baadb" data-allow-clear="true" data-select2-id="select2-data-7-lpy6" tabindex="-1" aria-hidden="true">
                                        <option data-select2-id="select2-data-9-llpa"></option>
                                        <option value="1">Approved</option>
                                        <option value="2">Pending</option>
                                        <option value="2">In Process</option>
                                        <option value="2">Rejected</option>
                                    </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-8-c8th" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-xr14-container" aria-controls="select2-xr14-container"><span class="select2-selection__rendered" id="select2-xr14-container" role="textbox" aria-readonly="true" title="Select option"><span class="select2-selection__placeholder">Select option</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-bold">Member Type:</label>
                                <!--end::Label-->
                                <!--begin::Options-->
                                <div class="d-flex">
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="checkbox" value="1">
                                        <span class="form-check-label">Author</span>
                                    </label>
                                    <!--end::Options-->
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="2" checked="checked">
                                        <span class="form-check-label">Customer</span>
                                    </label>
                                    <!--end::Options-->
                                </div>
                                <!--end::Options-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-bold">Notifications:</label>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked">
                                    <label class="form-check-label">Enabled</label>
                                </div>
                                <!--end::Switch-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Menu 1-->
                    <!--end::Menu-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Button-->
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">Create</a>
                <!--end::Button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                <!--begin::Col-->
                @foreach($roleLists as $item)
                <div class="col-md-4">
                    <!--begin::Card-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{ $item["group"]["name"] }}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-1">
                            <!--begin::Users-->
                            <div class="fw-bolder text-gray-600 mb-5">Total users with this role: 5</div>
                            <!--end::Users-->
                            <!--begin::Permissions-->
                            <div class="d-flex flex-column text-gray-600">
                                @foreach($item["data"] as $role)
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3">
                                    </span>{{ $role["role_name"]}}
                                </div>
                                @endforeach
                                <!-- <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>
                                    <em>and 7 more...</em>
                                </div> -->
                            </div>
                            <!--end::Permissions-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer flex-wrap pt-0">
                            <a href="#" class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                            <button type="button" class="btn btn-light btn-active-light-primary my-1" value="{{ json_encode($item) }}" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit Role</button>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card-->
                </div>
                @endforeach
                <!--end::Col-->
                <!--begin::Add new card-->
                <div class="ol-md-4">
                    <!--begin::Card-->
                    <div class="card h-md-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-center">
                            <!--begin::Button-->
                            <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                <!--begin::Illustration-->
                                <img src="assets/media/illustrations/unitedpalms-1/4.png" alt="" class="mw-100 mh-150px mb-7">
                                <!--end::Illustration-->
                                <!--begin::Label-->
                                <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                                <!--end::Label-->
                            </button>
                            <!--begin::Button-->
                        </div>
                        <!--begin::Card body-->
                    </div>
                    <!--begin::Card-->
                </div>
                <!--begin::Add new card-->
            </div>
            <!--end::Row-->
            <!--begin::Modals-->
            <!--begin::Modal - Add role-->
            <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-750px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">Add a Role</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-lg-5 my-7">
                            <!--begin::Form-->
                            <form id="kt_modal_add_role_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px" style="max-height: 630px;">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-bolder form-label mb-2">
                                            <span class="required">Role name</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name">
                                        <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                    <!--end::Input group-->
                                    <!--begin::Permissions-->
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
                                        <!--end::Label-->
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                <!--begin::Table body-->
                                                <tbody class="text-gray-600 fw-bold">
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <td class="text-gray-800">Administrator Access
                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Allows a full access to the system" aria-label="Allows a full access to the system"></i></td>
                                                        <td>
                                                            <!--begin::Checkbox-->
                                                            < label class="form-check form-check-custom form-check-solid me-9">
                                                                <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all">
                                                                <span class="form-check-label" for="kt_roles_select_all">Select all</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </td>
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">User Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Options-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="user_management_read">
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="user_management_write">
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox" value="" name="user_management_create">
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Options-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Content Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Options-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="content_management_read">
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="content_management_write">
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox" value="" name="content_management_create">
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Options-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Financial Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Options-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="financial_management_read">
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="financial_management_write">
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox" value="" name="financial_management_create">
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Options-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Reporting</td>
                                                        <!--end::Label-->
                                                        <!--begin::Options-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="reporting_read">
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="reporting_write">
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox" value="" name="reporting_create">
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Options-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Payroll</td>
                                                        <!--end::Label-->
                                                        <!--begin::Options-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="payroll_read">
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="payroll_write">
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox" value="" name="payroll_create">
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Options-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Disputes Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Options-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="disputes_management_read">
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="disputes_management_write">
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox" value="" name="disputes_management_create">
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Options-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">API Controls</td>
                                                        <!--end::Label-->
                                                        <!--begin::Options-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="api_controls_read">
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="api_controls_write">
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox" value="" name="api_controls_create">
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Options-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Database Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Options-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="database_management_read">
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="database_management_write">
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox" value="" name="database_management_create">
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Options-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                    <!--begin::Table row-->
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">Repository Management</td>
                                                        <!--end::Label-->
                                                        <!--begin::Options-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="repository_management_read">
                                                                    <span class="form-check-label">Read</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input" type="checkbox" value="" name="repository_management_write">
                                                                    <span class="form-check-label">Write</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox" value="" name="repository_management_create">
                                                                    <span class="form-check-label">Create</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Options-->
                                                    </tr>
                                                    <!--end::Table row-->
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>
                                    <!--end::Permissions-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
                                    <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            <div></div></form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add role-->

            <edit-role-component></edit-role-component>
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<script>
    function triggerModal(data){

    }
</script>
@endsection