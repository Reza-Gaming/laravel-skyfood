<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Snap;
use Midtrans\Config as MidtransConfig;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }
        $total = collect($cart)->reduce(function($carry, $item) {
            return $carry + ($item['harga'] * $item['qty']);
        }, 0);
        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }
        $total = collect($cart)->reduce(function($carry, $item) {
            return $carry + ($item['harga'] * $item['qty']);
        }, 0);
        $request->validate([
            'nama_pemesan' => 'required',
            'alamat' => 'required',
            'payment_method' => 'required|in:simulasi,offline',
        ]);
        $order = Order::create([
            'nama_pemesan' => $request->nama_pemesan,
            'alamat' => $request->alamat,
            'total_harga' => $total,
            'status' => 'pending',
            'items' => json_encode($cart),
            'tracking_number' => 'TRK' . strtoupper(uniqid()),
            'estimated_delivery' => now()->addMinutes(45),
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method === 'offline' ? 'paid' : 'unpaid',
        ]);
        session()->forget('cart');
        if ($request->payment_method === 'simulasi') {
            return redirect()->route('checkout.simulasi', ['order_id' => $order->id]);
        } else {
            return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat! Silakan bayar di tempat.');
        }
    }

    public function payWithMidtrans(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!$order) {
            abort(404, 'Order tidak ditemukan');
        }
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id,
                'gross_amount' => $order->total_harga,
            ],
            'customer_details' => [
                'first_name' => $order->nama_pemesan,
                'email' => auth()->user()->email ?? 'guest@example.com',
            ],
        ];
        $snapToken = Snap::getSnapToken($params);
        return view('checkout.midtrans', compact('snapToken'));
    }

    public function simulasiPembayaran(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!$order) {
            abort(404, 'Order tidak ditemukan');
        }
        return view('checkout.simulasi', compact('order'));
    }

    public function prosesSimulasi(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status = 'paid';
        $order->status = 'paid';
        $order->save();
        return redirect()->route('orders.show', $order->id)->with('success', 'Pembayaran simulasi berhasil!');
    }
}
