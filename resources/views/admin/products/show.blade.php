@extends('layouts.admin')
@section('title', $product->name)
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">{{ $product->name }}</h1>
    </div>
</div>

<div class="container-fluid">

    {{-- Product Details --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-box mr-2"></i> Product Details</h3>
            <div class="card-tools">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary ml-1">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 text-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             width="100" height="100"
                             style="border-radius:8px; object-fit:cover;">
                    @else
                        <div style="width:100px; height:100px; border-radius:8px; background:#e9ecef;
                                    display:flex; align-items:center; justify-content:center; margin:auto;">
                            <i class="fas fa-box fa-2x text-secondary"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-10">
                    <table class="table table-bordered">
                        <tr><th width="150">Name</th><td>{{ $product->name }}</td></tr>
                        <tr><th>Company</th><td>{{ $product->company->name ?? '—' }}</td></tr>
                        <tr><th>Description</th><td>{{ $product->description ?? '—' }}</td></tr>
                        <tr><th>Price</th><td>{{ $product->price ? 'Rs' . number_format($product->price, 2) : '—' }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Sizes --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-ruler-combined mr-2"></i> Package Sizes</h3>
            <div class="card-tools">
                <a href="{{ route('products.sizes.create', $product->id) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-1"></i> Add Size
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>L × W × H</th>
                        <th>Weight</th>
                        <th>Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($product->packageSizes as $size)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $size->name }}</td>
                        <td>{{ $size->length }} × {{ $size->width }} × {{ $size->height }}</td>
                        <td>{{ $size->weight ?? '—' }}</td>
                        <td>{{ $size->unit ?? '—' }}</td>
                        <td>
                            <a href="{{ route('products.sizes.edit', [$product->id, $size->id]) }}"
                               class="btn btn-xs btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.sizes.destroy', [$product->id, $size->id]) }}"
                                  method="POST" style="display:inline;"
                                  onsubmit="return confirm('Delete this size?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">
                            <i class="fas fa-inbox mr-1"></i> No sizes added yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection