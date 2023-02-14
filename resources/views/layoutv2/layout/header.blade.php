<div id="header">
    <div class="hide-menu tw-ml-1"><i class="fa fa-align-left"></i></div>
    <nav>
        <div class="tw-flex tw-justify-between">
            <div class="tw-flex tw-flex-1 sm:tw-flex-initial">
                <div id="top_search"
                     class="tw-inline-flex tw-relative dropdown sm:tw-ml-1.5 sm:tw-mr-3 tw-max-w-xl tw-flex-auto"
                     data-toggle="tooltip" data-placement="bottom" data-title="">
                    <input type="search" id="search_input"
                           class="tw-px-4 tw-ml-1 tw-mt-2.5 focus:!tw-ring-0 tw-w-full !tw-placeholder-neutral-400 !tw-shadow-none tw-text-neutral-800 focus:!tw-placeholder-neutral-600 hover:!tw-placeholder-neutral-600 sm:tw-w-[400px] tw-h-[40px] tw-bg-neutral-300/30 hover:tw-bg-neutral-300/50 !tw-border-0"
                           placeholder="top_search_placeholder" autocomplete="off">
                    <div id="top_search_button" class="tw-absolute rtl:tw-left-0 -tw-mt-2 tw-top-1.5 ltr:tw-right-1">
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
                    <li class="icon tw-relative ltr:tw-mr-1.5 rtl:tw-ml-1.5" title="quick_create"
                        data-toggle="tooltip" data-placement="bottom">
                        <a href="#" class="!tw-px-0 tw-group !tw-text-white" data-toggle="dropdown">
                            <span
                                class="tw-rounded-full tw-bg-primary-600 tw-text-white tw-inline-flex tw-items-center tw-justify-center tw-h-7 tw-w-7 -tw-mt-1 group-hover:!tw-bg-primary-700">
                                <i class="fa-regular fa-plus fa-lg"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right animated fadeIn tw-text-base">
                            <li class="dropdown-header tw-mb-1">
                                quick_create
                            </li>
                            <li>
                                <a href="$url" $href_attributes
                                   class="tw-group tw-inline-flex tw-space-x-0.5 tw-text-neutral-700">
                                    icon
                                    <i
                                        class="icon tw-text-neutral-400 group-hover:tw-text-neutral-600 tw-h-5 tw-w-5"></i>

                                    <span>
                                        name
                                    </span>
                                </a>
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
                        <li class="header-my-profile"><a href="profile">
                                nav_my_profile
                            </a>
                        </li>
                        <li class="header-my-timesheets"><a href="timesheets">
                                my_timesheets
                            </a>
                        </li>
                        <li class="header-edit-profile"><a href="timesheets">
                                nav_edit_profile
                            </a>
                        </li>
                        <li class="header-logout">
                            <a href="#" onclick="logout(); return false;">
                                nav_logout
                            </a>
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

                <li class="icon header-user-profile" data-toggle="tooltip" title="get_staff_full_name"
                    data-placement="bottom">
                    <a href="#" class="dropdown-toggle profile tw-block rtl:!tw-px-0.5 !tw-py-1" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="" class="tw-ring-1 tw-ring-offset-2 tw-ring-primary-500 tw-mx-1 tw-mt-2.5"/></a>
                    <ul class="dropdown-menu animated fadeIn">
                        <li class="header-my-profile"><a
                                href="profile">nav_my_profile</a></li>
                        <li class="header-my-timesheets"><a
                                href="timesheets">my_timesheets</a>
                        </li>
                        <li class="header-edit-profile"><a
                                href="edit_profile">nav_edit_profile</a>
                        </li>

                        <li class="header-logout">
                            <a href="#" onclick="logout(); return false;">nav_logout</a>
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
                    admin/includes/notifications
                </li>
            </ul>
        </div>
    </nav>
</div>
