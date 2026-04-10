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
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-building mr-2"></i> All Companies</h3>
            <div class="card-tools">
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

            <table class="table table-striped table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Website</th>
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
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email ?? '—' }}</td>
                        <td>{{ $company->phone ?? '—' }}</td>
                        <td>
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Visit
                                </a>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-xs btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-xs btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('companies.destroy', $company->id) }}"
                                  method="POST" style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this company?')">
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
                            <i class="fas fa-inbox mr-1"></i> No companies found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $companies->links() }}
        </div>
    </div>
</div>
@endsection