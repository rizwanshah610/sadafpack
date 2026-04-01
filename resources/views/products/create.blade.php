@extends('layout')

@section('content')
<form method="POST" action="{{ route('products.store') }}">
@csrf

<select name="company_id">
@foreach($companies as $company)
<option value="{{ $company->id }}">{{ $company->name }}</option>
@endforeach
</select>

<input type="text" name="name" placeholder="Product Name">

<button type="submit">Save</button>
</form>
@endsection