<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function confirmPayment($id)
    {
        $order = Order::findOrFail($id);
        if ($order->payment_status === 'unpaid') {
            $order->payment_status = 'paid';
            $order->status = 'processing';
            $order->save();
        }
        return redirect()->route('orders.index')->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'status' => 'required|in:processing,delivering,finished',
        ]);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Status pesanan diperbarui!');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function autoUpdateStatus($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == 'pending') {
            $order->status = 'processing';
        } elseif ($order->status == 'processing') {
            $order->status = 'delivering';
        } elseif ($order->status == 'delivering') {
            $order->status = 'finished';
        }
        $order->save();
        return response()->json(['status' => $order->status]);
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $validated = $request->validate([
            'nama_pemesan' => 'required',
            'alamat' => 'required',
            'total_harga' => 'required|numeric',
            'status' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
        ]);
        $order->update($validated);
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}
