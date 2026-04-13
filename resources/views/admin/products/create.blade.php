@extends('layouts.admin')
@section('title', 'Add Product')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Add Product</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-plus mr-2"></i> New Product</h3>
        </div>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label>Company <span class="text-danger">*</span></label>
                    <select name="company_id" class="form-control @error('company_id') is-invalid @enderror">
                        <option value="">-- Select Company --</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="Enter product name">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                              rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price"
                           class="form-control @error('price') is-invalid @enderror"
                           value="{{ old('price') }}" placeholder="0.00">
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror"
                                   id="imageInput" accept="image/*">
                            <label class="custom-file-label" for="imageInput">Choose image...</label>
                        </div>
                    </div>
                    @error('image') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i> Save Product
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary ml-2">
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
        this.nextElementSibling.textContent = this.files[0] ? this.files[0].name : 'Choose image...';
    });
</script>
@endpush