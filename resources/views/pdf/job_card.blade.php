<h3>Company: {{ $order->company->name }}</h3>
<p>Order Date: {{ $order->order_date }}</p>

@foreach($order->items as $item)
  <h4>Product: {{ $item->product->name }}</h4>

  <table border="1" width="100%">
    <tr>
      <th>Package</th>
      <th>Qty</th>
    </tr>

    @foreach($item->packageSizes as $ps)
    <tr>
      <td>{{ $ps->packageSize->name }}</td>
      <td>{{ $ps->quantity }}</td>
    </tr>
    @endforeach
  </table>
@endforeach

<h3>Total: {{ $order->total_amount }}</h3>