@extends('layouts.admin')
@section('title', $company->name)
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">{{ $company->name }}</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-building mr-2"></i> Company Details</h3>
            <div class="card-tools">
                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <a href="{{ route('companies.index') }}" class="btn btn-sm btn-secondary ml-1">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 text-center">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}"
                             width="100" height="100"
                             style="border-radius:50%; object-fit:cover; border: 3px solid #dee2e6;">
                    @else
                        <div style="width:100px; height:100px; border-radius:50%; background:#e9ecef;
                                    display:flex; align-items:center; justify-content:center; margin:auto;">
                            <i class="fas fa-building fa-2x text-secondary"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-10">
                    <table class="table table-bordered">
                        <tr><th width="150">Name</th><td>{{ $company->name }}</td></tr>
                        <tr><th>Email</th><td>{{ $company->email ?? '—' }}</td></tr>
                        <tr><th>Phone</th><td>{{ $company->phone ?? '—' }}</td></tr>
                        <tr><th>Address</th><td>{{ $company->address ?? '—' }}</td></tr>
                        <tr><th>Website</th><td>
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                            @else — @endif
                        </td></tr>
                        <tr><th>Total Products</th><td>
                            <span class="badge badge-success">{{ $company->products->count() }} Products</span>
                        </td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection