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

        <!-- Left Profile Card -->
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile text-center">

                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('images/user.png') }}"
                         alt="User profile picture">

                    <h3 class="profile-username">
                        {{ auth()->user()->name }}
                    </h3>

                    <p class="text-muted">
                        {{ auth()->user()->email }}
                    </p>

                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="col-md-9">

            <!-- Profile Info -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user mr-2"></i> Update Profile Information
                    </h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-lock mr-2"></i> Change Password
                    </h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete -->
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