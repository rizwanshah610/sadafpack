@extends('layouts.admin')

@section('title', 'Order #' . $order->id)

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Order #{{ $order->id }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active">#{{ $order->id }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row">

        {{-- Order Info --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i> Order Info</h3>
                    <div class="card-tools">
                        <a href="{{ route('orders.download', $order) }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-file-pdf mr-1"></i> PDF
                        </a>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th>Company</th>
                            <td>{{ $order->company->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td>{{ $order->order_date }}</td>
                        </tr>
                        <tr>
                            <th>Delivery Date</th>
                            <td>{{ $order->delivery_date ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Notes</th>
                            <td>{{ $order->notes ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td><strong class="text-success">{{ number_format($order->total_amount, 2) }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-box mr-2"></i> Order Items</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Package Sizes</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name ?? '—' }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>
                                    @foreach($item->packageSizes as $ps)
                                        <span class="badge badge-info mr-1">
                                            {{ $ps->packageSize->name ?? $ps->package_size_id }}: {{ $ps->quantity }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ number_format($item->price * $item->packageSizes->sum('quantity'), 2) }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    <i class="fas fa-inbox mr-1"></i> No items.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="bg-light">
                                <th colspan="3" class="text-right">Total:</th>
                                <th>{{ number_format($order->total_amount, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Orders
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection