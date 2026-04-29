<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- AdminLTE CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('layouts.partials.navbar')
    @include('layouts.partials.sidebar')

    <div class="content-wrapper">
        <div class="content p-3">
            @yield('content')
        </div>
    </div>

    <footer class="main-footer">
        <strong>© {{ date('Y') }} SadafPack</strong>
    </footer>

</div>

{{-- jQuery FIRST --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
{{-- AdminLTE JS --}}
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- Sweet Alert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}"
        });
    @endif

    @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: "{{ session('warning') }}"
        });
    @endif

    @if(session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Info',
            text: "{{ session('info') }}"
        });
    @endif

});
</script>


<!-- Delete Sweet Alert Code -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            let form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

});
</script>
@stack('scripts')
</body>
</html>