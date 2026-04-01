@extends('layout')

@section('content')
<form method="POST" action="{{ route('companies.store') }}">
@csrf
<input type="text" name="name" placeholder="Company Name">
<button type="submit">Save</button>
</form>
@endsection