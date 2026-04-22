<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Password</title>

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
        <b>Confirm</b> Password
    </div>

    <div class="card">

        <div class="card-body login-card-body">

            <p class="login-box-msg">
                This is a secure area of the application. Please confirm your password before continuing.
            </p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                {{-- Password --}}
                <div class="form-group">
                    <label>Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required
                           autocomplete="current-password">

                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary btn-block">
                    Confirm Password
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