<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{ asset('backend') }}/assets/images/icon/logo.png" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    {{-- dashboard --}}
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>
                            Dashboard
                        </span></a>
                        <ul class="collapse @yield('dashboard')">
                            <li class="@yield('dash-page')"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>
                    {{-- Roles & Permission start --}}
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                                Roles & Permission
                            </span></a>
                        <ul class="collapse @yield('role')">
                            <li class="@yield('all-role')"><a href="{{ route('admin.roles.index') }}">All Role</a></li>
                            <li class="@yield('create-role')"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                        </ul>
                    </li>
                    {{-- users --}}
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                                Users
                            </span></a>
                        <ul class="collapse @yield('user')">
                            <li class="@yield('all-user')"><a href="{{ route('admin.users.index') }}">All User</a></li>
                            <li class="@yield('create-user')"><a href="{{ route('admin.users.create') }}">Create User</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </nav>
        </div>
    </div>
</div>