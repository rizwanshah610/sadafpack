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

                <div class="row">
                    <!-- NAME -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Size Name <span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Small, Medium, Large">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- PRICE -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                Price
                                <small class="text-muted ml-1">
                                    (leave empty to use product price:
                                    <strong>PKR {{ number_format($product->price ?? 0, 2) }}</strong>)
                                </small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PKR</span>
                                </div>
                                <input type="number" step="0.01" min="0" name="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price') }}"
                                       placeholder="Leave empty to inherit product price">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DIMENSIONS -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Length</label>
                            <input type="number" step="0.01" name="length"
                                   class="form-control @error('length') is-invalid @enderror"
                                   value="{{ old('length') }}">
                            @error('length') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Width</label>
                            <input type="number" step="0.01" name="width"
                                   class="form-control @error('width') is-invalid @enderror"
                                   value="{{ old('width') }}">
                            @error('width') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Height</label>
                            <input type="number" step="0.01" name="height"
                                   class="form-control @error('height') is-invalid @enderror"
                                   value="{{ old('height') }}">
                            @error('height') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- NEW FIELDS ROW 1 -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sheet Size</label>
                            <input type="text" name="sheet_size"
                                   class="form-control @error('sheet_size') is-invalid @enderror"
                                   value="{{ old('sheet_size') }}"
                                   placeholder="e.g. 20x30">
                            @error('sheet_size') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" name="color"
                                   class="form-control @error('color') is-invalid @enderror"
                                   value="{{ old('color') }}"
                                   placeholder="e.g. Brown, White">
                            @error('color') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ply</label>
                            <input type="text" name="ply"
                                   class="form-control @error('ply') is-invalid @enderror"
                                   value="{{ old('ply') }}"
                                   placeholder="e.g. 3 Ply, 5 Ply">
                            @error('ply') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- NEW FIELDS ROW 2 -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Paper</label>
                            <input type="text" name="paper"
                                   class="form-control @error('paper') is-invalid @enderror"
                                   value="{{ old('paper') }}"
                                   placeholder="e.g. Kraft, Duplex">
                            @error('paper') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nali (Flute)</label>
                            <input type="text" name="nali"
                                   class="form-control @error('nali') is-invalid @enderror"
                                   value="{{ old('nali') }}"
                                   placeholder="e.g. A, B, E">
                            @error('nali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit</label>
                            <select name="unit" class="form-control @error('unit') is-invalid @enderror">
                                <option value="">-- Select Unit --</option>
                                <option value="cm"   {{ old('unit') == 'cm'   ? 'selected' : '' }}>cm</option>
                                <option value="mm"   {{ old('unit') == 'mm'   ? 'selected' : '' }}>mm</option>
                                <option value="inch" {{ old('unit') == 'inch' ? 'selected' : '' }}>inch</option>
                                <option value="m"    {{ old('unit') == 'm'    ? 'selected' : '' }}>m</option>
                            </select>
                            @error('unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- IMAGE -->
                <div class="form-group">
                    <label>Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image"
                                   class="custom-file-input @error('image') is-invalid @enderror"
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
        this.nextElementSibling.textContent = this.files[0]
            ? this.files[0].name
            : 'Choose image...';
    });
</script>
@endpush