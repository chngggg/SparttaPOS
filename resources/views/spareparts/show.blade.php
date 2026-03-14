@extends('layouts.app')

@section('title', 'Detail Sparepart')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-sogan/60">
            <a href="{{ route('dashboard') }}" class="hover:text-emas transition">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('spareparts.index') }}" class="hover:text-emas transition">Sparepart</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-emas">{{ $sparepart->name }}</span>
        </div>
    </div>

    <!-- Header dengan Tombol Aksi -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-playfair font-bold text-sogan">Detail Sparepart</h1>
            <p class="text-sogan/70">Informasi lengkap sparepart</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('spareparts.edit', $sparepart) }}"
                class="inline-flex items-center px-4 py-2 bg-emas text-sogan rounded-lg hover:bg-emas-dark transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                <i class="fas fa-edit mr-2"></i>
                Edit Sparepart
            </a>
            <a href="{{ route('spareparts.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 text-sogan rounded-lg hover:bg-gray-200 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Image & Barcode -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <!-- Image -->
                <div class="aspect-square rounded-lg overflow-hidden bg-gray-100 mb-4 border border-emas/20">
                    @if($sparepart->image)
                    <img src="{{ asset('storage/spareparts/' . $sparepart->image) }}"
                        alt="{{ $sparepart->name }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-sogan/30">
                        <i class="fas fa-image text-6xl mb-2"></i>
                        <span class="text-sm">Belum ada gambar</span>
                    </div>
                    @endif
                </div>

                <!-- Barcode -->
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="mb-2 flex justify-center">
                        @if(isset($barcode))
                        {!! $barcode !!}
                        @else
                        <img src="https://barcode.tec-it.com/barcode.ashx?data={{ $sparepart->code }}&code=Code128&dpi=96"
                            alt="Barcode"
                            class="h-16">
                        @endif
                    </div>
                    <p class="text-sm font-mono font-bold text-sogan">{{ $sparepart->code }}</p>
                    <button onclick="window.print()"
                        class="mt-3 text-xs text-emas hover:text-sogan transition inline-flex items-center">
                        <i class="fas fa-print mr-1"></i> Print Barcode
                    </button>
                </div>

                <!-- Rak Location -->
                @if($sparepart->location_rack)
                <div class="mt-4 p-3 bg-emas/5 rounded-lg text-center">
                    <i class="fas fa-map-pin text-emas mr-1"></i>
                    <span class="text-sm text-sogan">Lokasi Rak: <strong>{{ $sparepart->location_rack }}</strong></span>
                </div>
                @endif
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6">
                <!-- Status Badges -->
                <div class="flex flex-wrap gap-2 mb-6">
                    <!-- Brand Type Badge (menggunakan attribute dari model) -->
                    <span class="px-3 py-1.5 rounded-full text-sm font-medium {{ $sparepart->brand_type_color }}">
                        <i class="fas 
            @if($sparepart->brand_type == 'viar') fa-check-circle
            @elseif($sparepart->brand_type == 'non-viar') fa-star
            @else fa-gift @endif mr-1">
                        </i>
                        {{ $sparepart->brand_type_label }}
                    </span>

                    <!-- Active Status -->
                    @if($sparepart->is_active)
                    <span class="px-3 py-1.5 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                        <i class="fas fa-check-circle mr-1"></i> Aktif
                    </span>
                    @else
                    <span class="px-3 py-1.5 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                        <i class="fas fa-times-circle mr-1"></i> Nonaktif
                    </span>
                    @endif

                    <!-- Stock Status (menggunakan attribute dari model) -->
                    @php $status = $sparepart->stock_status_label; @endphp
                    <span class="px-3 py-1.5 bg-{{ $status['color'] }}-100 text-{{ $status['color'] }}-700 rounded-full text-sm font-medium">
                        <i class="fas fa-box mr-1"></i> {{ $status['label'] }}
                    </span>
                </div>

                <!-- Nama Sparepart -->
                <div class="mb-6 pb-6 border-b border-emas/20">
                    <h2 class="text-2xl font-playfair font-bold text-sogan">{{ $sparepart->name }}</h2>
                    @if($sparepart->brand)
                    <p class="text-sogan/60 mt-1">Merek: <span class="font-medium">{{ $sparepart->brand }}</span></p>
                    @endif
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-xs text-sogan/50 uppercase tracking-wider">Kode Sparepart</label>
                        <p class="text-lg font-mono font-semibold text-sogan mt-1">{{ $sparepart->code }}</p>
                    </div>

                    <!-- Barcode Number -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-xs text-sogan/50 uppercase tracking-wider">Nomor Barcode</label>
                        <p class="text-lg font-mono font-semibold text-sogan mt-1">{{ $sparepart->barcode ?? '-' }}</p>
                    </div>

                    <!-- Kategori -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-xs text-sogan/50 uppercase tracking-wider">Kategori</label>
                        <p class="text-lg font-semibold text-sogan mt-1 flex items-center">
                            @if($sparepart->category && $sparepart->category->icon)
                            <i class="fas fa-{{ $sparepart->category->icon }} text-emas mr-2"></i>
                            @endif
                            {{ $sparepart->category->name ?? '-' }}
                        </p>
                    </div>

                    <!-- Supplier -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-xs text-sogan/50 uppercase tracking-wider">Supplier</label>
                        <p class="text-lg font-semibold text-sogan mt-1">{{ $sparepart->supplier->name ?? '-' }}</p>
                    </div>

                    <!-- Satuan -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-xs text-sogan/50 uppercase tracking-wider">Satuan</label>
                        <p class="text-lg font-semibold text-sogan mt-1">{{ strtoupper($sparepart->unit) }}</p>
                    </div>

                    <!-- Model -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-xs text-sogan/50 uppercase tracking-wider">Model</label>
                        <p class="text-lg font-semibold text-sogan mt-1">{{ $sparepart->model ?? '-' }}</p>
                    </div>
                </div>

                <!-- Stok dan Harga -->
                <div class="mt-6 pt-6 border-t border-emas/20">
                    <h3 class="text-lg font-playfair font-semibold text-sogan mb-4 flex items-center">
                        <i class="fas fa-chart-line mr-2 text-emas"></i>
                        Informasi Stok & Harga
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Stok Card -->
                        <div class="bg-gradient-to-br from-sogan/5 to-transparent p-4 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-sogan/60">Stok Saat Ini</span>
                                <i class="fas fa-boxes text-emas"></i>
                            </div>
                            <p class="text-3xl font-bold {{ $sparepart->stock <= $sparepart->min_stock ? 'text-red-600' : 'text-green-600' }}">
                                {{ $sparepart->stock }}
                            </p>
                            <div class="flex justify-between text-xs text-sogan/50 mt-2">
                                <span>Min: {{ $sparepart->min_stock }}</span>
                                @if($sparepart->max_stock)
                                <span>Max: {{ $sparepart->max_stock }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Harga Beli -->
                        <div class="bg-gradient-to-br from-sogan/5 to-transparent p-4 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-sogan/60">Harga Beli</span>
                                <i class="fas fa-shopping-cart text-emas"></i>
                            </div>
                            <p class="text-2xl font-bold text-sogan">
                                Rp {{ number_format($sparepart->purchase_price, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Harga Jual -->
                        <div class="bg-gradient-to-br from-emas/10 to-transparent p-4 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-sogan/60">Harga Jual</span>
                                <i class="fas fa-tag text-emas"></i>
                            </div>
                            <p class="text-2xl font-bold text-emas">
                                Rp {{ number_format($sparepart->selling_price, 0, ',', '.') }}
                            </p>
                            @if($sparepart->discount > 0)
                            <p class="text-xs text-green-600 mt-1">
                                Diskon {{ $sparepart->discount }}%
                            </p>
                            @endif
                        </div>
                    </div>

                    <!-- Profit Margin -->
                    @php
                    $profit = $sparepart->selling_price - $sparepart->purchase_price;
                    $margin = $sparepart->purchase_price > 0
                    ? round(($profit / $sparepart->purchase_price) * 100, 2)
                    : 0;
                    @endphp
                    <div class="mt-4 p-4 bg-emas/5 rounded-lg flex items-center justify-between">
                        <span class="text-sm text-sogan/70">Estimasi Keuntungan:</span>
                        <span class="text-lg font-semibold text-green-600">
                            Rp {{ number_format($profit, 0, ',', '.') }}
                            <span class="text-sm text-sogan/50 ml-2">({{ $margin }}%)</span>
                        </span>
                    </div>
                </div>

                <!-- Deskripsi -->
                @if($sparepart->description)
                <div class="mt-6 pt-6 border-t border-emas/20">
                    <h3 class="text-lg font-playfair font-semibold text-sogan mb-4 flex items-center">
                        <i class="fas fa-align-left mr-2 text-emas"></i>
                        Deskripsi
                    </h3>
                    <div class="p-4 bg-gray-50 rounded-lg text-sogan/80 whitespace-pre-line">
                        {{ $sparepart->description }}
                    </div>
                </div>
                @endif

                <!-- Timestamps -->
                <div class="mt-6 pt-6 border-t border-emas/20">
                    <div class="flex flex-wrap gap-4 text-xs text-sogan/50">
                        <div>
                            <i class="far fa-calendar-alt mr-1"></i>
                            Dibuat: {{ $sparepart->created_at->format('d M Y H:i') }}
                        </div>
                        <div>
                            <i class="far fa-clock mr-1"></i>
                            Diupdate: {{ $sparepart->updated_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection