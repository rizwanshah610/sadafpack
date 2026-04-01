@extends('layout')

@section('content')

<form method="POST" action="{{ route('sizes.store') }}" enctype="multipart/form-data">
@csrf

<select name="product_id">
@foreach($products as $product)
<option value="{{ $product->id }}">{{ $product->name }}</option>
@endforeach
</select>

<input type="number" name="length" placeholder="Length">
<input type="number" name="width" placeholder="Width">
<input type="number" name="height" placeholder="Height">

<input type="file" name="image">

<button type="submit">Save</button>

</form>

@endsection