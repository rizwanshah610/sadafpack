@extends('layout')

@section('content')
<a href="{{ route('companies.create') }}">Add Company</a>

<ul>
@foreach($companies as $company)
    <li>
        <a href="{{ route('companies.show', $company->id) }}">
            {{ $company->name }}
        </a>
    </li>
@endforeach
</ul>
@endsection