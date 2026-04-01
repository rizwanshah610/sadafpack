@extends('layout')

@section('content')
<h2>{{ $company->name }}</h2>

<h3>Products</h3>

<ul>
@foreach($company->products as $product)
    <li>
        <a href="{{ route('products.show', $product->id) }}">
            {{ $product->name }}
        </a>
    </li>
@endforeach
</ul>

<a href="{{ route('products.create') }}">Add Product</a>
@endsection