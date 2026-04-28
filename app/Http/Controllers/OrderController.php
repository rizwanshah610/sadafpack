<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemPackageSize;
use App\Models\Company;
use App\Models\Product;
use App\Models\PackageSize;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('company')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.orders.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id'               => 'required|exists:companies,id',
            'order_date'               => 'required|date',
            'delivery_date'            => 'nullable|date|after_or_equal:order_date',
            'products'                 => 'required|array|min:1',
            'products.*.id'            => 'required|exists:products,id',
            'products.*.price'         => 'required|numeric|min:0',
            'products.*.package_sizes' => 'required|array',
        ]);

        $order = Order::create([
            'company_id'    => $request->company_id,
            'order_date'    => $request->order_date,
            'delivery_date' => $request->delivery_date,
            'notes'         => $request->notes,
            'total_amount'  => 0,
        ]);

        $total = 0;

        foreach ($request->products as $product) {
            $item = OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product['id'],
                'price'      => $product['price'], // product base price
            ]);

            foreach ($product['package_sizes'] as $ps) {
                if (($ps['qty'] ?? 0) > 0) {

                    // Get size model to determine effective price
                    $size = PackageSize::find($ps['id']);

                    // Use size price if set, otherwise fall back to product price
                    $unitPrice = !is_null($size?->price)
                        ? (float) $size->price
                        : (float) $product['price'];

                    OrderItemPackageSize::create([
                        'order_item_id'   => $item->id,
                        'package_size_id' => $ps['id'],
                        'quantity'        => $ps['qty'],
                        'unit_price'      => $unitPrice,
                    ]);

                    $total += $ps['qty'] * $unitPrice;
                }
            }
        }

        $order->update(['total_amount' => $total]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load('company', 'items.product', 'items.packageSizes.packageSize');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $companies = Company::all();
        $order->load('items.packageSizes');
        return view('admin.orders.edit', compact('order', 'companies'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'company_id'               => 'required|exists:companies,id',
            'order_date'               => 'required|date',
            'delivery_date'            => 'nullable|date|after_or_equal:order_date',
            'products'                 => 'required|array|min:1',
            'products.*.id'            => 'required|exists:products,id',
            'products.*.price'         => 'required|numeric|min:0',
            'products.*.package_sizes' => 'required|array',
        ]);

        // Delete old items
        $order->items()->each(fn($item) => $item->packageSizes()->delete());
        $order->items()->delete();

        $total = 0;

        foreach ($request->products as $product) {
            $item = OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product['id'],
                'price'      => $product['price'],
            ]);

            foreach ($product['package_sizes'] as $ps) {
                if (($ps['qty'] ?? 0) > 0) {

                    $size = PackageSize::find($ps['id']);

                    $unitPrice = !is_null($size?->price)
                        ? (float) $size->price
                        : (float) $product['price'];

                    OrderItemPackageSize::create([
                        'order_item_id'   => $item->id,
                        'package_size_id' => $ps['id'],
                        'quantity'        => $ps['qty'],
                        'unit_price'      => $unitPrice,
                    ]);

                    $total += $ps['qty'] * $unitPrice;
                }
            }
        }

        $order->update([
            'company_id'    => $request->company_id,
            'order_date'    => $request->order_date,
            'delivery_date' => $request->delivery_date,
            'notes'         => $request->notes,
            'total_amount'  => $total,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->items()->each(fn($item) => $item->packageSizes()->delete());
        $order->items()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted.');
    }

    public function download(Order $order)
    {
        abort(501, 'Download not implemented yet.');
    }
}