@extends('layouts.app')

@section('title', 'Edit Sparepart')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-sogan/60">
            <a href="{{ route('dashboard') }}" class="hover:text-emas transition">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('spareparts.index') }}" class="hover:text-emas transition">Sparepart</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-emas">Edit: {{ $sparepart->name }}</span>
        </div>
    </div>

    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl md:text-3xl font-playfair font-bold text-sogan">Edit Sparepart</h1>
        <a href="{{ route('spareparts.index') }}" class="px-4 py-2 bg-gray-100 text-sogan rounded-lg hover:bg-gray-200 transition">
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

        <form action="{{ route('spareparts.update', $sparepart) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Informasi Dasar -->
            <div class="border-b border-emas/20 pb-6 mb-6">
                <h3 class="text-lg font-playfair font-semibold text-sogan mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-emas"></i>
                    Informasi Dasar
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode Sparepart (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Kode Sparepart
                        </label>
                        <input type="text"
                            value="{{ $sparepart->code }}"
                            readonly
                            class="w-full px-4 py-2 bg-gray-50 border border-emas/30 rounded-lg text-sogan/70 cursor-not-allowed">
                    </div>

                    <!-- Nama Sparepart -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Nama Sparepart <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="name"
                            value="{{ old('name', $sparepart->name) }}"
                            required
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('name') border-red-500 @enderror"
                            placeholder="Contoh: Oli Samping Viar Original">
                        @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id" required class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $sparepart->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brand -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Brand / Merek
                        </label>
                        <input type="text"
                            name="brand"
                            value="{{ old('brand', $sparepart->brand) }}"
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                            placeholder="Contoh: Viar, Motul, Castrol">
                    </div>

                    <!-- Brand Type -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Tipe Brand <span class="text-red-500">*</span>
                        </label>
                        <select name="brand_type" required class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                            <option value="viar" {{ old('brand_type', $sparepart->brand_type) == 'viar' ? 'selected' : '' }}>Viar Original</option>
                            <option value="non-viar" {{ old('brand_type', $sparepart->brand_type) == 'non-viar' ? 'selected' : '' }}>Non-Viar</option>
                            <option value="optional" {{ old('brand_type', $sparepart->brand_type) == 'optional' ? 'selected' : '' }}>Optional / Aksesoris</option>
                        </select>
                    </div>

                    <!-- Unit -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Satuan <span class="text-red-500">*</span>
                        </label>
                        <select name="unit" required class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                            <option value="pcs" {{ old('unit', $sparepart->unit) == 'pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="box" {{ old('unit', $sparepart->unit) == 'box' ? 'selected' : '' }}>Box</option>
                            <option value="liter" {{ old('unit', $sparepart->unit) == 'liter' ? 'selected' : '' }}>Liter</option>
                            <option value="set" {{ old('unit', $sparepart->unit) == 'set' ? 'selected' : '' }}>Set</option>
                        </select>
                    </div>

                    <!-- Lokasi Rak -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Lokasi Rak
                        </label>
                        <input type="text"
                            name="location_rack"
                            value="{{ old('location_rack', $sparepart->location_rack) }}"
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                            placeholder="Contoh: Rak A-01">
                    </div>
                </div>
            </div>

            <!-- Stok dan Harga -->
            <div class="border-b border-emas/20 pb-6 mb-6">
                <h3 class="text-lg font-playfair font-semibold text-sogan mb-4 flex items-center">
                    <i class="fas fa-chart-line mr-2 text-emas"></i>
                    Stok dan Harga
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Stok -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                            name="stock"
                            value="{{ old('stock', $sparepart->stock) }}"
                            min="0"
                            required
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                    </div>

                    <!-- Stok Minimal -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Stok Minimal <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                            name="min_stock"
                            value="{{ old('min_stock', $sparepart->min_stock) }}"
                            min="0"
                            required
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                    </div>

                    <!-- Stok Maksimal -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Stok Maksimal
                        </label>
                        <input type="number"
                            name="max_stock"
                            value="{{ old('max_stock', $sparepart->max_stock) }}"
                            min="0"
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                    </div>

                    <!-- Harga Beli -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Harga Beli <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sogan/50">Rp</span>
                            <input type="number"
                                name="purchase_price"
                                value="{{ old('purchase_price', $sparepart->purchase_price) }}"
                                min="0"
                                required
                                class="w-full pl-10 pr-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                                placeholder="0">
                        </div>
                    </div>

                    <!-- Harga Jual -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Harga Jual <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sogan/50">Rp</span>
                            <input type="number"
                                name="selling_price"
                                value="{{ old('selling_price', $sparepart->selling_price) }}"
                                min="0"
                                required
                                class="w-full pl-10 pr-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                                placeholder="0">
                        </div>
                    </div>

                    <!-- Diskon -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Diskon (%)
                        </label>
                        <input type="number"
                            name="discount"
                            value="{{ old('discount', $sparepart->discount) }}"
                            min="0"
                            max="100"
                            step="0.01"
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Gambar dan Deskripsi -->
            <div class="border-b border-emas/20 pb-6 mb-6">
                <h3 class="text-lg font-playfair font-semibold text-sogan mb-4 flex items-center">
                    <i class="fas fa-image mr-2 text-emas"></i>
                    Gambar dan Deskripsi
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Gambar Saat Ini & Upload Baru -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Gambar Saat Ini
                        </label>
                        @if($sparepart->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/spareparts/' . $sparepart->image) }}"
                                alt="{{ $sparepart->name }}"
                                class="h-32 w-32 object-cover rounded-lg border border-emas/30">
                        </div>
                        @else
                        <p class="text-sm text-sogan/50 mb-3">Belum ada gambar</p>
                        @endif

                        <label class="block text-sm font-medium text-sogan mb-2">
                            Upload Gambar Baru
                        </label>
                        <div class="border-2 border-dashed border-emas/30 rounded-lg p-4 text-center hover:border-emas transition cursor-pointer" id="image-upload-area">
                            <input type="file"
                                name="image"
                                id="image"
                                accept="image/*"
                                class="hidden">
                            <i class="fas fa-cloud-upload-alt text-3xl text-emas/50 mb-2"></i>
                            <p class="text-sm text-sogan/70">Klik untuk upload gambar</p>
                            <p class="text-xs text-sogan/50 mt-1">Format: JPG, PNG, GIF (Max 2MB)</p>
                            <div id="image-preview" class="mt-3 hidden">
                                <img src="#" alt="Preview" class="max-h-32 mx-auto rounded-lg">
                            </div>
                        </div>
                        <p class="text-xs text-sogan/50 mt-2">
                            <i class="fas fa-info-circle"></i>
                            Kosongkan jika tidak ingin mengubah gambar
                        </p>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Deskripsi
                        </label>
                        <textarea name="description"
                            rows="8"
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                            placeholder="Deskripsi lengkap sparepart...">{{ old('description', $sparepart->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Status Aktif -->
            <div class="border-b border-emas/20 pb-6 mb-6">
                <h3 class="text-lg font-playfair font-semibold text-sogan mb-4 flex items-center">
                    <i class="fas fa-toggle-on mr-2 text-emas"></i>
                    Status
                </h3>

                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $sparepart->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 text-emas border-emas/30 rounded focus:ring-emas">
                        <span class="text-sm text-sogan">Aktifkan Sparepart</span>
                    </label>
                    <span class="text-xs text-sogan/50">
                        (Nonaktifkan jika barang tidak dijual sementara)
                    </span>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('spareparts.index') }}"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-emas text-sogan rounded-lg hover:bg-emas-dark transition flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Update Sparepart
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('image-upload-area');
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImg = imagePreview.querySelector('img');

        uploadArea.addEventListener('click', function() {
            imageInput.click();
        });

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-emas', 'bg-emas/5');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('border-emas', 'bg-emas/5');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('border-emas', 'bg-emas/5');

            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                imageInput.files = e.dataTransfer.files;
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
@endsection