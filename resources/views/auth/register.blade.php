@extends('layouts.app')
@section('title', 'Daftar Akun')

@push('styles')
<style>
    .neo-input {
        width: 100%;
        background: #FFFFFF !important;
        border: 2px solid #1C1917 !important;
        border-radius: 12px;
        padding: 14px 14px 14px 44px;
        font-size: 0.875rem;
        color: #1C1917 !important;
        outline: none;
        box-shadow: 2px 2px 0px 0px rgba(28,25,23,1);
        transition: all .15s ease;
    }
    .neo-input:focus {
        transform: translate(1px, 1px);
        box-shadow: 0px 0px 0px 0px rgba(28,25,23,1);
    }
    ::placeholder { color: #A8A29E !important; }
</style>
@endpush

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-24">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-[#FDE047] border-2 border-stone-900 rounded-2xl flex items-center justify-center text-xl mx-auto mb-4 shadow-[3px_3px_0px_0px_rgba(28,25,23,1)]">
                <i class="fas fa-cube"></i>
            </div>
            <h1 class="font-display text-3xl font-black mb-1 uppercase tracking-tight">Daftar Akun</h1>
            <p class="text-stone-600 text-sm font-bold">Mulai pamerkan aplikasi terbaik Anda</p>
        </div>

        <div class="bg-white border-2 border-stone-900 rounded-3xl p-8 shadow-[6px_6px_0px_0px_rgba(28,25,23,1)]">
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-stone-700 text-sm"></i>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            placeholder="Nama Anda"
                            class="neo-input {{ $errors->has('name') ? '!border-red-500' : '' }}">
                    </div>
                    @error('name')
                    <p class="text-red-600 text-xs mt-1.5 font-bold"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-stone-700 text-sm"></i>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            class="neo-input {{ $errors->has('email') ? '!border-red-500' : '' }}">
                    </div>
                    @error('email')
                    <p class="text-red-600 text-xs mt-1.5 font-bold"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-stone-700 text-sm"></i>
                        <input type="password" name="password" id="password" required
                            placeholder="Minimal 8 karakter"
                            class="neo-input {{ $errors->has('password') ? '!border-red-500' : '' }}">
                    </div>
                    @error('password')
                    <p class="text-red-600 text-xs mt-1.5 font-bold"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <i class="fas fa-shield-alt absolute left-4 top-1/2 -translate-y-1/2 text-stone-700 text-sm"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            placeholder="Ulangi password"
                            class="neo-input">
                    </div>
                </div>

                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#FDE047] border-2 border-stone-900 hover:bg-[#FACC15] text-stone-900 font-black py-3.5 rounded-xl transition shadow-[3px_3px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[1px_1px_0px_0px_rgba(28,25,23,1)] text-xs uppercase tracking-wider">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <span class="text-stone-600 text-xs font-bold uppercase tracking-wider">Sudah punya akun? </span>
            <a href="{{ route('login') }}" class="text-stone-900 hover:text-stone-700 text-xs font-black uppercase tracking-wider underline decoration-2 transition">
                Masuk di sini
            </a>
        </div>
    </div>
</div>
@endsection
