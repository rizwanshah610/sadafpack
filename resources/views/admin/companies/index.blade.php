@extends('layouts.admin')
@section('title', 'Companies')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Companies</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex align-items-center">

            <h3 class="card-title mb-0">
                <i class="fas fa-building mr-2"></i> All Companies
            </h3>

            <div class="card-tools ml-auto d-flex align-items-center">
                <input type="text" id="searchInput"
                       class="form-control form-control-sm mr-2"
                       placeholder="Search..." style="width: 200px;">
                <a href="{{ route('companies.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-1"></i> Add Company
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
                            <th>Logo</th>
                            <th>Name</th>
                            <th class="d-none d-md-table-cell">Products</th>
                            <th class="d-none d-md-table-cell">Sizes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($companies as $company)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}"
                                         width="40" height="40"
                                         style="border-radius:50%; object-fit:cover;">
                                @else
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-building"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ $company->name }}
                                {{-- On mobile show products & sizes inline under the name --}}
                                <div class="d-md-none mt-1">
                                    <a href="{{ route('products.index', ['company_id' => $company->id]) }}">
                                        <span class="badge badge-success mr-1">
                                            {{ $company->products_count }} Products
                                        </span>
                                    </a>
                                    <a href="{{ route('products.index', ['company_id' => $company->id]) }}">
                                        <span class="badge badge-warning">
                                            {{ $company->sizes_count }} Sizes
                                        </span>
                                    </a>
                                </div>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a href="{{ route('products.index', ['company_id' => $company->id]) }}">
                                    <span class="badge badge-success">
                                        {{ $company->products_count }} Products
                                    </span>
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a href="{{ route('products.index', ['company_id' => $company->id]) }}">
                                    <span class="badge badge-warning">
                                        {{ $company->sizes_count }} Sizes
                                    </span>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('companies.show', $company->id) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-xs btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('companies.destroy', $company->id) }}"
      method="POST"
      class="delete-form"
      style="display:inline;">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-xs btn-danger delete-btn">
        <i class="fas fa-trash"></i>
    </button>
</form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                <i class="fas fa-inbox mr-1"></i> No companies found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
        <div class="card-footer">
            {{ $companies->links() }}
        </div>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll('tbody tr');
    rows.forEach(function(row) {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(value) ? '' : 'none';
    });
});
</script>

@endsection