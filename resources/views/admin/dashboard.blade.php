@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Dashboard</h1>
    </div>
</div>

<div class="container-fluid">

    {{-- Small Boxes --}}
    <div class="row">

        {{-- Total Companies --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalCompanies }}</h3>
                    <p>Total Companies</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{ route('companies.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Total Products --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalProducts }}</h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
                <a href="{{ route('products.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Total Sizes --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalSizes }}</h3>
                    <p>Total Sizes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ruler-combined"></i>
                </div>
                <a href="{{ route('sizes.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- Companies Table --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-building mr-2"></i> Companies
                </h3>
                <div class="card-tools">
                    {{-- Search Bar --}}
                    <div class="input-group input-group-sm mr-2" style="width: 250px; display: inline-flex;">
                        <input type="text" id="companySearch" class="form-control" placeholder="Search companies...">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('companies.index') }}" class="btn btn-sm btn-info">
                        <i class="fas fa-list mr-1"></i> View All
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0" id="companiesTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Company Name</th>
                            <th>Total Products</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="companiesBody">
                        @forelse($companies as $company)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('companies.show', $company->id) }}">
                                    <i class="fas fa-building mr-1 text-info"></i>
                                    {{ $company->name }}
                                </a>
                            </td>
                            <td>
                                <span class="badge badge-success">
                                    {{ $company->products_count }} Products
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('companies.show', $company->id) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                <i class="fas fa-inbox mr-1"></i> No companies found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- No results row (hidden by default) --}}
                <div id="noResults" class="text-center text-muted py-3" style="display:none;">
                    <i class="fas fa-search mr-1"></i> No companies match your search.
                </div>

            </div>
            @if($companies->count() > 0)
            <div class="card-footer text-right">
                <a href="{{ route('companies.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-arrow-circle-right mr-1"></i> Go to Companies
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

</div>
@endsection
@push('scripts')
<script>
    document.getElementById('companySearch').addEventListener('keyup', function () {
        const search = this.value.toLowerCase();
        const rows   = document.querySelectorAll('#companiesBody tr');
        let visible  = 0;

        rows.forEach(function (row) {
            const name = row.querySelector('td:nth-child(2)');
            if (name && name.textContent.toLowerCase().includes(search)) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        // Show "no results" message if nothing matches
        document.getElementById('noResults').style.display = visible === 0 ? 'block' : 'none';
    });
</script>
@endpush