@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0" style="background: rgba(26,26,64,0.97); color: #ffe066; border-radius: 20px; box-shadow: 0 0 32px #6c63ff99, 0 0 0 2px #ffe06655;">
                <div class="card-header text-center" style="background: linear-gradient(90deg, #232946 60%, #1a1a40 100%); color: #ffe066; border-bottom: 2px solid #ffe066; border-radius: 20px 20px 0 0;">
                    <i class="fas fa-utensils fa-3x mb-2"></i>
                    <h3 class="mb-0 mt-2" style="font-weight: bold; letter-spacing: 1px;">Skyfood</h3>
                    <p class="mb-0" style="color: #ffe066;">Masuk ke akun Anda</p>
                </div>
                <div class="card-body login-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success" style="background: #232946; color: #ffe066; border: 1px solid #ffe066;">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger" style="background: #232946; color: #ffe066; border: 1px solid #ffe066;">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label" style="color: #ffe066;">
                                <i class="fas fa-envelope me-2"></i>Email
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required style="background: #232946; color: #ffe066; border: 1px solid #6c63ff;">
                            @error('email')
                                <div class="invalid-feedback" style="color: #ff6b6b;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label" style="color: #ffe066;">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required style="background: #232946; color: #ffe066; border: 1px solid #6c63ff;">
                            @error('password')
                                <div class="invalid-feedback" style="color: #ff6b6b;">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-login w-100" style="background: linear-gradient(90deg, #ffe066 60%, #fffbe7 100%); color: #232946; border: none; font-weight: bold; border-radius: 12px; box-shadow: 0 0 8px #ffe06699;">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </button>
                    </form>
                    <div class="demo-accounts mt-4 p-3 rounded" style="background: rgba(108,99,255,0.12); border: 1px solid #6c63ff; color: #ffe066;">
                        <h6 class="mb-2" style="color: #ffe066;"><i class="fas fa-info-circle me-2"></i>Akun Demo:</h6>
                        <div class="row">
                            <div class="col-12">
                                <small class="text-muted" style="color: #ffe06699 !important;">User:</small><br>
                                <small><strong>john@example.com</strong></small><br>
                                <small class="text-muted" style="color: #ffe06699 !important;">password123</small>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('foods.index') }}" class="text-decoration-none" style="color: #ffe066; text-shadow: 0 0 8px #ffe06699;">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 