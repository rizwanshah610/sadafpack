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

                <div class="form-group">
                    <label>Size Name <span class="text-danger">*</span></label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $size->name) }}"
                           placeholder="e.g. Small, Medium, Large">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

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
                        style="top: -10px; right: -10px; border-radius: 50%;"
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

                <a href="{{ route('products.sizes.index', $product->id) }}"
                   class="btn btn-secondary ml-2">
                    <i class="fas fa-times mr-1"></i> Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    /**
     * Handles marking the image for deletion
     */
    function markImageForRemoval() {
        if (confirm('Are you sure you want to remove this image?')) {
            // Set hidden input value to 1 (True)
            document.getElementById('removeImageInput').value = '1';
            
            // Visual feedback: Dim the image and turn it grayscale
            const previewImg = document.getElementById('previewImg');
            if (previewImg) {
                previewImg.style.opacity = '0.2';
                previewImg.style.filter = 'grayscale(100%)';
            }
            
            // Show the "will be removed" info text
            const removalText = document.getElementById('removalText');
            if (removalText) {
                removalText.style.display = 'block';
            }
        }
    }

    /**
     * Combined File Input Listener
     */
    document.querySelector('.custom-file-input').addEventListener('change', function () {
        // 1. Show the selected file name in the label
        let fileName = this.files[0] ? this.files[0].name : 'Choose new image...';
        this.nextElementSibling.textContent = fileName;

        // 2. If user picks a NEW file, we cancel any "Removal" request
        const removeInput = document.getElementById('removeImageInput');
        const removalText = document.getElementById('removalText');
        const previewImg = document.getElementById('previewImg');

        if (removeInput) removeInput.value = '0';
        if (removalText) removalText.style.display = 'none';
        if (previewImg) {
            previewImg.style.opacity = '1';
            previewImg.style.filter = 'none';
        }
    });
</script>
@endpush

