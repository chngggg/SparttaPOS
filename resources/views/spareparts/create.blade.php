@extends('layouts.app')

@section('title', 'Tambah Sparepart')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-sogan/60">
            <a href="{{ route('dashboard') }}" class="hover:text-emas transition">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('spareparts.index') }}" class="hover:text-emas transition">Sparepart</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-emas">Tambah Sparepart</span>
        </div>
    </div>

    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl md:text-3xl font-playfair font-bold text-sogan">Tambah Sparepart Baru</h1>
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

        <form action="{{ route('spareparts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Informasi Dasar -->
            <div class="border-b border-emas/20 pb-6 mb-6">
                <h3 class="text-lg font-playfair font-semibold text-sogan mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-emas"></i>
                    Informasi Dasar
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode Sparepart dengan tombol generate -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Kode Sparepart <span class="text-red-500">*</span>
                        </label>
                        <div class="flex space-x-2">
                            <input type="text"
                                name="code"
                                id="code-input"
                                value="{{ old('code', $newCode) }}"
                                readonly
                                class="flex-1 px-4 py-2 bg-gray-50 border border-emas/30 rounded-lg text-sogan/70 cursor-not-allowed">
                            <button type="button"
                                id="generate-code-btn"
                                class="px-4 py-2 bg-emas/10 text-emas rounded-lg hover:bg-emas/20 transition flex items-center"
                                title="Generate kode baru">
                                <i class="fas fa-sync-alt mr-2"></i>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-sogan/50">Klik tombol generate untuk membuat kode baru jika kode sudah digunakan</p>
                    </div>

                    <!-- Nama Sparepart -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Nama Sparepart <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="name"
                            value="{{ old('name') }}"
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
                        <select name="category_id" required class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('category_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Brand -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Brand / Merek
                        </label>
                        <input type="text"
                            name="brand"
                            value="{{ old('brand') }}"
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                            placeholder="Contoh: Viar, Motul, Castrol">
                        @error('brand')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- BRAND TYPE - YANG SEBELUMNYA HILANG -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Tipe Brand <span class="text-red-500">*</span>
                        </label>
                        <select name="brand_type" required class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('brand_type') border-red-500 @enderror">
                            <option value="">Pilih Tipe Brand</option>
                            <option value="viar" {{ old('brand_type') == 'viar' ? 'selected' : '' }}>Viar Original</option>
                            <option value="non-viar" {{ old('brand_type') == 'non-viar' ? 'selected' : '' }}>Non-Viar</option>
                            <option value="optional" {{ old('brand_type') == 'optional' ? 'selected' : '' }}>Optional / Aksesoris</option>
                        </select>
                        @error('brand_type')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-sogan/50">Pilih tipe untuk memudahkan filter</p>
                    </div>

                    <!-- Unit -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Satuan <span class="text-red-500">*</span>
                        </label>
                        <select name="unit" required class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                            <option value="">Pilih Satuan</option>
                            <option value="pcs" {{ old('unit') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="box" {{ old('unit') == 'box' ? 'selected' : '' }}>Box</option>
                            <option value="liter" {{ old('unit') == 'liter' ? 'selected' : '' }}>Liter</option>
                            <option value="set" {{ old('unit') == 'set' ? 'selected' : '' }}>Set</option>
                        </select>
                        @error('unit')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi Rak -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Lokasi Rak
                        </label>
                        <input type="text"
                            name="location_rack"
                            value="{{ old('location_rack') }}"
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition"
                            placeholder="Contoh: Rak A-01">
                        @error('location_rack')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
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
                    <!-- Stok Awal -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Stok Awal <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                            name="stock"
                            value="{{ old('stock', 0) }}"
                            min="0"
                            required
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('stock') border-red-500 @enderror">
                        @error('stock')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stok Minimal -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Stok Minimal <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                            name="min_stock"
                            value="{{ old('min_stock', 5) }}"
                            min="0"
                            required
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('min_stock') border-red-500 @enderror">
                        @error('min_stock')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stok Maksimal -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Stok Maksimal
                        </label>
                        <input type="number"
                            name="max_stock"
                            value="{{ old('max_stock') }}"
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
                                value="{{ old('purchase_price') }}"
                                min="0"
                                required
                                class="w-full pl-10 pr-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('purchase_price') border-red-500 @enderror"
                                placeholder="0">
                        </div>
                        @error('purchase_price')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
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
                                value="{{ old('selling_price') }}"
                                min="0"
                                required
                                class="w-full pl-10 pr-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('selling_price') border-red-500 @enderror"
                                placeholder="0">
                        </div>
                        @error('selling_price')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Diskon -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Diskon (%)
                        </label>
                        <input type="number"
                            name="discount"
                            value="{{ old('discount', 0) }}"
                            min="0"
                            max="100"
                            step="0.01"
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('discount') border-red-500 @enderror">
                        @error('discount')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
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
                    <!-- Upload Gambar -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Gambar Sparepart
                        </label>
                        <div class="border-2 border-dashed border-emas/30 rounded-lg p-4 text-center hover:border-emas transition cursor-pointer" id="image-upload-area">
                            <input type="file"
                                name="image"
                                id="image"
                                accept="image/*"
                                class="hidden">
                            <i class="fas fa-cloud-upload-alt text-3xl text-emas/50 mb-2"></i>
                            <p class="text-sm text-sogan/70">Klik atau drag & drop untuk upload gambar</p>
                            <p class="text-xs text-sogan/50 mt-1">Format: JPG, PNG, GIF (Max 2MB)</p>
                            <div id="image-preview" class="mt-3 hidden">
                                <img src="#" alt="Preview" class="max-h-32 mx-auto rounded-lg shadow-md">
                            </div>
                        </div>
                        @error('image')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-medium text-sogan mb-2">
                            Deskripsi
                        </label>
                        <textarea name="description"
                            rows="6"
                            class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition @error('description') border-red-500 @enderror"
                            placeholder="Deskripsi lengkap sparepart...">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
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
                    Simpan Sparepart
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
        const codeInput = document.getElementById('code-input');
        const generateBtn = document.getElementById('generate-code-btn');

        generateBtn.addEventListener('click', function() {
            // Disable button sementara
            generateBtn.disabled = true;
            generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';

            // Request ke server untuk generate kode baru
            fetch('{{ route("spareparts.generate-code") }}')
                .then(response => response.json())
                .then(data => {
                    codeInput.value = data.code;

                    // Enable button kembali
                    generateBtn.disabled = false;
                    generateBtn.innerHTML = '<i class="fas fa-sync-alt mr-2"></i>Generate';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal generate kode');

                    // Enable button kembali
                    generateBtn.disabled = false;
                    generateBtn.innerHTML = '<i class="fas fa-sync-alt mr-2"></i>Generate';
                });
        });
    });

    // Klik untuk upload
    uploadArea.addEventListener('click', function() {
        imageInput.click();
    });

    // Preview gambar setelah dipilih
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            // Validasi ukuran file (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                this.value = '';
                return;
            }

            // Validasi tipe file
            if (!file.type.startsWith('image/')) {
                alert('File harus berupa gambar');
                this.value = '';
                return;
            }

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
            // Validasi ukuran file
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                return;
            }

            imageInput.files = e.dataTransfer.files;
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            alert('File harus berupa gambar');
        }
    });
</script>
@endpush
@endsection