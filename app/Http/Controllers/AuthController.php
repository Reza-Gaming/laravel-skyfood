<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Food;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang Admin!');
            } else {
                return redirect()->route('user.dashboard')->with('success', 'Selamat datang!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Anda berhasil logout!');
    }

    public function userDashboard()
    {
        $user = Auth::user();
        $recentOrders = Order::where('nama_pemesan', $user->name)
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
        
        $totalOrders = Order::where('nama_pemesan', $user->name)->count();
        $totalSpent = Order::where('nama_pemesan', $user->name)->sum('total_harga');
        
        return view('user.dashboard', compact('user', 'recentOrders', 'totalOrders', 'totalSpent'));
    }
}
