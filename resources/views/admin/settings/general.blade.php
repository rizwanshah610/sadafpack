@extends('layouts.admin')
@section('title', 'General Settings')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">General Settings</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-cog mr-2"></i> Site Settings
            </h3>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                {{-- Site Name --}}
                <div class="form-group">
                    <label><i class="fas fa-heading mr-1"></i> Site Name</label>
                    <input type="text" name="site_name"
                           value="{{ old('site_name', $settings['site_name']) }}"
                           class="form-control" required>
                </div>

                {{-- Site Logo --}}
                <div class="form-group">
                    <label><i class="fas fa-image mr-1"></i> Site Logo</label>
                    <div class="mb-2">
                        @if($settings['site_logo'])
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}"
                                 alt="Current Logo" height="60"
                                 style="border:1px solid #ddd; padding:5px; border-radius:5px;">
                            <small class="text-muted d-block mt-1">Current logo</small>
                        @else
                            <span class="text-muted">No logo uploaded yet.</span>
                        @endif
                    </div>
                    <input type="file" name="site_logo" class="form-control-file">
                    <small class="text-muted">Accepted: JPG, PNG, SVG. Max 2MB.</small>
                </div>

                {{-- Site Email --}}
                <div class="form-group">
                    <label><i class="fas fa-envelope mr-1"></i> Site Email</label>
                    <input type="email" name="site_email"
                           value="{{ old('site_email', $settings['site_email']) }}"
                           class="form-control" placeholder="contact@example.com">
                </div>

                {{-- Site Phone --}}
                <div class="form-group">
                    <label><i class="fas fa-phone mr-1"></i> Site Phone</label>
                    <input type="text" name="site_phone"
                           value="{{ old('site_phone', $settings['site_phone']) }}"
                           class="form-control" placeholder="+92 300 0000000">
                </div>

                {{-- Site Address --}}
                <div class="form-group">
                    <label><i class="fas fa-map-marker-alt mr-1"></i> Site Address</label>
                    <textarea name="site_address" class="form-control" rows="3"
                              placeholder="Full address...">{{ old('site_address', $settings['site_address']) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i> Save Settings
                </button>
            </form>
        </div>
    </div>
</div>
@endsection