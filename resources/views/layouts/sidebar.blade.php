   <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/images/logo-hifpt1.png" alt="AdminLTE Logo" class="brand-image elevation-2">
            <span class="brand-text">Hi FPT</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div> --}}


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false" id="sidebar">
                    @if(!empty($groupModule))
                    @foreach($groupModule as $group)
                        @if(isset($group->children) && !empty($group->children))
                            @php
                                $uri = request()->segment(1);
                                $is_exist = array_keys(array_column($group->children, 'uri'), $uri);
                            @endphp
                           <li class="nav-item menu {{ !empty($is_exist) ? "menu-is-opening menu-open" :"" }} ">
                                <a href="#" class="nav-link {{ !empty($is_exist) ? 'active' : ''}}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        {{ $group->group_module_name}}
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: {{ !empty($is_exist) ? 'block' : 'none'}}">
                                @foreach($group->children as $module)
                                    @php
                                        $tmpUrl = $module->uri == "" ? "/" : $module->uri;
                                    @endphp
                                    <li class="nav-item">
                                        <a href="/{{ $module->uri }}" class="nav-link {{ (request()->is($tmpUrl) || request()->is($tmpUrl.'/*') ) ? 'active' : '' }}">
                                        <i class="nav-icon {{ $module->icon}}"></i>
                                        <p>{{ $module->module_name}}</p>
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                            </li>
                        @elseif(!isset($group->children))
                            <li class="nav-item">
                                @php
                                    $tmpUrl = $group->uri == "" ? "/" : $group->uri;
                                @endphp
                                <a href="/{{ $group->uri }}" class="nav-link {{ (request()->is($tmpUrl) || request()->is($tmpUrl.'/*') ) ? 'active' : '' }}">
                                <i class="nav-icon {{ $group->icon}}"></i>
                                <p>{{ $group->module_name}}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                    @endif
                </ul>
            </nav>
            
            <!-- /.sidebar-menu -->
        </div>
    </aside>