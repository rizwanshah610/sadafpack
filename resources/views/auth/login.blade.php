<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ setting('site_name', 'SadafPack') }} Login</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- AdminLTE --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

<div class="login-box">

    <div class="login-logo">
        @if(setting('site_logo'))
            <img src="{{ asset('storage/' . setting('site_logo')) }}"
                 alt="{{ setting('site_name', 'SadafPack') }}"
                 style="max-height: 60px; object-fit: contain; margin-bottom: 5px;">
            <br>
        @endif
        <b>{{ setting('site_name', 'SadafPack') }}</b>
    </div>

    <div class="card">
        <div class="card-body login-card-body">

            <p class="login-box-msg">Sign in to start your session</p>

            {{-- Session Status --}}
            @if(session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="input-group mb-3">
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email"
                           value="{{ old('email') }}"
                           required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                {{-- Password --}}
                <div class="input-group mb-3">
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                {{-- Remember + Submit --}}
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            Sign In
                        </button>
                    </div>
                </div>

            </form>

            @if(Route::has('password.request'))
                <p class="mb-0 text-center mt-3">
                    <a href="{{ route('password.request') }}">
                        <i class="fas fa-key mr-1"></i> Forgot your password?
                    </a>
                </p>
            @endif

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>