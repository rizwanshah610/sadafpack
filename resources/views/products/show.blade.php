@extends('layout')

@section('content')
<h2>{{ $product->name }}</h2>

<h3>Dimensions</h3>

<ul>
@foreach($product->sizes as $size)
    <li>
        {{ $size->length }} x {{ $size->width }} x {{ $size->height }}

        @if($size->image)
            <br>
            <img src="{{ asset('storage/'.$size->image) }}" width="100">
        @endif
    </li>
@endforeach
</ul>

<a href="{{ route('sizes.create') }}">Add Size</a>
@endsection