<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Admin Panel</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- AdminLTE --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">

<div class="register-box">

    <div class="register-logo">
        <b>Admin</b> Panel
    </div>

    <div class="card">

        <div class="card-body register-card-body">

            <p class="login-box-msg">Register a new membership</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="form-group">
                    <label>Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label>Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           required>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary btn-block">
                    Register
                </button>

            </form>

            <p class="mt-3 mb-1 text-center">
                <a href="{{ route('login') }}">I already have a membership</a>
            </p>

        </div>

    </div>

</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>