@extends('layouts.admin')

@section('title', 'Profile')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Profile</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="row">

        {{-- Left Profile Card --}}
        <div class="col-md-3">

            {{-- Profile Info Card --}}
            <div class="card card-primary card-outline">
                <div class="card-body box-profile text-center">

                    {{-- Avatar --}}
                    @if(auth()->user()->avatar)
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('storage/' . auth()->user()->avatar) }}"
                             alt="Profile Picture"
                             style="width:100px; height:100px; object-fit:cover;">
                    @else
                        <span class="d-flex align-items-center justify-content-center bg-primary text-white img-circle mx-auto"
                              style="width:100px; height:100px; font-size:40px; font-weight:bold; border-radius:50%;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    @endif

                    <h3 class="profile-username mt-2">
                        {{ auth()->user()->name }}
                    </h3>

                    <p class="text-muted mb-1">{{ auth()->user()->email }}</p>

                    <span class="badge
                        @role('super_admin') badge-danger
                        @elserole('admin') badge-primary
                        @else badge-secondary
                        @endrole">
                        {{ ucfirst(str_replace('_', ' ', auth()->user()->getRoleNames()->first() ?? 'No Role')) }}
                    </span>

                </div>
            </div>

            {{-- Avatar Upload Card --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-camera mr-2"></i> Update Photo
                    </h3>
                </div>
                <div class="card-body">

                    @if(session('avatar_success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle mr-1"></i> {{ session('avatar_success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Choose Photo</label>
                            <input type="file" name="avatar"
                                   class="form-control-file @error('avatar') is-invalid @enderror"
                                   accept="image/*">
                            @error('avatar')
                                <span class="text-danger d-block">{{ $message }}</span>
                            @enderror
                            <small class="text-muted">JPG, PNG. Max 2MB.</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-upload mr-1"></i> Upload Photo
                        </button>

                    </form>

                    {{-- Remove Avatar --}}
                    @if(auth()->user()->avatar)
                        <form action="{{ route('profile.avatar.remove') }}" method="POST" class="mt-2"
                              onsubmit="return confirm('Remove profile photo?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-block">
                                <i class="fas fa-trash mr-1"></i> Remove Photo
                            </button>
                        </form>
                    @endif

                </div>
            </div>

        </div>

        {{-- Right Side --}}
        <div class="col-md-9">

            {{-- Profile Info --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user mr-2"></i> Update Profile Information
                    </h3>
                </div>
                <div class="card-body">
                    @if(session('status') === 'profile-updated')
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle mr-1"></i> Profile updated successfully.
                        </div>
                    @endif
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Password --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-lock mr-2"></i> Change Password
                    </h3>
                </div>
                <div class="card-body">
                    @if(session('status') === 'password-updated')
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle mr-1"></i> Password updated successfully.
                        </div>
                    @endif
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-trash mr-2"></i> Delete Account
                    </h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>

@endsection