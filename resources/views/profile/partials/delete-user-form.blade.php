<form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('DELETE')

    <div class="alert alert-danger">
        <strong>Warning:</strong> Once deleted, your account cannot be recovered.
    </div>

    <!-- Password Confirmation -->
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password"
               name="password"
               class="form-control"
               required>
    </div>

    <button type="submit" class="btn btn-danger"
            onclick="return confirm('Are you sure you want to delete your account?')">
        Delete Account
    </button>
</form>