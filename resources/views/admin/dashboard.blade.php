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

    {{-- Welcome Card --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Welcome to SadafPack Admin</h3>
                </div>
                <div class="card-body">
                    Panel is working correctly! 🎉
                </div>
            </div>
        </div>
    </div>

</div>
@endsection