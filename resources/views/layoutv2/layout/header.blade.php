<div id="header">
    <div class="hide-menu tw-ml-1"><i class="fa fa-align-left"></i></div>
    <nav>
        <div class="tw-flex tw-justify-between">
            <div class="tw-flex tw-flex-1 sm:tw-flex-initial">
                <div id="top_search"
                     class="tw-inline-flex tw-relative dropdown sm:tw-ml-1.5 sm:tw-mr-3 tw-max-w-xl tw-flex-auto"
                     data-toggle="tooltip" data-placement="bottom" data-title="Tìm kiếm theo thẻ">
                    <input type="search" id="search_input"
                           class="tw-px-4 tw-ml-1 tw-mt-2.5 focus:!tw-ring-0 tw-w-full !tw-placeholder-neutral-400 !tw-shadow-none tw-text-neutral-800 focus:!tw-placeholder-neutral-600 hover:!tw-placeholder-neutral-600 sm:tw-w-[400px] tw-h-[40px] tw-bg-neutral-300/30 hover:tw-bg-neutral-300/50 !tw-border-0"
                           placeholder="Tìm kiếm" autocomplete="off">
                    <div id="top_search_button" class="tw-absolute rtl:tw-left-0 -tw-mt-2 tw-top-1.5 tw-right-1">
                        <button class="tw-outline-none tw-border-0 tw-text-neutral-600">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div id="search_results">
                    </div>
                    <ul class="dropdown-menu search-results animated fadeIn search-history" id="search-history">
                    </ul>

                </div>
                <ul class="nav navbar-nav visible-md visible-lg">
                    <li class="icon tw-relative ltr:tw-mr-1.5 rtl:tw-ml-1.5" title="Tạo mới nhanh"
                        data-toggle="tooltip" data-placement="bottom">
                        <a href="#" class="!tw-px-0 tw-group !tw-text-white" data-toggle="dropdown">
                            <span
                                class="tw-rounded-full tw-bg-primary-600 tw-text-white tw-inline-flex tw-items-center tw-justify-center tw-h-7 tw-w-7 -tw-mt-1 group-hover:!tw-bg-primary-700">
                                <i class="fa-regular fa-plus fa-lg"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right animated fadeIn tw-text-base">
                            <li class="dropdown-header tw-mb-1">
                                <a href="/bannermanage">Chức năng chưa hỗ trợ</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="mobile-menu tw-shrink-0 ltr:tw-ml-4 rtl:tw-mr-4">
                <button type="button"
                        class="navbar-toggle visible-md visible-sm visible-xs mobile-menu-toggle collapsed tw-ml-1.5"
                        data-toggle="collapse" data-target="#mobile-collapse" aria-expanded="false">
                    <i class="fa fa-chevron-down fa-lg"></i>
                </button>
                <ul class="mobile-icon-menu tw-inline-flex tw-mt-5">
                </ul>
                <div class="mobile-navbar collapse" id="mobile-collapse" aria-expanded="false" style="height: 0px;"
                     role="navigation">
                    <ul class="nav navbar-nav">
                        <li class="header-my-profile">
                            <a href="#" data-toggle="modal" data-target="#TemplateModal"><i class="fas fa-user"></i>&nbsp;Profile</a>
                        </li>
                        <li class="header-logout">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="icon header-todo">
                    <a href="todo" data-toggle="tooltip"
                       title="nav_todo_items" data-placement="bottom" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="tw-w-5 tw-h-5 tw-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                        <span
                            class="tw-leading-none tw-px-1 tw-py-0.5 tw-text-xs bg-warning tw-z-10 tw-absolute tw-rounded-full tw-right-1 tw-top-2.5 tw-min-w-[18px] tw-min-h-[18px] tw-inline-flex tw-items-center tw-justify-center nav-total-todos hide">
                            total_unfinished_todos
                        </span>
                    </a>
                </li>

                <li class="icon header-user-profile" data-toggle="tooltip" title="{{ Auth::user()->name}}"
                    data-placement="bottom">
                    <a href="#" class="dropdown-toggle profile tw-block rtl:!tw-px-0.5 !tw-py-1" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{ asset('assets/images/user-placeholder.jpg') }}"
                             class="img img-responsive staff-profile-image-small tw-ring-1 tw-ring-offset-2 tw-ring-primary-500 tw-mx-1 tw-mt-2.5"
                             alt=""/></a>
                    <ul class="dropdown-menu animated fadeIn">
                        <li class="header-my-profile">
                            <a href="#" data-toggle="modal" data-target="#TemplateModal">Profile</a>
                        </li>
                        <li class="header-logout">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>

                <li class="icon header-timers timer-button tw-relative ltr:tw-mr-1.5 rtl:tw-ml-1.5"
                    data-placement="bottom" data-toggle="tooltip" data-title="my_timesheets">
                    <a href="#" id="top-timers" class="top-timers !tw-px-0 tw-group" data-toggle="dropdown">
                        <span
                            class="tw-rounded-md tw-border tw-border-solid tw-border-neutral-200/60 tw-inline-flex tw-items-center tw-justify-center tw-h-8 tw-w-9 -tw-mt-1.5 group-hover:!tw-bg-neutral-100/60">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor"
                                 class="tw-w-5 tw-h-5 tw-text-neutral-900 tw-shrink-0 tw-animate-spin-slow">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                        <span
                            class="tw-leading-none tw-px-1 tw-py-0.5 tw-text-xs bg-success tw-z-10 tw-absolute tw-rounded-full -tw-right-1.5 tw-top-2 tw-min-w-[18px] tw-min-h-[18px] tw-inline-flex tw-items-center tw-justify-center icon-started-timers hide">
                            $startedTimers
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeIn started-timers-top width300" id="started-timers-top">
                    </ul>
                </li>

                <li class="icon dropdown tw-relative tw-block notifications-wrapper header-notifications rtl:tw-ml-3"
                    data-toggle="tooltip" title="nav_notifications" data-placement="bottom">
                    <a href="#" class="dropdown-toggle notifications-icon !tw-px-0 tw-group" data-toggle="dropdown"
                       aria-expanded="false">
    <span
        class="sm:tw-rounded-md sm:tw-border sm:tw-border-solid sm:tw-border-neutral-200/60 sm:tw-inline-flex sm:tw-items-center sm:tw-justify-center sm:tw-h-8 sm:tw-w-9 sm:-tw-mt-1.5 sm:group-hover:!tw-bg-neutral-100/60">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="tw-shrink-0 tw-text-neutral-900 tw-w-5 tw-h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
        </svg>
        <span
            class="tw-leading-none tw-px-1 tw-py-0.5 tw-text-xs bg-warning tw-z-10 tw-absolute tw-rounded-full -tw-right-1.5 -tw-top-2 sm:tw-top-2 tw-min-w-[18px] tw-min-h-[18px] tw-inline-flex tw-items-center tw-justify-center icon-notifications">4</span>
    </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="modal fade" id="TemplateModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Profile</h4>
            </div>
            <div class="modal-body">
                <form action="/profile/updateprofile" method="POST" onsubmit="handleSubmit(event,this)">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ol-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group"><label
                                        for="name">Role: </label><b>&nbsp;{{ !empty(Auth::user()->role) ? Auth::user()->role->role_name: ''}}</b>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group"><label for="name">Full Name</label> <input type="text"
                                                                                                   class="form-control"
                                                                                                   id="name" name="name"
                                                                                                   value="{{Auth::user()->name}}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group"><label for="eMail">Email</label> <input class="form-control"
                                                                                                value="{{Auth::user()->email}}"
                                                                                                disabled></div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group"><label for="phone">Phone</label> <input type="text"
                                                                                                class="form-control"
                                                                                                id="phone"
                                                                                                placeholder="Enter phone number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
