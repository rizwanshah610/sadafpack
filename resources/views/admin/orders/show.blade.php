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
                            <td>
                                <strong class="text-success h5">
                                    PKR {{ number_format($order->total_amount, 2) }}
                                </strong>
                            </td>
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
                    <table class="table table-bordered mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Unit Price</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->items as $item)
                                @php $itemSubtotal = 0; @endphp

                                @if($item->packageSizes->count())
                                    @foreach($item->packageSizes as $ps)
                                        @php
                                            $unitPrice  = $ps->unit_price ?? $item->price;
                                            $subtotal   = $unitPrice * $ps->quantity;
                                            $itemSubtotal += $subtotal;
                                        @endphp
                                        <tr>
                                            @if($loop->first)
                                                <td class="align-middle font-weight-bold"
                                                    rowspan="{{ $item->packageSizes->count() }}">
                                                    <i class="fas fa-box mr-1 text-info"></i>
                                                    {{ $item->product->name ?? '—' }}
                                                </td>
                                            @endif
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $ps->packageSize->name ?? '—' }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $ps->quantity }}</td>
                                            <td class="text-right">
                                                PKR {{ number_format($unitPrice, 2) }}
                                                @if(!is_null($ps->packageSize->price ?? null))
                                                    <br><small class="text-success" title="Size-specific price">
                                                        <i class="fas fa-tag"></i> size price
                                                    </small>
                                                @else
                                                    <br><small class="text-secondary" title="Inherited from product">
                                                        <i class="fas fa-link"></i> product price
                                                    </small>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                PKR {{ number_format($subtotal, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- Item subtotal row --}}
                                    <tr class="table-light">
                                        <td colspan="3" class="text-right text-muted">
                                            <small>{{ $item->product->name ?? '' }} subtotal</small>
                                        </td>
                                        <td class="text-right font-weight-bold" colspan="2">
                                            PKR {{ number_format($item->packageSizes->sum(fn($ps) => ($ps->unit_price ?? $item->price) * $ps->quantity), 2) }}
                                        </td>
                                    </tr>

                                @else
                                    <tr>
                                        <td><i class="fas fa-box mr-1 text-info"></i> {{ $item->product->name ?? '—' }}</td>
                                        <td colspan="4" class="text-muted text-center">No sizes recorded</td>
                                    </tr>
                                @endif

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        <i class="fas fa-inbox mr-1"></i> No items found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="bg-dark text-white">
                                <th colspan="4" class="text-right">Grand Total:</th>
                                <th class="text-right">PKR {{ number_format($order->total_amount, 2) }}</th>
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