@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('users.index') }}" class="text-sogan/70 hover:text-emas transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Manajemen User
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md p-8">
        <h2 class="text-2xl font-playfair font-bold text-sogan mb-6">Tambah User Baru</h2>

        @if($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded">
            <ul class="list-disc list-inside text-red-600">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                <!-- Nama -->
                <div>
                    <label class="block text-sogan font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                        placeholder="Masukkan nama lengkap">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sogan font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                        placeholder="contoh@email.com">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sogan font-medium mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                        placeholder="08xxxxxxxxxx">
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sogan font-medium mb-2">Role / Jabatan</label>
                    <select name="role" required class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                        @foreach($roles as $value => $label)
                        <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sogan font-medium mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                        placeholder="Minimal 8 karakter">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sogan font-medium mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                        placeholder="Ketik ulang password">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-3 mt-6">
                    <a href="{{ route('users.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-emas text-sogan rounded-lg hover:bg-emas-dark transition">
                        <i class="fas fa-save mr-2"></i>
                        Simpan User
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Info Tambahan -->
    <div class="mt-6 p-4 bg-emas/10 rounded-lg border border-emas/20">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-emas mt-1 mr-3"></i>
            <div class="text-sm text-sogan/80">
                <p class="font-medium mb-1">Informasi Role:</p>
                <ul class="list-disc list-inside space-y-1">
                    @if(Auth::user()->isSuperAdmin())
                    <li><span class="font-semibold">Admin:</span> Dapat mengelola user dan melihat semua laporan</li>
                    @endif
                    <li><span class="font-semibold">Kasir:</span> Hanya bisa mengakses penjualan dan scan barcode</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection