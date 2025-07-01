<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $query = Food::query();
        $categories = \App\Models\Category::all();
        
        // Filter by category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        // Search by name
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('harga', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('harga', '<=', $request->max_price);
        }
        
        // Sort by
        $sort = $request->get('sort', 'nama');
        $order = $request->get('order', 'asc');
        
        switch ($sort) {
            case 'harga':
                $query->orderBy('harga', $order);
                break;
            case 'nama':
            default:
                $query->orderBy('nama', $order);
                break;
        }
        
        $foods = $query->get();
        return view('food.index', compact('foods', 'categories'));
    }

    public function addToCart(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'nama' => $food->nama,
                'harga' => $food->harga,
                'qty' => 1
            ];
        }
        session(['cart' => $cart]);
        return redirect()->route('foods.index')->with('success', 'Berhasil menambah ke keranjang!');
    }

    public function cart()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }
        
        $cart = session()->get('cart', []);
        return view('food.cart', compact('cart'));
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $qty = max(1, (int)$request->qty);
            $cart[$id]['qty'] = $qty;
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diupdate!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang!');
    }

    // ADMIN CRUD
    public function adminIndex()
    {
        $foods = \App\Models\Food::all();
        return view('admin.foods.index', compact('foods'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.foods.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'gambar_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_link' => 'nullable|url',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar_upload')) {
            $gambar = $request->file('gambar_upload')->store('foods', 'public');
        } elseif ($request->filled('gambar_link')) {
            $gambar = $request->gambar_link;
        }
        $validated['gambar'] = $gambar;

        \App\Models\Food::create($validated);
        return redirect()->route('admin.foods.index')->with('success', 'Menu makanan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $food = \App\Models\Food::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('admin.foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $food = \App\Models\Food::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'gambar_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_link' => 'nullable|url',
        ]);

        $gambar = $food->gambar;
        if ($request->hasFile('gambar_upload')) {
            $gambar = $request->file('gambar_upload')->store('foods', 'public');
        } elseif ($request->filled('gambar_link')) {
            $gambar = $request->gambar_link;
        }
        $validated['gambar'] = $gambar;

        $food->update($validated);
        return redirect()->route('admin.foods.index')->with('success', 'Menu makanan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $food = \App\Models\Food::findOrFail($id);
        $food->delete();
        return redirect()->route('admin.foods.index')->with('success', 'Menu makanan berhasil dihapus!');
    }
}
