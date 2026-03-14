@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-sogan/60">
            <a href="{{ route('dashboard') }}" class="hover:text-emas transition">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('categories.index') }}" class="hover:text-emas transition">Kategori</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-emas">Tambah Kategori</span>
        </div>
    </div>

    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl md:text-3xl font-playfair font-bold text-sogan">Tambah Kategori Baru</h1>
        <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-100 text-sogan rounded-lg hover:bg-gray-200 transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-md p-6">
        @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
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

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <!-- Nama Kategori -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-sogan mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('name') border-red-500 @enderror"
                    placeholder="Contoh: Oli & Pelumas">
                @error('name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Icon -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-sogan mb-2">
                    Icon (Font Awesome)
                </label>
                <div class="flex space-x-2">
                    <input type="text"
                        name="icon"
                        id="icon-input"
                        value="{{ old('icon') }}"
                        class="flex-1 px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                        placeholder="Contoh: oil-can, filter, bolt">
                    <div class="w-12 h-12 bg-emas/10 rounded-lg flex items-center justify-center text-2xl text-emas" id="icon-preview">
                        <i class="fas fa-tag"></i>
                    </div>
                </div>
                <p class="mt-1 text-xs text-sogan/50">
                    <i class="fas fa-info-circle"></i>
                    Nama icon dari Font Awesome (contoh: oil-can, filter, bolt, chain, tire, lightbulb, crown, gift)
                </p>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-sogan mb-2">
                    Deskripsi
                </label>
                <textarea name="description"
                    rows="4"
                    class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                    placeholder="Deskripsi kategori...">{{ old('description') }}</textarea>
            </div>

            <!-- Status Aktif -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-5 h-5 text-emas border-emas/30 rounded focus:ring-emas">
                    <span class="text-sm text-sogan">Aktifkan Kategori</span>
                </label>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('categories.index') }}"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-emas text-sogan rounded-lg hover:bg-emas-dark transition flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const iconInput = document.getElementById('icon-input');
        const iconPreview = document.getElementById('icon-preview').querySelector('i');

        iconInput.addEventListener('input', function() {
            const iconName = this.value.trim();
            if (iconName) {
                iconPreview.className = `fas fa-${iconName}`;
            } else {
                iconPreview.className = 'fas fa-tag';
            }
        });
    });
</script>
@endpush
@endsection