<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Email</title>

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
        <b>Verify</b> Email
    </div>

    <div class="card">

        <div class="card-body login-card-body">

            <p class="login-box-msg">
                Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you.
            </p>

            {{-- Success message --}}
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            {{-- Resend Form --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit" class="btn btn-primary btn-block">
                    Resend Verification Email
                </button>

            </form>

            <hr>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn btn-danger btn-block">
                    Logout
                </button>

            </form>

        </div>

    </div>

</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>