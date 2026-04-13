@extends('layouts.admin')
@section('title', 'Products')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Products</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-box mr-2"></i> All Products</h3>
            <div class="card-tools">
                <a href="{{ route('products.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-1"></i> Add Product
                </a>
            </div>
        </div>
        <div class="card-body p-0">

            @if(session('success'))
                <div class="alert alert-success m-3">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                </div>
            @endif

            <table class="table table-striped table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Price</th>
                        <th>Sizes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     width="40" height="40"
                                     style="border-radius:8px; object-fit:cover;">
                            @else
                                <span class="badge badge-secondary">
                                    <i class="fas fa-box"></i>
                                </span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>
                            <span class="badge badge-info">
                                {{ $product->company->name ?? '—' }}
                            </span>
                        </td>
                        <td>{{ $product->price ? '$' . number_format($product->price, 2) : '—' }}</td>
                        <td>
                            <a href="{{ route('products.sizes.index', $product->id) }}"
                               class="badge badge-warning">
                                {{ $product->packageSizes->count() }} Sizes
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-xs btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-xs btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}"
                                  method="POST" style="display:inline;"
                                  onsubmit="return confirm('Delete this product?')">
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
                        <td colspan="7" class="text-center text-muted py-3">
                            <i class="fas fa-inbox mr-1"></i> No products found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection