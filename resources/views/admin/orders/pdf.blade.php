<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order #{{ $order->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }

        .header { background: #2c3e50; color: white; padding: 20px; margin-bottom: 20px; }
        .header h1 { font-size: 22px; margin-bottom: 4px; }
        .header p { font-size: 11px; opacity: 0.8; }

        .section { margin-bottom: 20px; padding: 0 20px; }
        .section-title { font-size: 13px; font-weight: bold; color: #2c3e50;
                         border-bottom: 2px solid #2c3e50; padding-bottom: 4px; margin-bottom: 10px; }

        .info-grid { width: 100%; }
        .info-grid td { padding: 5px 8px; font-size: 11px; }
        .info-grid .label { font-weight: bold; color: #555; width: 140px; }

        table.items { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        table.items thead tr { background: #2c3e50; color: white; }
        table.items thead th { padding: 8px 10px; text-align: left; font-size: 11px; }
        table.items tbody tr:nth-child(even) { background: #f8f9fa; }
        table.items tbody td { padding: 7px 10px; font-size: 11px; border-bottom: 1px solid #eee; }
        table.items tfoot tr { background: #2c3e50; color: white; }
        table.items tfoot td { padding: 8px 10px; font-size: 12px; font-weight: bold; }

        .badge { display: inline-block; padding: 2px 7px; border-radius: 3px;
                 font-size: 10px; font-weight: bold; }
        .badge-info    { background: #17a2b8; color: white; }
        .badge-success { background: #28a745; color: white; }
        .badge-secondary { background: #6c757d; color: white; }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        .footer { margin-top: 30px; padding: 15px 20px; border-top: 1px solid #ddd;
                  font-size: 10px; color: #888; text-align: center; }

        .two-col { width: 100%; }
        .two-col td { vertical-align: top; padding: 0 20px 0 0; }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <table style="width:100%">
            <tr>
                <td>
                    <h1>Order #{{ $order->id }}</h1>
                    <p>Generated on {{ now()->format('d M Y, h:i A') }}</p>
                </td>
                <td style="text-align:right;">
                    <p style="font-size:16px; font-weight:bold;">
                        PKR {{ number_format($order->total_amount, 2) }}
                    </p>
                    <p>Total Amount</p>
                </td>
            </tr>
        </table>
    </div>

    {{-- Order Info + Company --}}
    <div class="section">
        <table class="two-col">
            <tr>
                {{-- Order Details --}}
                <td style="width:50%">
                    <div class="section-title">Order Details</div>
                    <table class="info-grid">
                        <tr>
                            <td class="label">Order #</td>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td class="label">Order Date</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td class="label">Delivery Date</td>
                            <td>{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') : '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Notes</td>
                            <td>{{ $order->notes ?? '—' }}</td>
                        </tr>
                    </table>
                </td>

                {{-- Company Details --}}
                <td style="width:50%">
                    <div class="section-title">Company</div>
                    <table class="info-grid">
                        <tr>
                            <td class="label">Name</td>
                            <td>{{ $order->company->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Email</td>
                            <td>{{ $order->company->email ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Phone</td>
                            <td>{{ $order->company->phone ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Address</td>
                            <td>{{ $order->company->address ?? '—' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    {{-- Order Items --}}
    <div class="section">
        <div class="section-title">Order Items</div>
        <table class="items">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Size</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $row = 1; @endphp
                @forelse($order->items as $item)
                    @foreach($item->packageSizes as $ps)
                        @php
                            $unitPrice = $ps->unit_price ?? $item->price;
                            $subtotal  = $unitPrice * $ps->quantity;
                        @endphp
                        <tr>
                            <td>{{ $row++ }}</td>
                            <td><strong>{{ $item->product->name ?? '—' }}</strong></td>
                            <td>
                                <span class="badge badge-info">
                                    {{ $ps->packageSize->name ?? '—' }}
                                </span>
                            </td>
                            <td class="text-center">{{ $ps->quantity }}</td>
                            <td class="text-right">PKR {{ number_format($unitPrice, 2) }}</td>
                            <td class="text-right">PKR {{ number_format($subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No items found.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right">Grand Total:</td>
                    <td class="text-right">PKR {{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- Footer --}}
    <div class="footer">
        {{ setting('site_name', 'SadafPack') }} &mdash; Order #{{ $order->id }} &mdash; {{ now()->format('d M Y') }}
    </div>

</body>
</html>