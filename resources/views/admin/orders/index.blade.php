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
        <div class="alert alert-success alert-dismissible">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-shopping-cart mr-2"></i> All Orders
            </h3>
            <div class="card-tools d-flex align-items-center">
                {{-- Search --}}
                <div class="input-group input-group-sm mr-2" style="width:220px;">
                    <input type="text" id="orderSearch" class="form-control" placeholder="Search company...">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>
                <a href="{{ route('orders.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-1"></i> New Order
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0" id="ordersTable">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Company</th>
                        <th>Order Date</th>
                        <th>Delivery Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="ordersBody">
                    @forelse($orders as $order)
                    <tr>
                        <td class="align-middle">{{ $order->id }}</td>
                        <td class="align-middle">
                            <i class="fas fa-building mr-1 text-info"></i>
                            {{ $order->company->name ?? '—' }}
                        </td>
                        <td class="align-middle">
                            <i class="fas fa-calendar mr-1 text-muted"></i>
                            {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                        </td>
                        <td class="align-middle">
                            @if($order->delivery_date)
                                @php $daysLeft = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($order->delivery_date), false); @endphp
                                <i class="fas fa-truck mr-1 text-muted"></i>
                                {{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }}
                                @if($daysLeft >= 0)
                                    <small class="text-success ml-1">({{ $daysLeft }}d left)</small>
                                @else
                                    <small class="text-danger ml-1">(overdue)</small>
                                @endif
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-success">
                                PKR {{ number_format($order->total_amount, 2) }}
                            </span>
                        </td>
                        <td class="align-middle">
                            @if($order->delivery_date && \Carbon\Carbon::parse($order->delivery_date)->isPast())
                                <span class="badge badge-danger">Overdue</span>
                            @elseif($order->delivery_date && \Carbon\Carbon::parse($order->delivery_date)->isToday())
                                <span class="badge badge-warning">Due Today</span>
                            @else
                                <span class="badge badge-info">Active</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-xs btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-xs btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('orders.download', $order) }}" class="btn btn-xs btn-secondary">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                            <form action="{{ route('orders.destroy', $order) }}"
      method="POST"
      class="d-inline delete-form">
    @csrf
    @method('DELETE')

    <button type="button" class="btn btn-xs btn-danger delete-btn">
        <i class="fas fa-trash"></i> Delete
    </button>
</form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i> No orders found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div id="noResults" class="text-center text-muted py-3" style="display:none;">
                <i class="fas fa-search mr-1"></i> No orders match your search.
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $orders->links() }}
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.getElementById('orderSearch').addEventListener('keyup', function () {
        const search = this.value.toLowerCase();
        const rows   = document.querySelectorAll('#ordersBody tr');
        let visible  = 0;

        rows.forEach(row => {
            const company = row.querySelector('td:nth-child(2)');
            if (company && company.textContent.toLowerCase().includes(search)) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('noResults').style.display = visible === 0 ? 'block' : 'none';
    });
</script>
@endpush