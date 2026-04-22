<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>

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
        <b>Forgot</b> Password
    </div>

    <div class="card">

        <div class="card-body login-card-body">

            <p class="login-box-msg">
                Enter your email and we will send you a password reset link.
            </p>

            {{-- Success Message --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           required
                           autofocus>

                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary btn-block">
                    Send Password Reset Link
                </button>

            </form>

            <p class="mt-3 mb-1 text-center">
                <a href="{{ route('login') }}">Back to Login</a>
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