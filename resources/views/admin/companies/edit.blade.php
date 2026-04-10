@extends('layouts.admin')
@section('title', 'Edit Company')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Edit Company</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-edit mr-2"></i> Edit: {{ $company->name }}</h3>
        </div>
        <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">

                <div class="form-group">
                    <label>Company Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $company->name) }}">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $company->email) }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone', $company->phone) }}">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                              rows="3">{{ old('address', $company->address) }}</textarea>
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Website</label>
                    <input type="url" name="website" class="form-control @error('website') is-invalid @enderror"
                           value="{{ old('website', $company->website) }}">
                    @error('website') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Logo</label>
                    @if($company->logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $company->logo) }}"
                                 width="80" height="80"
                                 style="border-radius:8px; object-fit:cover;">
                            <small class="text-muted ml-2">Current logo</small>
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror"
                                   id="logoInput" accept="image/*">
                            <label class="custom-file-label" for="logoInput">Choose new logo...</label>
                        </div>
                    </div>
                    @error('logo') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save mr-1"></i> Update Company
                </button>
                <a href="{{ route('companies.index') }}" class="btn btn-secondary ml-2">
                    <i class="fas fa-times mr-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelector('.custom-file-input').addEventListener('change', function () {
        const fileName = this.files[0] ? this.files[0].name : 'Choose new logo...';
        this.nextElementSibling.textContent = fileName;
    });
</script>
@endpush