<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- Brand Logo --}}
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset(setting('site_logo', 'admin/img/AdminLTELogo.png')) }}"
             alt="Logo" class="brand-image img-circle elevation-3" style="opacity:.8">
        <span class="brand-text font-weight-light">
            {{ setting('site_name', 'SadafPack Admin') }}
        </span>
    </a>

    <div class="sidebar">

        {{-- User Panel --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/img/user.png') }}" class="img-circle elevation-2" alt="User">
            </div>
            <div class="info">
                <a href="{{ route('profile.edit') }}" class="d-block">
                    {{ Auth::user()->name }}
                </a>
                <span class="badge badge-sm
                    @role('super_admin') badge-danger
                    @elserole('admin') badge-primary
                    @else badge-secondary
                    @endrole" style="font-size:10px;">
                    {{ ucfirst(str_replace('_', ' ', Auth::user()->getRoleNames()->first() ?? 'No Role')) }}
                </span>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Companies — super_admin and admin --}}
                @role('super_admin|admin')
                <li class="nav-item">
                    <a href="{{ route('companies.index') }}"
                       class="nav-link {{ request()->is('admin/companies*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Companies</p>
                    </a>
                </li>
                @endrole

                {{-- Products & Package Sizes — super_admin and admin --}}
                @role('super_admin|admin')
                <li class="nav-item {{ request()->is('admin/products*') ? 'menu-open' : '' }}">
                    <a href="#"
                       class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}"
                               class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.create') }}"
                               class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

                {{-- Staff Management — super_admin only --}}
                @role('super_admin')
                <li class="nav-item">
                    <a href="{{ route('staff.index') }}"
                       class="nav-link {{ request()->is('admin/staff*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Staff Management</p>
                    </a>
                </li>
                @endrole

                {{-- Divider --}}
                <li class="nav-header">ACCOUNT</li>

                {{-- Profile --}}
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}"
                       class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>

                {{-- Settings — super_admin only --}}
                @role('super_admin')
                <li class="nav-header">SETTINGS</li>
                <li class="nav-item {{ request()->is('admin/settings*') ? 'menu-open' : '' }}">
                    <a href="#"
                       class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.general') }}"
                               class="nav-link {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General (Logo, Name)</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

                {{-- Logout --}}
                <li class="nav-header">SESSION</li>
                <li class="nav-item">
                    <a href="#" class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>