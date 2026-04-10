<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">SadafPack Admin</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
                <li class="nav-item">
                    <a href="{{ url('/admin/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/companies') }}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Companies</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/companies/products') }}" class="nav-link">
                        <i class="nav-icon fas fa-box   "></i>
                        <p>Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/companies/sizes') }}" class="nav-link">
                        <i class="nav-icon fas fa-ruler-combined"></i>
                        <p>Sizes</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>