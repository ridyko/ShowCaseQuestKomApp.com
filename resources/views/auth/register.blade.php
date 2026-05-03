@extends('layouts.app')
@section('title', 'Daftar Akun')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Daftar Akun</h1>
            <p class="auth-subtitle">Mulai pamerkan aplikasi terbaik Anda</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <div class="form-input-group">
                    <i class="fas fa-user form-icon"></i>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama Anda" required value="{{ old('name') }}">
                </div>
                @error('name') <small style="color: var(--danger); margin-top: 5px; display: block;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="form-input-group">
                    <i class="fas fa-envelope form-icon"></i>
                    <input type="email" name="email" id="email" class="form-control" placeholder="nama@email.com" required value="{{ old('email') }}">
                </div>
                @error('email') <small style="color: var(--danger); margin-top: 5px; display: block;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="form-input-group">
                    <i class="fas fa-lock form-icon"></i>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 8 karakter" required>
                </div>
                @error('password') <small style="color: var(--danger); margin-top: 5px; display: block;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <div class="form-input-group">
                    <i class="fas fa-shield-alt form-icon"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
        </div>
    </div>
</div>
@endsection
