@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-sogan/60">
            <a href="{{ route('dashboard') }}" class="hover:text-emas transition">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('users.index') }}" class="hover:text-emas transition">Manajemen User</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-emas">Edit User</span>
        </div>
    </div>

    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl md:text-3xl font-playfair font-bold text-sogan">Edit User</h1>
            <p class="text-sm text-sogan/60 mt-1">Edit informasi user {{ $user->name }}</p>
        </div>
        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-100 text-sogan rounded-lg hover:bg-gray-200 transition flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <!-- Form Edit User -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Header Form dengan Avatar -->
            <div class="bg-gradient-to-r from-sogan to-sogan-light px-6 py-4">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-emas rounded-full flex items-center justify-center text-2xl font-bold text-sogan border-4 border-white/30">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="ml-4 text-white">
                        <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
                        <p class="text-white/80 text-sm flex items-center mt-1">
                            <span class="px-2 py-0.5 bg-white/20 rounded-full text-xs">
                                {{ $user->role_name }}
                            </span>
                            <span class="mx-2">•</span>
                            <span>{{ $user->email }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Body -->
            <div class="p-6 space-y-6">
                @if($errors->any())
                <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <span class="text-red-700">Ada kesalahan dalam pengisian form.</span>
                    </div>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('success'))
                <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-green-700">{{ session('success') }}</span>
                    </div>
                </div>
                @endif

                <!-- Informasi Dasar -->
                <div class="border-b border-emas/20 pb-6">
                    <h3 class="text-lg font-playfair font-semibold text-sogan mb-4 flex items-center">
                        <i class="fas fa-user-circle mr-2 text-emas"></i>
                        Informasi Dasar
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-sogan mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                required
                                class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('name') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap">
                            @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-sogan mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('email') border-red-500 @enderror"
                                placeholder="contoh@email.com">
                            @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label class="block text-sm font-medium text-sogan mb-2">
                                Nomor Telepon
                            </label>
                            <input type="text"
                                name="phone"
                                value="{{ old('phone', $user->phone) }}"
                                class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                                placeholder="08xxxxxxxxxx">
                        </div>

                        <!-- Role / Jabatan -->
                        <div>
                            <label class="block text-sm font-medium text-sogan mb-2">
                                Role / Jabatan <span class="text-red-500">*</span>
                            </label>
                            <select name="role"
                                required
                                class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('role') border-red-500 @enderror">
                                @foreach($roles as $value => $label)
                                <option value="{{ $value }}" {{ old('role', $user->role) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                            @error('role')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror

                            @if($user->isSuperAdmin())
                            <p class="mt-2 text-xs text-emas flex items-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Super Admin tidak dapat diubah role-nya
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Status Akun -->
                <div class="border-b border-emas/20 pb-6">
                    <h3 class="text-lg font-playfair font-semibold text-sogan mb-4 flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-emas"></i>
                        Status Akun
                    </h3>

                    <div class="flex items-center space-x-6">
                        <!-- Status Aktif -->
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                class="w-5 h-5 text-emas border-emas/30 rounded focus:ring-emas focus:ring-2">
                            <span class="text-sm text-sogan">Akun Aktif</span>
                        </label>

                        <!-- Tampilkan status saat ini -->
                        <div class="flex items-center">
                            <span class="text-sm text-sogan/70 mr-2">Status saat ini:</span>
                            @if($user->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs flex items-center">
                                <i class="fas fa-circle text-xs mr-1"></i> Aktif
                            </span>
                            @else
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs flex items-center">
                                <i class="fas fa-circle text-xs mr-1"></i> Nonaktif
                            </span>
                            @endif
                        </div>
                    </div>

                    @if($user->isAdmin() && !auth()->user()->isSuperAdmin())
                    <p class="mt-2 text-xs text-emas bg-emas/5 p-2 rounded-lg">
                        <i class="fas fa-info-circle mr-1"></i>
                        Anda tidak dapat mengubah status Admin. Hanya Super Admin yang dapat mengubah status Admin.
                    </p>
                    @endif
                </div>

                <!-- Ubah Password -->
                <div class="border-b border-emas/20 pb-6">
                    <h3 class="text-lg font-playfair font-semibold text-sogan mb-4 flex items-center">
                        <i class="fas fa-key mr-2 text-emas"></i>
                        Ubah Password
                    </h3>

                    <div class="bg-emas/5 p-4 rounded-lg mb-4">
                        <p class="text-sm text-sogan/70 flex items-center">
                            <i class="fas fa-info-circle text-emas mr-2"></i>
                            Kosongkan jika tidak ingin mengubah password
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password Baru -->
                        <div>
                            <label class="block text-sm font-medium text-sogan mb-2">
                                Password Baru
                            </label>
                            <input type="password"
                                name="password"
                                class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                                placeholder="Minimal 8 karakter">
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label class="block text-sm font-medium text-sogan mb-2">
                                Konfirmasi Password Baru
                            </label>
                            <input type="password"
                                name="password_confirmation"
                                class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                                placeholder="Ketik ulang password">
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-sm font-semibold text-sogan mb-3 flex items-center">
                        <i class="fas fa-clock mr-2 text-emas"></i>
                        Informasi Sistem
                    </h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-sogan/60">Dibuat pada:</span>
                            <span class="ml-2 text-sogan font-medium">{{ $user->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-sogan/60">Terakhir update:</span>
                            <span class="ml-2 text-sogan font-medium">{{ $user->updated_at->format('d M Y H:i') }}</span>
                        </div>
                        @if($user->creator)
                        <div class="col-span-2">
                            <span class="text-sogan/60">Dibuat oleh:</span>
                            <span class="ml-2 text-sogan font-medium">{{ $user->creator->name }} ({{ $user->creator->role_name }})</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Tombol Action -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('users.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-emas text-sogan rounded-lg hover:bg-emas-dark transition flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Warning untuk Super Admin -->
    @if($user->isSuperAdmin())
    <div class="mt-4 p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg">
        <div class="flex">
            <i class="fas fa-exclamation-triangle text-yellow-600 mr-3 mt-0.5"></i>
            <div>
                <h4 class="text-sm font-semibold text-yellow-800">Perhatian: Super Admin</h4>
                <p class="text-sm text-yellow-700 mt-1">
                    Anda sedang mengedit akun Super Admin. Beberapa perubahan mungkin dibatasi untuk keamanan sistem.
                </p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    /* Custom styles untuk form */
    input[type="checkbox"] {
        accent-color: #c19a6b;
    }
</style>
@endpush