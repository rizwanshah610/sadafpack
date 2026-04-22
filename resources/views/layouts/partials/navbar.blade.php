<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    {{-- Left: Sidebar Toggle --}}
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    {{-- Right: User Dropdown --}}
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
               id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                {{-- User Avatar --}}
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                         alt="{{ Auth::user()->name }}"
                         class="img-circle elevation-2 mr-2"
                         style="width:32px; height:32px; object-fit:cover;">
                @else
                    <span class="img-circle elevation-2 mr-2 d-flex align-items-center justify-content-center bg-primary text-white"
                          style="width:32px; height:32px; font-size:14px; font-weight:bold; border-radius:50%;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                @endif

                {{-- User Name + Role --}}
<span class="d-none d-sm-inline text-left" style="line-height:1.2;">
    <span class="d-block">{{ Auth::user()->name }}</span>
    <small class="badge badge-sm
        @role('super_admin') badge-danger
        @elserole('admin') badge-primary
        @else badge-secondary
        @endrole" style="font-size:9px;">
        {{ ucfirst(str_replace('_', ' ', Auth::user()->getRoleNames()->first() ?? '')) }}
    </small>
</span>
            </a>

            {{-- Dropdown Menu --}}
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                <div class="dropdown-item-text">
                    <div class="d-flex align-items-center">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                 class="img-circle mr-2"
                                 style="width:40px; height:40px; object-fit:cover;">
                        @else
                            <span class="img-circle mr-2 d-flex align-items-center justify-content-center bg-primary text-white"
                                  style="width:40px; height:40px; font-size:16px; font-weight:bold; border-radius:50%;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        @endif
                        <div>
                            <strong>{{ Auth::user()->name }}</strong>
                            <div class="text-muted" style="font-size:11px;">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item text-danger" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>

            </div>
        </li>
    </ul>

</nav>