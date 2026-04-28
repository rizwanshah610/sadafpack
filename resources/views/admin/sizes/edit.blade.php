@extends('layouts.admin')
@section('title', 'Edit Size')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Edit Size — {{ $product->name }}</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-edit mr-2"></i> Edit Size: {{ $size->name }}</h3>
        </div>

        <form action="{{ route('products.sizes.update', [$product->id, $size->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="row">
                    <!-- NAME -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Size Name <span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $size->name) }}"
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
                                       value="{{ old('price', $size->price) }}"
                                       placeholder="Leave empty to inherit product price">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @if(!is_null($size->price))
                                <small class="text-success">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Currently using size-specific price: PKR {{ number_format($size->price, 2) }}
                                </small>
                            @else
                                <small class="text-secondary">
                                    <i class="fas fa-link mr-1"></i>
                                    Currently inheriting product price: PKR {{ number_format($product->price ?? 0, 2) }}
                                </small>
                            @endif
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
                                   value="{{ old('length', $size->length) }}">
                            @error('length') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Width</label>
                            <input type="number" step="0.01" name="width"
                                   class="form-control @error('width') is-invalid @enderror"
                                   value="{{ old('width', $size->width) }}">
                            @error('width') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Height</label>
                            <input type="number" step="0.01" name="height"
                                   class="form-control @error('height') is-invalid @enderror"
                                   value="{{ old('height', $size->height) }}">
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
                                   value="{{ old('sheet_size', $size->sheet_size) }}"
                                   placeholder="e.g. 20x30">
                            @error('sheet_size') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" name="color"
                                   class="form-control @error('color') is-invalid @enderror"
                                   value="{{ old('color', $size->color) }}"
                                   placeholder="e.g. Brown, White">
                            @error('color') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ply</label>
                            <input type="text" name="ply"
                                   class="form-control @error('ply') is-invalid @enderror"
                                   value="{{ old('ply', $size->ply) }}"
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
                                   value="{{ old('paper', $size->paper) }}"
                                   placeholder="e.g. Kraft, Duplex">
                            @error('paper') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nali (Flute)</label>
                            <input type="text" name="nali"
                                   class="form-control @error('nali') is-invalid @enderror"
                                   value="{{ old('nali', $size->nali) }}"
                                   placeholder="e.g. A, B, E">
                            @error('nali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit</label>
                            <select name="unit" class="form-control @error('unit') is-invalid @enderror">
                                <option value="">-- Select Unit --</option>
                                @foreach(['cm', 'mm', 'inch', 'm'] as $u)
                                    <option value="{{ $u }}" {{ old('unit', $size->unit) == $u ? 'selected' : '' }}>{{ $u }}</option>
                                @endforeach
                            </select>
                            @error('unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- IMAGE -->
                <div class="form-group">
                    <label>Image</label>
                    <input type="hidden" name="remove_image" id="removeImageInput" value="0">

                    @if($size->image)
                        <div class="mb-3" id="currentImageContainer">
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset('storage/' . $size->image) }}"
                                     id="previewImg"
                                     width="100" height="100"
                                     style="border-radius:8px; object-fit:cover; border: 2px solid #ddd;">
                                <button type="button"
                                        class="btn btn-danger btn-sm position-absolute"
                                        style="top:-10px; right:-10px; border-radius:50%;"
                                        onclick="markImageForRemoval()"
                                        title="Remove current image">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <p class="text-danger small mt-1 mb-0" id="removalText" style="display:none;">
                                <i class="fas fa-info-circle"></i> Image will be removed on update.
                            </p>
                        </div>
                    @else
                        <div class="mb-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($size->name) }}&background=6c757d&color=fff"
                                 width="80" height="80"
                                 style="border-radius:8px;">
                        </div>
                    @endif

                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image"
                                   class="custom-file-input @error('image') is-invalid @enderror"
                                   id="imageInput" accept="image/*">
                            <label class="custom-file-label" for="imageInput">Choose new image...</label>
                        </div>
                    </div>
                    @error('image') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save mr-1"></i> Update Size
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
    function markImageForRemoval() {
        if (confirm('Are you sure you want to remove this image?')) {
            document.getElementById('removeImageInput').value = '1';
            const previewImg = document.getElementById('previewImg');
            if (previewImg) {
                previewImg.style.opacity = '0.2';
                previewImg.style.filter = 'grayscale(100%)';
            }
            const removalText = document.getElementById('removalText');
            if (removalText) removalText.style.display = 'block';
        }
    }

    document.querySelector('.custom-file-input').addEventListener('change', function () {
        this.nextElementSibling.textContent = this.files[0] ? this.files[0].name : 'Choose new image...';
        const removeInput = document.getElementById('removeImageInput');
        const removalText = document.getElementById('removalText');
        const previewImg  = document.getElementById('previewImg');
        if (removeInput) removeInput.value = '0';
        if (removalText) removalText.style.display = 'none';
        if (previewImg) {
            previewImg.style.opacity = '1';
            previewImg.style.filter = 'none';
        }
    });
</script>
@endpush