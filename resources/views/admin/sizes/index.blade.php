@extends('layouts.admin')
@section('title', 'Sizes')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Sizes — {{ $product->name }}</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-ruler-combined mr-2"></i> Package Sizes</h3>
            <div class="card-tools">
                <a href="{{ route('products.sizes.create', $product->id) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-1"></i> Add Size
                </a>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-secondary ml-1">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body p-0">

            @if(session('success'))
                <div class="alert alert-success m-3">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Image</th> <th>Name</th>
                            <th>Length</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Sheet Size</th>
                            <th>Color</th>
                            <th>Ply</th>
                            <th>Paper</th>
                            <th>Nali</th>
                            <th>Unit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($sizes as $size)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            
                            <td class="align-middle">
    @if($size->image)
        <img src="{{ asset('storage/' . $size->image) }}" 
             alt="{{ $size->name }}" 
             style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 1px solid #ddd;">
    @else
        <img src="https://ui-avatars.com/api/?name={{ urlencode($size->name) }}&background=random&color=fff" 
             alt="Avatar" 
             style="width: 50px; height: 50px; border-radius: 50%;">
    @endif
</td>

                            <td class="align-middle"><strong>{{ $size->name }}</strong></td>
                            <td class="align-middle">{{ $size->length }}</td>
                            <td class="align-middle">{{ $size->width }}</td>
                            <td class="align-middle">{{ $size->height }}</td>
                            <td class="align-middle">{{ $size->sheet_size ?? '—' }}</td>
                            <td class="align-middle">{{ $size->color ?? '—' }}</td>
                            <td class="align-middle">{{ $size->ply ?? '—' }}</td>
                            <td class="align-middle">{{ $size->paper ?? '—' }}</td>
                            <td class="align-middle">{{ $size->nali ?? '—' }}</td>
                            <td class="align-middle">{{ $size->unit ?? '—' }}</td>

                            <td class="align-middle">
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
                            <td colspan="13" class="text-center text-muted py-3">
                                <i class="fas fa-inbox mr-1"></i> No sizes found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $sizes->links() }}
        </div>
    </div>
</div>
@endsection