@extends('layouts.admin')
@section('title', 'Add Size')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Add Size — {{ $product->name }}</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-plus mr-2"></i> New Size</h3>
        </div>
        <form action="{{ route('products.sizes.store', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label>Size Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="e.g. Small, Medium, Large">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Length</label>
                            <input type="number" step="0.01" name="length"
                                   class="form-control @error('length') is-invalid @enderror"
                                   value="{{ old('length') }}" placeholder="0">
                            @error('length') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Width</label>
                            <input type="number" step="0.01" name="width"
                                   class="form-control @error('width') is-invalid @enderror"
                                   value="{{ old('width') }}" placeholder="0">
                            @error('width') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Height</label>
                            <input type="number" step="0.01" name="height"
                                   class="form-control @error('height') is-invalid @enderror"
                                   value="{{ old('height') }}" placeholder="0">
                            @error('height') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="number" step="0.01" name="weight"
                                   class="form-control @error('weight') is-invalid @enderror"
                                   value="{{ old('weight') }}" placeholder="0">
                            @error('weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Unit</label>
                            <select name="unit" class="form-control @error('unit') is-invalid @enderror">
                                <option value="">-- Select Unit --</option>
                                <option value="cm" {{ old('unit') == 'cm' ? 'selected' : '' }}>cm</option>
                                <option value="mm" {{ old('unit') == 'mm' ? 'selected' : '' }}>mm</option>
                                <option value="inch" {{ old('unit') == 'inch' ? 'selected' : '' }}>inch</option>
                                <option value="m" {{ old('unit') == 'm' ? 'selected' : '' }}>m</option>
                            </select>
                            @error('unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
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
                    <i class="fas fa-save mr-1"></i> Save Size
                </button>
                <a href="{{ route('products.sizes.index', $product->id) }}" class="btn btn-secondary ml-2">
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