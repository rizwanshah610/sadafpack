<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <!-- Current Password -->
    <div class="form-group">
        <label>Current Password</label>
        <input type="password"
               name="current_password"
               class="form-control"
               required>
    </div>

    <!-- New Password -->
    <div class="form-group">
        <label>New Password</label>
        <input type="password"
               name="password"
               class="form-control"
               required>
    </div>

    <!-- Confirm Password -->
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password"
               name="password_confirmation"
               class="form-control"
               required>
    </div>

    @if (session('status') === 'password-updated')
        <div class="alert alert-success">
            Password updated successfully.
        </div>
    @endif

    <button type="submit" class="btn btn-warning">
        Update Password
    </button>
</form>