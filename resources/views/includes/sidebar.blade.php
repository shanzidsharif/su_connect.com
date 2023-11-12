<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">SU_Connect</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('public/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                @if(Auth::user()->user_type == 1)
                    <li class="nav-item">
                        <a href="{{ url('/admin/dashboard') }}" class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/list') }}" class="nav-link {{ Request::is('admin/list*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Admin
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/class/list') }}" class="nav-link {{ Request::is('admin/class/list*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Class
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/subject/list') }}" class="nav-link {{ Request::is('admin/subject/list*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Subject
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/subject-assign/list') }}" class="nav-link {{ Request::is('admin/subject-assign/list*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Assign Subject
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" onclick="return confirm('Do You want to Logout!')" class="nav-link">
                            <i class="fa fa-sign-out text-"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>

                @elseif(Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <a href="{{ url('/lecturer/dashboard') }}" class="nav-link {{ Request::is('lecturer/dashboard*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="fa fa-sign-out text-"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>

                @elseif(Auth::user()->user_type == 3)
                    <li class="nav-item">
                        <a href="{{ url('/student/dashboard') }}" class="nav-link {{ Request::is('student/dashboard*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="fa fa-sign-out text-"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
