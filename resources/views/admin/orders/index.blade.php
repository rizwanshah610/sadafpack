@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Orders</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-shopping-cart mr-2"></i> All Orders
            </h3>
            <div class="card-tools">
                <a href="{{ route('orders.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-1"></i> New Order
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Company</th>
                        <th>Order Date</th>
                        <th>Delivery Date</th>
                        <th>Total Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td><i class="fas fa-building mr-1 text-info"></i> {{ $order->company->name ?? '—' }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->delivery_date ?? '—' }}</td>
                        <td><span class="badge badge-success">{{ number_format($order->total_amount, 2) }}</span></td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-xs btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-xs btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('orders.download', $order) }}" class="btn btn-xs btn-secondary">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Delete this order?')"
                                        class="btn btn-xs btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">
                            <i class="fas fa-inbox mr-1"></i> No orders found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $orders->links() }}
        </div>
    </div>

</div>
@endsection