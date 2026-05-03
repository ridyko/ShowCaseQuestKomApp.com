@extends('layouts.app')
@section('title', 'Masuk Admin')

@push('styles')
<style>
    .dark-input {
        width: 100%;
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 14px 14px 14px 44px;
        font-size: 0.875rem;
        color: #ffffff !important;
        outline: none;
        transition: border-color .2s;
        -webkit-text-fill-color: #ffffff !important;
    }
    .dark-input:focus { border-color: #6366f1; background: rgba(99,102,241,0.08) !important; }
    .dark-input:-webkit-autofill,
    .dark-input:-webkit-autofill:hover,
    .dark-input:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0 1000px #1a1f2e inset !important;
        -webkit-text-fill-color: #ffffff !important;
        caret-color: #ffffff;
        border-color: rgba(255,255,255,0.1);
    }
    ::placeholder { color: rgba(255,255,255,0.25) !important; }
</style>
@endpush

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-20">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-brand rounded-2xl flex items-center justify-center text-xl mx-auto mb-4 shadow-xl shadow-brand/30">
                <i class="fas fa-rocket"></i>
            </div>
            <h1 class="text-2xl font-black mb-1">Selamat Datang</h1>
            <p class="text-white/40 text-sm">Masuk ke panel admin Showcase</p>
        </div>

        <div class="bg-[#161b27] border border-white/7 rounded-2xl p-8">
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-white/50 uppercase tracking-widest mb-2">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-sm"></i>
                        <input type="email" name="email" required value="{{ old('email') }}" autofocus
                            placeholder="admin@email.com"
                            class="dark-input {{ $errors->has('email') ? '!border-red-500/50' : '' }}">
                    </div>
                    @error('email')
                    <p class="text-red-400 text-xs mt-1.5"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-white/50 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-sm"></i>
                        <input type="password" name="password" required
                            placeholder="Masukkan password"
                            class="dark-input {{ $errors->has('password') ? '!border-red-500/50' : '' }}">
                    </div>
                    @error('password')
                    <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2.5">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 accent-brand rounded">
                    <label for="remember" class="text-sm text-white/40 cursor-pointer">Ingat saya</label>
                </div>

                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-brand hover:bg-brand-dark text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-brand/25 text-sm">
                    <i class="fas fa-sign-in-alt"></i> Masuk Sekarang
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-white/30 hover:text-white text-sm transition">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
