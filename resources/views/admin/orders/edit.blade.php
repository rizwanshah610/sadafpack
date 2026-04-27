@extends('layouts.admin')

@section('title', 'Edit Order #' . $order->id)

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Edit Order #{{ $order->id }}</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active">Edit #{{ $order->id }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <ul class="mb-0">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- Pass existing order data to JS --}}
@php
    $existingOrderJson = json_encode([
        'company_id' => $order->company_id,
        'items' => $order->items->map(fn($item) => [
            'product_id' => $item->product_id,
            'price'      => $item->price,
            'sizes'      => $item->packageSizes->map(fn($ps) => [
                'package_size_id' => $ps->package_size_id,
                'quantity'        => $ps->quantity,
            ])->toArray(),
        ])->toArray(),
    ]);
@endphp
<script>
    const existingOrder = {!! $existingOrderJson !!};
</script>

    <form action="{{ route('orders.update', $order) }}" method="POST" id="orderForm">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- Left Column --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i> Order Details</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Company <span class="text-danger">*</span></label>
                            <select name="company_id" id="companySelect" class="form-control" required>
                                <option value="">-- Select Company --</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ old('company_id', $order->company_id) == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Order Date <span class="text-danger">*</span></label>
                            <input type="date" name="order_date" class="form-control"
                                   value="{{ old('order_date', $order->order_date) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Delivery Date</label>
                            <input type="date" name="delivery_date" class="form-control"
                                   value="{{ old('delivery_date', $order->delivery_date) }}">
                        </div>

                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $order->notes) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Total Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" id="orderTotal" class="form-control font-weight-bold"
                                       value="{{ number_format($order->total_amount, 2) }}" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary mr-2">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save mr-1"></i> Update Order
                        </button>
                    </div>
                </div>
            </div>

            {{-- Right Column - Products --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-box mr-2"></i> Products</h3>
                        <div class="card-tools">
                            <span class="badge badge-info" id="productCount">Loading...</span>
                        </div>
                    </div>
                    <div class="card-body p-0" id="productsWrapper">

                        <div id="emptyState" class="text-center text-muted py-5" style="display:none;">
                            <i class="fas fa-building fa-2x mb-2"></i>
                            <p>Please select a company first</p>
                        </div>

                        <table class="table table-bordered mb-0" id="productsTable" style="display:none;">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width:30px;"></th>
                                    <th>Product</th>
                                    <th style="width:130px;">Price</th>
                                    <th>Package Sizes & Qty</th>
                                </tr>
                            </thead>
                            <tbody id="productsBody"></tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection

@push('scripts')
<script>
const companySelect = document.getElementById('companySelect');
const productsTable = document.getElementById('productsTable');
const productsBody  = document.getElementById('productsBody');
const emptyState    = document.getElementById('emptyState');
const productCount  = document.getElementById('productCount');
const orderTotalEl  = document.getElementById('orderTotal');

function loadProducts(companyId, prefill) {
    if (!companyId) {
        productsTable.style.display = 'none';
        emptyState.style.display = 'block';
        productCount.textContent = 'Select a company';
        productsBody.innerHTML = '';
        recalcTotal();
        return;
    }

    productCount.textContent = 'Loading...';

    fetch(`/admin/api/companies/${companyId}/products`)
        .then(r => r.json())
        .then(products => {
            productsBody.innerHTML = '';

            if (products.length === 0) {
                emptyState.innerHTML = '<p class="text-muted py-4 text-center"><i class="fas fa-box-open mr-1"></i> No products for this company.</p>';
                emptyState.style.display = 'block';
                productsTable.style.display = 'none';
                productCount.textContent = '0 Products';
                return;
            }

            emptyState.style.display = 'none';
            productsTable.style.display = 'table';
            productCount.textContent = products.length + ' Products';

            products.forEach((product, index) => {

                // Find existing item for this product (if editing)
                const existingItem = prefill
                    ? prefill.find(i => i.product_id == product.id)
                    : null;

                const isChecked = !!existingItem;

                const sizesHtml = product.package_sizes.map((ps, si) => {
                    const existingPs = existingItem
                        ? existingItem.sizes.find(s => s.package_size_id == ps.id)
                        : null;
                    const qty = existingPs ? existingPs.quantity : 0;

                    return `
                        <div class="mr-3 mb-1">
                            <small class="d-block text-muted">${ps.name}</small>
                            <input type="hidden"
                                   name="products[${index}][package_sizes][${si}][id]"
                                   value="${ps.id}"
                                   ${!isChecked ? 'disabled' : ''}>
                            <input type="number" min="0"
                                   name="products[${index}][package_sizes][${si}][qty]"
                                   class="form-control form-control-sm qty-input"
                                   style="width:70px;"
                                   value="${qty}"
                                   ${!isChecked ? 'disabled' : ''}>
                        </div>
                    `;
                }).join('');

                const row = `
                    <tr>
                        <td class="text-center align-middle">
                            <input type="checkbox" class="product-checkbox" data-index="${index}" ${isChecked ? 'checked' : ''}>
                        </td>
                        <td class="align-middle">
                            <strong>${product.name}</strong>
                            <input type="hidden" name="products[${index}][id]" value="${product.id}" ${!isChecked ? 'disabled' : ''}>
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0"
                                   name="products[${index}][price]"
                                   class="form-control form-control-sm price-input"
                                   value="${existingItem ? existingItem.price : (product.price ?? 0)}"
                                   ${!isChecked ? 'disabled' : ''}>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap sizes-wrapper" style="${!isChecked ? 'opacity:0.4; pointer-events:none;' : ''}">
                                ${sizesHtml}
                            </div>
                        </td>
                    </tr>
                `;
                productsBody.insertAdjacentHTML('beforeend', row);
            });

            attachListeners();
            recalcTotal();
        })
        .catch(() => {
            productCount.textContent = 'Error loading products';
        });
}

function attachListeners() {
    document.querySelectorAll('.qty-input, .price-input').forEach(el => {
        el.addEventListener('input', recalcTotal);
    });

    document.querySelectorAll('.product-checkbox').forEach(cb => {
        cb.addEventListener('change', function () {
            const row = this.closest('tr');
            const inputs = row.querySelectorAll('input[type=number], input[type=hidden]');
            const sizesWrapper = row.querySelector('.sizes-wrapper');

            if (this.checked) {
                inputs.forEach(i => i.disabled = false);
                sizesWrapper.style.opacity = '1';
                sizesWrapper.style.pointerEvents = 'auto';
            } else {
                inputs.forEach(i => i.disabled = true);
                sizesWrapper.style.opacity = '0.4';
                sizesWrapper.style.pointerEvents = 'none';
                row.querySelectorAll('.qty-input').forEach(i => i.value = 0);
            }
            recalcTotal();
        });
    });
}

function recalcTotal() {
    let total = 0;
    document.querySelectorAll('#productsBody tr').forEach(row => {
        const cb = row.querySelector('.product-checkbox');
        if (!cb || !cb.checked) return;
        const price = parseFloat(row.querySelector('.price-input')?.value) || 0;
        let qty = 0;
        row.querySelectorAll('.qty-input').forEach(i => qty += parseInt(i.value) || 0);
        total += price * qty;
    });
    orderTotalEl.value = total.toFixed(2);
}

// When company changes, reload products without prefill
companySelect.addEventListener('change', function () {
    loadProducts(this.value, null);
});

// On page load, load products with existing order data prefilled
loadProducts(existingOrder.company_id, existingOrder.items);
</script>
@endpush