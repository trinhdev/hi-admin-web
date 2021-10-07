@extends('app')

@section('title','Dashboard')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Toolbar-->
						<div class="toolbar" id="kt_toolbar">
							<!--begin::Container-->
							<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
								<!--begin::Page title-->
								<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
									<!--begin::Title-->
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">My Projects</h1>
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
										<li class="breadcrumb-item text-muted">Pages</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-200 w-5px h-2px"></span>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">Projects</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-200 w-5px h-2px"></span>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item text-dark">My Projects</li>
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
										<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61356f87ae099">
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
														<select class="form-select form-select-solid select2-hidden-accessible" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61356f87ae099" data-allow-clear="true" data-select2-id="select2-data-7-hfcu" tabindex="-1" aria-hidden="true">
															<option data-select2-id="select2-data-9-fq0k"></option>
															<option value="1">Approved</option>
															<option value="2">Pending</option>
															<option value="2">In Process</option>
															<option value="2">Rejected</option>
														</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-8-xg7j" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-w7ld-container" aria-controls="select2-w7ld-container"><span class="select2-selection__rendered" id="select2-w7ld-container" role="textbox" aria-readonly="true" title="Select option"><span class="select2-selection__placeholder">Select option</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
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
								<!--begin::Stats-->
								<div class="row g-6 g-xl-9">
									<div class="col-lg-6 col-xxl-4">
										<!--begin::Card-->
										<div class="card h-100">
											<!--begin::Card body-->
											<div class="card-body p-9">
												<!--begin::Heading-->
												<div class="fs-2hx fw-bolder">237</div>
												<div class="fs-4 fw-bold text-gray-400 mb-7">Current Projects</div>
												<!--end::Heading-->
												<!--begin::Wrapper-->
												<div class="d-flex flex-wrap">
													<!--begin::Chart-->
													<div class="d-flex flex-center h-100px w-100px me-9 mb-5">
														<canvas id="kt_project_list_chart" width="100" height="100" style="display: block; box-sizing: border-box; height: 100px; width: 100px;"></canvas>
													</div>
													<!--end::Chart-->
													<!--begin::Labels-->
													<div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
														<!--begin::Label-->
														<div class="d-flex fs-6 fw-bold align-items-center mb-3">
															<div class="bullet bg-primary me-3"></div>
															<div class="text-gray-400">Active</div>
															<div class="ms-auto fw-bolder text-gray-700">30</div>
														</div>
														<!--end::Label-->
														<!--begin::Label-->
														<div class="d-flex fs-6 fw-bold align-items-center mb-3">
															<div class="bullet bg-success me-3"></div>
															<div class="text-gray-400">Completed</div>
															<div class="ms-auto fw-bolder text-gray-700">45</div>
														</div>
														<!--end::Label-->
														<!--begin::Label-->
														<div class="d-flex fs-6 fw-bold align-items-center">
															<div class="bullet bg-gray-300 me-3"></div>
															<div class="text-gray-400">Yet to start</div>
															<div class="ms-auto fw-bolder text-gray-700">25</div>
														</div>
														<!--end::Label-->
													</div>
													<!--end::Labels-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Card body-->
										</div>
										<!--end::Card-->
									</div>
									<div class="col-lg-6 col-xxl-4">
										<!--begin::Budget-->
										<div class="card h-100">
											<div class="card-body p-9">
												<div class="fs-2hx fw-bolder">$3,290.00</div>
												<div class="fs-4 fw-bold text-gray-400 mb-7">Project Finance</div>
												<div class="fs-6 d-flex justify-content-between mb-4">
													<div class="fw-bold">Avg. Project Budget</div>
													<div class="d-flex fw-bolder">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr007.svg-->
													<span class="svg-icon svg-icon-3 me-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z" fill="black"></path>
															<path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z" fill="black"></path>
														</svg>
													</span>
													<!--end::Svg Icon-->$6,570</div>
												</div>
												<div class="separator separator-dashed"></div>
												<div class="fs-6 d-flex justify-content-between my-4">
													<div class="fw-bold">Lowest Project Check</div>
													<div class="d-flex fw-bolder">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr006.svg-->
													<span class="svg-icon svg-icon-3 me-1 svg-icon-danger">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M13.4 14.8L5.3 6.69999C4.9 6.29999 4.9 5.7 5.3 5.3C5.7 4.9 6.29999 4.9 6.69999 5.3L14.8 13.4L13.4 14.8Z" fill="black"></path>
															<path opacity="0.3" d="M19.8 8.5L8.5 19.8H18.8C19.4 19.8 19.8 19.4 19.8 18.8V8.5Z" fill="black"></path>
														</svg>
													</span>
													<!--end::Svg Icon-->$408</div>
												</div>
												<div class="separator separator-dashed"></div>
												<div class="fs-6 d-flex justify-content-between mt-4">
													<div class="fw-bold">Ambassador Page</div>
													<div class="d-flex fw-bolder">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr007.svg-->
													<span class="svg-icon svg-icon-3 me-1 svg-icon-success">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z" fill="black"></path>
															<path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z" fill="black"></path>
														</svg>
													</span>
													<!--end::Svg Icon-->$920</div>
												</div>
											</div>
										</div>
										<!--end::Budget-->
									</div>
									<div class="col-lg-6 col-xxl-4">
										<!--begin::Clients-->
										<div class="card h-100">
											<div class="card-body p-9">
												<!--begin::Heading-->
												<div class="fs-2hx fw-bolder">49</div>
												<div class="fs-4 fw-bold text-gray-400 mb-7">Metronic Clients</div>
												<!--end::Heading-->
												<!--begin::Users group-->
												<div class="symbol-group symbol-hover mb-9">
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Alan Warden">
														<span class="symbol-label bg-warning text-inverse-warning fw-bolder">A</span>
													</div>
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Michael Eberon">
														<img alt="Pic" src="assets/media/avatars/150-12.jpg">
													</div>
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Michelle Swanston">
														<img alt="Pic" src="assets/media/avatars/150-13.jpg">
													</div>
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Francis Mitcham">
														<img alt="Pic" src="assets/media/avatars/150-5.jpg">
													</div>
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Susan Redwood">
														<span class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
													</div>
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Melody Macy">
														<img alt="Pic" src="assets/media/avatars/150-3.jpg">
													</div>
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Perry Matthew">
														<span class="symbol-label bg-info text-inverse-info fw-bolder">P</span>
													</div>
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Barry Walter">
														<img alt="Pic" src="assets/media/avatars/150-7.jpg">
													</div>
													<a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
														<span class="symbol-label bg-dark text-gray-300 fs-8 fw-bolder">+42</span>
													</a>
												</div>
												<!--end::Users group-->
												<!--begin::Actions-->
												<div class="d-flex">
													<a href="#" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">All Clients</a>
													<a href="#" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">Invite New</a>
												</div>
												<!--end::Actions-->
											</div>
										</div>
										<!--end::Clients-->
									</div>
								</div>
								<!--end::Stats-->
								<!--begin::Toolbar-->
								<div class="d-flex flex-wrap flex-stack my-5">
									<!--begin::Heading-->
									<h2 class="fs-2 fw-bold my-2">Projects
									<span class="fs-6 text-gray-400 ms-1">by Status</span></h2>
									<!--end::Heading-->
									<!--begin::Controls-->
									<div class="d-flex flex-wrap my-1">
										<!--begin::Select wrapper-->
										<div class="m-0">
											<!--begin::Select-->
											<select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-white form-select-sm fw-bolder w-125px select2-hidden-accessible" data-select2-id="select2-data-10-ylgk" tabindex="-1" aria-hidden="true">
												<option value="Active" selected="selected" data-select2-id="select2-data-12-okso">Active</option>
												<option value="Approved">In Progress</option>
												<option value="Declined">To Do</option>
												<option value="In Progress">Completed</option>
											</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-11-ll0a" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-white form-select-sm fw-bolder w-125px" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-status-98-container" aria-controls="select2-status-98-container"><span class="select2-selection__rendered" id="select2-status-98-container" role="textbox" aria-readonly="true" title="Active">Active</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
											<!--end::Select-->
										</div>
										<!--end::Select wrapper-->
									</div>
									<!--end::Controls-->
								</div>
								<!--end::Toolbar-->
								<!--begin::Row-->
								<div class="row g-6 g-xl-9">
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="../../demo13/dist/pages/projects/project.html" class="card border border-2 border-gray-300 border-hover">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="assets/media/svg/brand-logos/plurk.svg" alt="image" class="p-3">
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">In Progress</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Fitnes App</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Jul 25, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 50% completed">
													<div class="bg-primary rounded h-4px" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Emma Smith">
														<img alt="Pic" src="assets/media/avatars/150-1.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Rudy Stone">
														<img alt="Pic" src="assets/media/avatars/150-2.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Susan Redwood">
														<span class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="../../demo13/dist/pages/projects/project.html" class="card border border-2 border-gray-300 border-hover">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="assets/media/svg/brand-logos/disqus.svg" alt="image" class="p-3">
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light fw-bolder me-auto px-4 py-3">Pending</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Leaf CRM</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">May 10, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$36,400.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 30% completed">
													<div class="bg-info rounded h-4px" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Alan Warden">
														<span class="symbol-label bg-warning text-inverse-warning fw-bolder">A</span>
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Brian Cox">
														<img alt="Pic" src="assets/media/avatars/150-4.jpg">
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="../../demo13/dist/pages/projects/project.html" class="card border border-2 border-gray-300 border-hover">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="assets/media/svg/brand-logos/figma-1.svg" alt="image" class="p-3">
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-success fw-bolder me-auto px-4 py-3">Completed</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Atica Banking</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Mar 14, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$605,100.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 100% completed">
													<div class="bg-success rounded h-4px" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Mad Macy">
														<img alt="Pic" src="assets/media/avatars/150-3.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Cris Willson">
														<img alt="Pic" src="assets/media/avatars/150-8.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Mike Garcie">
														<span class="symbol-label bg-info text-inverse-info fw-bolder">M</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="../../demo13/dist/pages/projects/project.html" class="card border border-2 border-gray-300 border-hover">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="assets/media/svg/brand-logos/sentry-3.svg" alt="image" class="p-3">
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light fw-bolder me-auto px-4 py-3">Pending</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Finance Dispatch</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Aug 19, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 60% completed">
													<div class="bg-info rounded h-4px" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Nich Warden">
														<span class="symbol-label bg-warning text-inverse-warning fw-bolder">N</span>
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Rob Otto">
														<span class="symbol-label bg-success text-inverse-success fw-bolder">R</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="../../demo13/dist/pages/projects/project.html" class="card border border-2 border-gray-300 border-hover">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="assets/media/svg/brand-logos/xing-icon.svg" alt="image" class="p-3">
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">In Progress</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">9 Degree</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Jul 25, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 40% completed">
													<div class="bg-primary rounded h-4px" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Francis Mitcham">
														<img alt="Pic" src="assets/media/avatars/150-5.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Michelle Swanston">
														<img alt="Pic" src="assets/media/avatars/150-13.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Susan Redwood">
														<span class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="../../demo13/dist/pages/projects/project.html" class="card border border-2 border-gray-300 border-hover">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="assets/media/svg/brand-logos/tvit.svg" alt="image" class="p-3">
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">In Progress</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">GoPro App</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Dec 20, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 70% completed">
													<div class="bg-primary rounded h-4px" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Melody Macy">
														<img alt="Pic" src="assets/media/avatars/150-3.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Robin Watterman">
														<span class="symbol-label bg-success text-inverse-success fw-bolder">R</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="../../demo13/dist/pages/projects/project.html" class="card border border-2 border-gray-300 border-hover">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="assets/media/svg/brand-logos/aven.svg" alt="image" class="p-3">
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">In Progress</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Buldozer CRM</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Jun 24, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 70% completed">
													<div class="bg-primary rounded h-4px" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Melody Macy">
														<img alt="Pic" src="assets/media/avatars/150-3.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="John Mixin">
														<img alt="Pic" src="assets/media/avatars/150-11.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Emma Smith">
														<span class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="../../demo13/dist/pages/projects/project.html" class="card border border-2 border-gray-300 border-hover">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="assets/media/svg/brand-logos/treva.svg" alt="image" class="p-3">
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-danger fw-bolder me-auto px-4 py-3">Overdue</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Aviasales App</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Jun 24, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 10% completed">
													<div class="bg-danger rounded h-4px" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Alan Warden">
														<span class="symbol-label bg-warning text-inverse-warning fw-bolder">A</span>
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Brian Cox">
														<img alt="Pic" src="assets/media/avatars/150-4.jpg">
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="../../demo13/dist/pages/projects/project.html" class="card border border-2 border-gray-300 border-hover">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="assets/media/svg/brand-logos/kanba.svg" alt="image" class="p-3">
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-success fw-bolder me-auto px-4 py-3">Completed</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Oppo CRM</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Jul 25, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 100% completed">
													<div class="bg-success rounded h-4px" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Nick Macy">
														<img alt="Pic" src="assets/media/avatars/150-3.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Sean Paul">
														<img alt="Pic" src="assets/media/avatars/150-8.jpg">
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Mike Collin">
														<span class="symbol-label bg-info text-inverse-info fw-bolder">M</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
								<!--begin::Pagination-->
								<div class="d-flex flex-stack flex-wrap pt-10">
									<div class="fs-6 fw-bold text-gray-700">Showing 1 to 10 of 50 entries</div>
									<!--begin::Pages-->
									<ul class="pagination">
										<li class="page-item previous">
											<a href="#" class="page-link">
												<i class="previous"></i>
											</a>
										</li>
										<li class="page-item active">
											<a href="#" class="page-link">1</a>
										</li>
										<li class="page-item">
											<a href="#" class="page-link">2</a>
										</li>
										<li class="page-item">
											<a href="#" class="page-link">3</a>
										</li>
										<li class="page-item">
											<a href="#" class="page-link">4</a>
										</li>
										<li class="page-item">
											<a href="#" class="page-link">5</a>
										</li>
										<li class="page-item">
											<a href="#" class="page-link">6</a>
										</li>
										<li class="page-item next">
											<a href="#" class="page-link">
												<i class="next"></i>
											</a>
										</li>
									</ul>
									<!--end::Pages-->
								</div>
								<!--end::Pagination-->
								<!--begin::Modals-->
								<!--begin::Modal - View Users-->
								<div class="modal fade" id="kt_modal_view_users" tabindex="-1" aria-hidden="true">
									<!--begin::Modal dialog-->
									<div class="modal-dialog mw-650px">
										<!--begin::Modal content-->
										<div class="modal-content">
											<!--begin::Modal header-->
											<div class="modal-header pb-0 border-0 justify-content-end">
												<!--begin::Close-->
												<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
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
											<!--begin::Modal header-->
											<!--begin::Modal body-->
											<div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
												<!--begin::Heading-->
												<div class="text-center mb-13">
													<!--begin::Title-->
													<h1 class="mb-3">Browse Users</h1>
													<!--end::Title-->
													<!--begin::Description-->
													<div class="text-muted fw-bold fs-5">If you need more info, please check out our
													<a href="#" class="link-primary fw-bolder">Users Directory</a>.</div>
													<!--end::Description-->
												</div>
												<!--end::Heading-->
												<!--begin::Users-->
												<div class="mb-15">
													<!--begin::List-->
													<div class="mh-375px scroll-y me-n7 pe-7">
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<img alt="Pic" src="assets/media/avatars/150-1.jpg">
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Emma Smith
																	<span class="badge badge-light fs-8 fw-bold ms-2">Art Director</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">e.smith@kpmg.com.au</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$23,000</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<span class="symbol-label bg-light-danger text-danger fw-bold">M</span>
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Melody Macy
																	<span class="badge badge-light fs-8 fw-bold ms-2">Marketing Analytic</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">melody@altbox.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$50,500</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<img alt="Pic" src="assets/media/avatars/150-26.jpg">
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Max Smith
																	<span class="badge badge-light fs-8 fw-bold ms-2">Software Enginer</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">max@kt.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$75,900</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<img alt="Pic" src="assets/media/avatars/150-4.jpg">
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Sean Bean
																	<span class="badge badge-light fs-8 fw-bold ms-2">Web Developer</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">sean@dellito.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$10,500</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<img alt="Pic" src="assets/media/avatars/150-15.jpg">
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Brian Cox
																	<span class="badge badge-light fs-8 fw-bold ms-2">UI/UX Designer</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">brian@exchange.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$20,000</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<span class="symbol-label bg-light-warning text-warning fw-bold">M</span>
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Mikaela Collins
																	<span class="badge badge-light fs-8 fw-bold ms-2">Head Of Marketing</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">mikaela@pexcom.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$9,300</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<img alt="Pic" src="assets/media/avatars/150-8.jpg">
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Francis Mitcham
																	<span class="badge badge-light fs-8 fw-bold ms-2">Software Arcitect</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">f.mitcham@kpmg.com.au</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$15,000</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<span class="symbol-label bg-light-danger text-danger fw-bold">O</span>
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Olivia Wild
																	<span class="badge badge-light fs-8 fw-bold ms-2">System Admin</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">olivia@corpmail.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$23,000</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<span class="symbol-label bg-light-primary text-primary fw-bold">N</span>
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Neil Owen
																	<span class="badge badge-light fs-8 fw-bold ms-2">Account Manager</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">owen.neil@gmail.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$45,800</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<img alt="Pic" src="assets/media/avatars/150-6.jpg">
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Dan Wilson
																	<span class="badge badge-light fs-8 fw-bold ms-2">Web Desinger</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">dam@consilting.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$90,500</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<span class="symbol-label bg-light-danger text-danger fw-bold">E</span>
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Emma Bold
																	<span class="badge badge-light fs-8 fw-bold ms-2">Corporate Finance</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">emma@intenso.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$5,000</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<img alt="Pic" src="assets/media/avatars/150-7.jpg">
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Ana Crown
																	<span class="badge badge-light fs-8 fw-bold ms-2">Customer Relationship</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">ana.cf@limtel.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$70,000</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
														<!--begin::User-->
														<div class="d-flex flex-stack py-5">
															<!--begin::Details-->
															<div class="d-flex align-items-center">
																<!--begin::Avatar-->
																<div class="symbol symbol-35px symbol-circle">
																	<span class="symbol-label bg-light-info text-info fw-bold">A</span>
																</div>
																<!--end::Avatar-->
																<!--begin::Details-->
																<div class="ms-6">
																	<!--begin::Name-->
																	<a href="#" class="d-flex align-items-center fs-5 fw-bolder text-dark text-hover-primary">Robert Doe
																	<span class="badge badge-light fs-8 fw-bold ms-2">Marketing Executive</span></a>
																	<!--end::Name-->
																	<!--begin::Email-->
																	<div class="fw-bold text-muted">robert@benko.com</div>
																	<!--end::Email-->
																</div>
																<!--end::Details-->
															</div>
															<!--end::Details-->
															<!--begin::Stats-->
															<div class="d-flex">
																<!--begin::Sales-->
																<div class="text-end">
																	<div class="fs-5 fw-bolder text-dark">$45,500</div>
																	<div class="fs-7 text-muted">Sales</div>
																</div>
																<!--end::Sales-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::User-->
													</div>
													<!--end::List-->
												</div>
												<!--end::Users-->
												<!--begin::Notice-->
												<div class="d-flex justify-content-between">
													<!--begin::Label-->
													<div class="fw-bold">
														<label class="fs-6">Adding Users by Team Members</label>
														<div class="fs-7 text-muted">If you need more info, please check budget planning</div>
													</div>
													<!--end::Label-->
													<!--begin::Switch-->
													<label class="form-check form-switch form-check-custom form-check-solid">
														<input class="form-check-input" type="checkbox" value="" checked="checked">
														<span class="form-check-label fw-bold text-muted">Allowed</span>
													</label>
													<!--end::Switch-->
												</div>
												<!--end::Notice-->
											</div>
											<!--end::Modal body-->
										</div>
										<!--end::Modal content-->
									</div>
									<!--end::Modal dialog-->
								</div>
								<!--end::Modal - View Users-->
								<!--begin::Modal - Users Search-->
								<div class="modal fade" id="kt_modal_users_search" tabindex="-1" aria-hidden="true">
									<!--begin::Modal dialog-->
									<div class="modal-dialog modal-dialog-centered mw-650px">
										<!--begin::Modal content-->
										<div class="modal-content">
											<!--begin::Modal header-->
											<div class="modal-header pb-0 border-0 justify-content-end">
												<!--begin::Close-->
												<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
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
											<!--begin::Modal header-->
											<!--begin::Modal body-->
											<div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
												<!--begin::Content-->
												<div class="text-center mb-13">
													<h1 class="mb-3">Search Users</h1>
													<div class="text-muted fw-bold fs-5">Invite Collaborators To Your Project</div>
												</div>
												<!--end::Content-->
												<!--begin::Search-->
												<div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline" data-kt-search="true">
													<!--begin::Form-->
													<form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
														<!--begin::Hidden input(Added to disable form autocomplete)-->
														<input type="hidden">
														<!--end::Hidden input-->
														<!--begin::Icon-->
														<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
														<span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
																<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
															</svg>
														</span>
														<!--end::Svg Icon-->
														<!--end::Icon-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="Search by username, full name or email..." data-kt-search-element="input">
														<!--end::Input-->
														<!--begin::Spinner-->
														<span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
															<span class="spinner-border h-15px w-15px align-middle text-muted"></span>
														</span>
														<!--end::Spinner-->
														<!--begin::Reset-->
														<span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
															<span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
																	<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
																</svg>
															</span>
															<!--end::Svg Icon-->
														</span>
														<!--end::Reset-->
													</form>
													<!--end::Form-->
													<!--begin::Wrapper-->
													<div class="py-5">
														<!--begin::Suggestions-->
														<div data-kt-search-element="suggestions">
															<!--begin::Heading-->
															<h3 class="fw-bold mb-5">Recently searched:</h3>
															<!--end::Heading-->
															<!--begin::Users-->
															<div class="mh-375px scroll-y me-n7 pe-7">
																<!--begin::User-->
																<a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
																	<!--begin::Avatar-->
																	<div class="symbol symbol-35px symbol-circle me-5">
																		<img alt="Pic" src="assets/media/avatars/150-1.jpg">
																	</div>
																	<!--end::Avatar-->
																	<!--begin::Info-->
																	<div class="fw-bold">
																		<span class="fs-6 text-gray-800 me-2">Emma Smith</span>
																		<span class="badge badge-light">Art Director</span>
																	</div>
																	<!--end::Info-->
																</a>
																<!--end::User-->
																<!--begin::User-->
																<a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
																	<!--begin::Avatar-->
																	<div class="symbol symbol-35px symbol-circle me-5">
																		<span class="symbol-label bg-light-danger text-danger fw-bold">M</span>
																	</div>
																	<!--end::Avatar-->
																	<!--begin::Info-->
																	<div class="fw-bold">
																		<span class="fs-6 text-gray-800 me-2">Melody Macy</span>
																		<span class="badge badge-light">Marketing Analytic</span>
																	</div>
																	<!--end::Info-->
																</a>
																<!--end::User-->
																<!--begin::User-->
																<a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
																	<!--begin::Avatar-->
																	<div class="symbol symbol-35px symbol-circle me-5">
																		<img alt="Pic" src="assets/media/avatars/150-26.jpg">
																	</div>
																	<!--end::Avatar-->
																	<!--begin::Info-->
																	<div class="fw-bold">
																		<span class="fs-6 text-gray-800 me-2">Max Smith</span>
																		<span class="badge badge-light">Software Enginer</span>
																	</div>
																	<!--end::Info-->
																</a>
																<!--end::User-->
																<!--begin::User-->
																<a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
																	<!--begin::Avatar-->
																	<div class="symbol symbol-35px symbol-circle me-5">
																		<img alt="Pic" src="assets/media/avatars/150-4.jpg">
																	</div>
																	<!--end::Avatar-->
																	<!--begin::Info-->
																	<div class="fw-bold">
																		<span class="fs-6 text-gray-800 me-2">Sean Bean</span>
																		<span class="badge badge-light">Web Developer</span>
																	</div>
																	<!--end::Info-->
																</a>
																<!--end::User-->
																<!--begin::User-->
																<a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
																	<!--begin::Avatar-->
																	<div class="symbol symbol-35px symbol-circle me-5">
																		<img alt="Pic" src="assets/media/avatars/150-15.jpg">
																	</div>
																	<!--end::Avatar-->
																	<!--begin::Info-->
																	<div class="fw-bold">
																		<span class="fs-6 text-gray-800 me-2">Brian Cox</span>
																		<span class="badge badge-light">UI/UX Designer</span>
																	</div>
																	<!--end::Info-->
																</a>
																<!--end::User-->
															</div>
															<!--end::Users-->
														</div>
														<!--end::Suggestions-->
														<!--begin::Results(add d-none to below element to hide the users list by default)-->
														<div data-kt-search-element="results" class="d-none">
															<!--begin::Users-->
															<div class="mh-375px scroll-y me-n7 pe-7">
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="0">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='0']" value="0">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<img alt="Pic" src="assets/media/avatars/150-1.jpg">
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Emma Smith</a>
																			<div class="fw-bold text-muted">e.smith@kpmg.com.au</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-13-cxhs" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2" selected="selected" data-select2-id="select2-data-15-rfw9">Owner</option>
																			<option value="3">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-14-hgii" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-u8vi-container" aria-controls="select2-u8vi-container"><span class="select2-selection__rendered" id="select2-u8vi-container" role="textbox" aria-readonly="true" title="Owner">Owner</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="1">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='1']" value="1">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<span class="symbol-label bg-light-danger text-danger fw-bold">M</span>
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Melody Macy</a>
																			<div class="fw-bold text-muted">melody@altbox.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-16-kmdm" tabindex="-1" aria-hidden="true">
																			<option value="1" selected="selected" data-select2-id="select2-data-18-rboa">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-17-58qq" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-8pxz-container" aria-controls="select2-8pxz-container"><span class="select2-selection__rendered" id="select2-8pxz-container" role="textbox" aria-readonly="true" title="Guest">Guest</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="2">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='2']" value="2">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<img alt="Pic" src="assets/media/avatars/150-26.jpg">
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Max Smith</a>
																			<div class="fw-bold text-muted">max@kt.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-19-hw8b" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3" selected="selected" data-select2-id="select2-data-21-x29i">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-20-i3bj" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-awv2-container" aria-controls="select2-awv2-container"><span class="select2-selection__rendered" id="select2-awv2-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="3">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='3']" value="3">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<img alt="Pic" src="assets/media/avatars/150-4.jpg">
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Sean Bean</a>
																			<div class="fw-bold text-muted">sean@dellito.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-22-mxl1" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2" selected="selected" data-select2-id="select2-data-24-st3j">Owner</option>
																			<option value="3">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-23-2j7x" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-3n7r-container" aria-controls="select2-3n7r-container"><span class="select2-selection__rendered" id="select2-3n7r-container" role="textbox" aria-readonly="true" title="Owner">Owner</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="4">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='4']" value="4">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<img alt="Pic" src="assets/media/avatars/150-15.jpg">
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Brian Cox</a>
																			<div class="fw-bold text-muted">brian@exchange.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-25-tlhw" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3" selected="selected" data-select2-id="select2-data-27-pnnf">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-26-92cj" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-b5ru-container" aria-controls="select2-b5ru-container"><span class="select2-selection__rendered" id="select2-b5ru-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="5">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='5']" value="5">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<span class="symbol-label bg-light-warning text-warning fw-bold">M</span>
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Mikaela Collins</a>
																			<div class="fw-bold text-muted">mikaela@pexcom.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-28-efj4" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2" selected="selected" data-select2-id="select2-data-30-6wjw">Owner</option>
																			<option value="3">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-29-tuqz" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-2ub0-container" aria-controls="select2-2ub0-container"><span class="select2-selection__rendered" id="select2-2ub0-container" role="textbox" aria-readonly="true" title="Owner">Owner</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="6">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='6']" value="6">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<img alt="Pic" src="assets/media/avatars/150-8.jpg">
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Francis Mitcham</a>
																			<div class="fw-bold text-muted">f.mitcham@kpmg.com.au</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-31-ehzq" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3" selected="selected" data-select2-id="select2-data-33-dvmc">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-32-lic5" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-n7un-container" aria-controls="select2-n7un-container"><span class="select2-selection__rendered" id="select2-n7un-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="7">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='7']" value="7">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<span class="symbol-label bg-light-danger text-danger fw-bold">O</span>
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Olivia Wild</a>
																			<div class="fw-bold text-muted">olivia@corpmail.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-34-6fq3" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2" selected="selected" data-select2-id="select2-data-36-qwb5">Owner</option>
																			<option value="3">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-35-gpqk" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ly0x-container" aria-controls="select2-ly0x-container"><span class="select2-selection__rendered" id="select2-ly0x-container" role="textbox" aria-readonly="true" title="Owner">Owner</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="8">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='8']" value="8">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<span class="symbol-label bg-light-primary text-primary fw-bold">N</span>
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Neil Owen</a>
																			<div class="fw-bold text-muted">owen.neil@gmail.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-37-jykk" tabindex="-1" aria-hidden="true">
																			<option value="1" selected="selected" data-select2-id="select2-data-39-edo5">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-38-l5cp" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-nxbl-container" aria-controls="select2-nxbl-container"><span class="select2-selection__rendered" id="select2-nxbl-container" role="textbox" aria-readonly="true" title="Guest">Guest</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="9">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='9']" value="9">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<img alt="Pic" src="assets/media/avatars/150-6.jpg">
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Dan Wilson</a>
																			<div class="fw-bold text-muted">dam@consilting.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-40-45h5" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3" selected="selected" data-select2-id="select2-data-42-p909">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-41-2rup" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ky5b-container" aria-controls="select2-ky5b-container"><span class="select2-selection__rendered" id="select2-ky5b-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="10">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='10']" value="10">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<span class="symbol-label bg-light-danger text-danger fw-bold">E</span>
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Emma Bold</a>
																			<div class="fw-bold text-muted">emma@intenso.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-43-6dhs" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2" selected="selected" data-select2-id="select2-data-45-6ld7">Owner</option>
																			<option value="3">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-44-0b2w" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-wvs9-container" aria-controls="select2-wvs9-container"><span class="select2-selection__rendered" id="select2-wvs9-container" role="textbox" aria-readonly="true" title="Owner">Owner</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="11">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='11']" value="11">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<img alt="Pic" src="assets/media/avatars/150-7.jpg">
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Ana Crown</a>
																			<div class="fw-bold text-muted">ana.cf@limtel.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-46-jnlj" tabindex="-1" aria-hidden="true">
																			<option value="1" selected="selected" data-select2-id="select2-data-48-43fo">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-47-2ie3" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ly9m-container" aria-controls="select2-ly9m-container"><span class="select2-selection__rendered" id="select2-ly9m-container" role="textbox" aria-readonly="true" title="Guest">Guest</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="12">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='12']" value="12">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<span class="symbol-label bg-light-info text-info fw-bold">A</span>
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Robert Doe</a>
																			<div class="fw-bold text-muted">robert@benko.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-49-rv9a" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3" selected="selected" data-select2-id="select2-data-51-avvh">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-50-x7cj" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-u46p-container" aria-controls="select2-u46p-container"><span class="select2-selection__rendered" id="select2-u46p-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="13">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='13']" value="13">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<img alt="Pic" src="assets/media/avatars/150-17.jpg">
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">John Miller</a>
																			<div class="fw-bold text-muted">miller@mapple.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-52-xjjs" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3" selected="selected" data-select2-id="select2-data-54-ggub">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-53-cgq7" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-rfg2-container" aria-controls="select2-rfg2-container"><span class="select2-selection__rendered" id="select2-rfg2-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="14">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='14']" value="14">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<span class="symbol-label bg-light-success text-success fw-bold">L</span>
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Lucy Kunic</a>
																			<div class="fw-bold text-muted">lucy.m@fentech.com</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-55-8wi3" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2" selected="selected" data-select2-id="select2-data-57-cbnx">Owner</option>
																			<option value="3">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-56-qq0a" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-u63f-container" aria-controls="select2-u63f-container"><span class="select2-selection__rendered" id="select2-u63f-container" role="textbox" aria-readonly="true" title="Owner">Owner</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="15">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='15']" value="15">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<img alt="Pic" src="assets/media/avatars/150-10.jpg">
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Ethan Wilder</a>
																			<div class="fw-bold text-muted">ethan@loop.com.au</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-58-cuxa" tabindex="-1" aria-hidden="true">
																			<option value="1" selected="selected" data-select2-id="select2-data-60-dn4m">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-59-n778" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-oviz-container" aria-controls="select2-oviz-container"><span class="select2-selection__rendered" id="select2-oviz-container" role="textbox" aria-readonly="true" title="Guest">Guest</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
																<!--begin::Separator-->
																<div class="border-bottom border-gray-300 border-bottom-dashed"></div>
																<!--end::Separator-->
																<!--begin::User-->
																<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="16">
																	<!--begin::Details-->
																	<div class="d-flex align-items-center">
																		<!--begin::Checkbox-->
																		<label class="form-check form-check-custom form-check-solid me-5">
																			<input class="form-check-input" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='16']" value="16">
																		</label>
																		<!--end::Checkbox-->
																		<!--begin::Avatar-->
																		<div class="symbol symbol-35px symbol-circle">
																			<img alt="Pic" src="assets/media/avatars/150-8.jpg">
																		</div>
																		<!--end::Avatar-->
																		<!--begin::Details-->
																		<div class="ms-5">
																			<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Francis Mitcham</a>
																			<div class="fw-bold text-muted">f.mitcham@kpmg.com.au</div>
																		</div>
																		<!--end::Details-->
																	</div>
																	<!--end::Details-->
																	<!--begin::Access menu-->
																	<div class="ms-2 w-100px">
																		<select class="form-select form-select-solid form-select-sm select2-hidden-accessible" data-control="select2" data-hide-search="true" data-select2-id="select2-data-61-pwus" tabindex="-1" aria-hidden="true">
																			<option value="1">Guest</option>
																			<option value="2">Owner</option>
																			<option value="3" selected="selected" data-select2-id="select2-data-63-s29j">Can Edit</option>
																		</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-62-u232" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-5vi9-container" aria-controls="select2-5vi9-container"><span class="select2-selection__rendered" id="select2-5vi9-container" role="textbox" aria-readonly="true" title="Can Edit">Can Edit</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
																	</div>
																	<!--end::Access menu-->
																</div>
																<!--end::User-->
															</div>
															<!--end::Users-->
															<!--begin::Actions-->
															<div class="d-flex flex-center mt-15">
																<button type="reset" id="kt_modal_users_search_reset" data-bs-dismiss="modal" class="btn btn-active-light me-3">Cancel</button>
																<button type="submit" id="kt_modal_users_search_submit" class="btn btn-primary">Add Selected Users</button>
															</div>
															<!--end::Actions-->
														</div>
														<!--end::Results-->
														<!--begin::Empty-->
														<div data-kt-search-element="empty" class="text-center d-none">
															<!--begin::Message-->
															<div class="fw-bold py-10">
																<div class="text-gray-600 fs-3 mb-2">No users found</div>
																<div class="text-muted fs-6">Try to search by username, full name or email...</div>
															</div>
															<!--end::Message-->
															<!--begin::Illustration-->
															<div class="text-center px-5">
																<img src="assets/media/illustrations/unitedpalms-1/1.png" alt="" class="w-100 h-200px h-sm-325px">
															</div>
															<!--end::Illustration-->
														</div>
														<!--end::Empty-->
													</div>
													<!--end::Wrapper-->
												</div>
												<!--end::Search-->
											</div>
											<!--end::Modal body-->
										</div>
										<!--end::Modal content-->
									</div>
									<!--end::Modal dialog-->
								</div>
								<!--end::Modal - Users Search-->
								<!--end::Modals-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>

@endsection('content')
