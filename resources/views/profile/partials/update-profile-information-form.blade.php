<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name"
               value="{{ old('name', auth()->user()->name) }}"
               class="form-control">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email"
               value="{{ old('email', auth()->user()->email) }}"
               class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        Update Profile
    </button>
</form>