<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- Brand Logo --}}
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        @if(setting('site_logo'))
            <img src="{{ asset('storage/' . setting('site_logo')) }}"
                 alt="Logo" class="brand-image img-circle elevation-3" style="opacity:.8">
        @endif
        <span class="brand-text font-weight-light">
            {{ setting('site_name', 'SadafPack Admin') }}
        </span>
    </a>

    <div class="sidebar">

        

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                {{-- 1. Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- 2. Companies — super_admin and admin --}}
                @role('super_admin|admin')
                <li class="nav-item">
                    <a href="{{ route('companies.index') }}"
                       class="nav-link {{ request()->is('admin/companies*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Companies</p>
                    </a>
                </li>
                @endrole

                {{-- 3. Products — super_admin and admin --}}
                @role('super_admin|admin')
                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                       class="nav-link {{ request()->is('admin/products*') && !request()->is('admin/products/*/sizes*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Products</p>
                    </a>
                </li>
                @endrole


                {{-- 5. Staff Management — super_admin only --}}
                @role('super_admin')
                <li class="nav-item">
                    <a href="{{ route('staff.index') }}"
                       class="nav-link {{ request()->is('admin/staff*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Staff Management</p>
                    </a>
                </li>
                @endrole

                {{-- 6. Settings — super_admin only --}}
                @role('super_admin')
                <li class="nav-item">
                    <a href="{{ route('admin.settings.general') }}"
                       class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
                @endrole

            </ul>
        </nav>
    </div>
</aside>