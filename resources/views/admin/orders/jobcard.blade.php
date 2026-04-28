<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Card — Order #{{ $order->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
            background: #fff;
            padding: 20px;
        }

        /* ── Top Header ── */
        .top-header {
            width: 100%;
            border: 2px solid #000;
            margin-bottom: 0;
        }
        .top-header td {
            padding: 8px 12px;
            vertical-align: middle;
        }
        .company-name {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .job-card-title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .order-no {
            font-size: 13px;
            text-align: right;
        }

        /* ── Info Row ── */
        .info-row {
            width: 100%;
            border: 2px solid #000;
            border-top: none;
        }
        .info-row td {
            padding: 6px 12px;
            border-right: 1px solid #000;
            font-size: 11px;
        }
        .info-row td:last-child { border-right: none; }
        .info-label { font-weight: bold; font-size: 10px; color: #444; display: block; }
        .info-value { font-size: 12px; font-weight: bold; }

        /* ── Items Section ── */
        .items-wrapper {
            border: 2px solid #000;
            border-top: none;
            margin-bottom: 0;
        }
        .items-header {
            background: #2c3e50;
            color: white;
            padding: 6px 12px;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        table.job-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.job-table thead tr {
            background: #ecf0f1;
        }
        table.job-table thead th {
            padding: 7px 10px;
            font-size: 11px;
            font-weight: bold;
            border: 1px solid #bbb;
            text-align: center;
        }
        table.job-table tbody td {
            padding: 8px 10px;
            font-size: 12px;
            border: 1px solid #bbb;
            vertical-align: middle;
        }
        table.job-table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        .text-center { text-align: center; }
        .text-right  { text-align: right; }
        .text-left   { text-align: left; }

        .qty-circle {
            display: inline-block;
            border: 2px solid #000;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            line-height: 36px;
            text-align: center;
            font-weight: bold;
            font-size: 13px;
        }

        /* ── Notes Box ── */
        .notes-section {
            border: 2px solid #000;
            border-top: none;
            padding: 10px 12px;
            min-height: 60px;
        }
        .notes-label {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 4px;
            text-transform: uppercase;
            color: #444;
        }
        .notes-value { font-size: 12px; }

        /* ── Footer / Signature ── */
        .footer-section {
            border: 2px solid #000;
            border-top: none;
        }
        .footer-section table {
            width: 100%;
        }
        .footer-section td {
            padding: 12px 15px;
            border-right: 1px solid #000;
            vertical-align: bottom;
            font-size: 11px;
        }
        .footer-section td:last-child { border-right: none; }
        .sig-line {
            border-top: 1px solid #000;
            margin-top: 30px;
            padding-top: 4px;
            font-size: 10px;
            color: #555;
            text-align: center;
        }

        /* ── Total Bar ── */
        .total-bar {
            border: 2px solid #000;
            border-top: none;
            background: #2c3e50;
            color: white;
            padding: 8px 12px;
        }
        .total-bar table { width: 100%; }
        .total-bar td { padding: 2px 8px; font-size: 13px; font-weight: bold; }
    </style>
</head>
<body>

    {{-- ── HEADER ── --}}
    <table class="top-header">
        <tr>
            <td style="width:35%;">
                <div class="company-name">{{ setting('site_name', 'SadafPack') }}</div>
                <div style="font-size:10px; color:#555;">Packaging Solutions</div>
            </td>
            <td style="width:30%;">
                <div class="job-card-title">Job Card</div>
            </td>
            <td style="width:35%;">
                <div class="order-no">
                    <strong>Order #{{ $order->id }}</strong><br>
                    <span style="font-size:10px;">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</span>
                </div>
            </td>
        </tr>
    </table>

    {{-- ── INFO ROW ── --}}
    <table class="info-row">
        <tr>
            <td style="width:30%;">
                <span class="info-label">Company</span>
                <span class="info-value">{{ $order->company->name ?? '—' }}</span>
            </td>
            <td style="width:25%;">
                <span class="info-label">Order Date</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</span>
            </td>
            <td style="width:25%;">
                <span class="info-label">Delivery Date</span>
                <span class="info-value">
                    {{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') : '—' }}
                </span>
            </td>
            <td style="width:20%;">
                <span class="info-label">Total Amount</span>
                <span class="info-value">PKR {{ number_format($order->total_amount, 2) }}</span>
            </td>
        </tr>
    </table>

    {{-- ── ITEMS ── --}}
    <div class="items-wrapper">
        <div class="items-header">&#9635; Order Items</div>

        @foreach($order->items as $item)
        <div style="padding: 0;">

            {{-- Product name bar --}}
            <div style="background:#ecf0f1; padding:6px 12px; border-bottom:1px solid #bbb;
                        border-top:1px solid #bbb; font-weight:bold; font-size:13px;">
                &#9654; {{ $item->product->name ?? '—' }}
            </div>

            <table class="job-table">
                <thead>
                    <tr>
                        <th style="width:5%;">#</th>
                        <th style="width:20%;">Size Name</th>
                        <th style="width:15%;">Ply</th>
                        <th style="width:20%;">Nali (Flute)</th>
                        <th style="width:15%;">Unit Price</th>
                        <th style="width:15%;">Quantity</th>
                        <th style="width:10%;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($item->packageSizes as $index => $ps)
                    @php
                        $size      = $ps->packageSize;
                        $unitPrice = $ps->unit_price ?? $item->price;
                        $subtotal  = $unitPrice * $ps->quantity;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-left">
                            <strong>{{ $size->name ?? '—' }}</strong>
                        </td>
                        <td class="text-center">
                            {{ $size->ply ?? '—' }}
                        </td>
                        <td class="text-center">
                            {{ $size->nali ?? '—' }}
                        </td>
                        <td class="text-center">
                            PKR {{ number_format($unitPrice, 2) }}
                        </td>
                        <td class="text-center">
                            {{-- Circled quantity like your sketch --}}
                            <span class="qty-circle">{{ $ps->quantity }}</span>
                        </td>
                        <td class="text-right">
                            PKR {{ number_format($subtotal, 2) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center" style="color:#888;">No sizes recorded.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        @endforeach
    </div>

    {{-- ── NOTES ── --}}
    <div class="notes-section">
        <div class="notes-label">Notes / Remarks</div>
        <div class="notes-value">{{ $order->notes ?? '—' }}</div>
    </div>

    {{-- ── TOTAL BAR ── --}}
    <div class="total-bar">
        <table>
            <tr>
                <td>Grand Total:</td>
                <td class="text-right">PKR {{ number_format($order->total_amount, 2) }}</td>
            </tr>
        </table>
    </div>

    {{-- ── SIGNATURES ── --}}
    <div class="footer-section">
        <table>
            <tr>
                <td style="width:33%;">
                    <div class="sig-line">Prepared By</div>
                </td>
                <td style="width:33%;">
                    <div class="sig-line">Checked By</div>
                </td>
                <td style="width:34%;">
                    <div class="sig-line">Authorized By</div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>