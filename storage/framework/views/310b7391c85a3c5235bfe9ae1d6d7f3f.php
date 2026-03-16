

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<!-- Header Section dengan motif batik -->
<div class="mb-8 relative">
    <div class="absolute inset-0 bg-pattern opacity-5"></div>
    <h1 class="text-3xl md:text-4xl font-playfair font-bold text-sogan mb-2">Dashboard</h1>
    <p class="text-sogan/70">Selamat datang kembali, <span class="font-semibold"><?php echo e(auth()->user()->name); ?></span>! Berikut ringkasan inventory hari ini.</p>
</div>

<!-- Statistik Cards dengan data dinamis -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Sparepart Card -->
    <div class="stat-card-gradient bg-white rounded-xl shadow-md p-6 hover-lift">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm text-sogan/60 mb-1">Total Sparepart</p>
                <h3 class="text-3xl font-bold text-sogan"><?php echo e(number_format($totalSparepart)); ?></h3>
                <p class="text-xs text-green-600 mt-2">
                    <i class="fas fa-boxes mr-1"></i>
                    Semua sparepart terdaftar
                </p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-sogan to-sogan-light rounded-lg flex items-center justify-center shadow-lg">
                <i class="fas fa-boxes text-white text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-emas/20">
            <div class="flex items-center text-sm">
                <span class="text-sogan/70"><?php echo e($totalKategori ?? '8'); ?> kategori tersedia</span>
                <i class="fas fa-chevron-right ml-auto text-emas"></i>
            </div>
        </div>
    </div>

    <!-- Barang Menipis Card -->
    <div class="stat-card-gradient bg-white rounded-xl shadow-md p-6 hover-lift">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm text-sogan/60 mb-1">Barang Menipis</p>
                <h3 class="text-3xl font-bold <?php echo e($lowStockItems > 0 ? 'text-red-600' : 'text-green-600'); ?>">
                    <?php echo e($lowStockItems); ?>

                </h3>
                <?php if($lowStockItems > 0): ?>
                <p class="text-xs text-red-600 mt-2">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    Perlu restock segera
                </p>
                <?php else: ?>
                <p class="text-xs text-green-600 mt-2">
                    <i class="fas fa-check-circle mr-1"></i>
                    Semua stok aman
                </p>
                <?php endif; ?>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br <?php echo e($lowStockItems > 0 ? 'from-red-500 to-red-600' : 'from-green-500 to-green-600'); ?> rounded-lg flex items-center justify-center shadow-lg">
                <i class="fas fa-<?php echo e($lowStockItems > 0 ? 'exclamation' : 'check'); ?> text-white text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-emas/20">
            <div class="flex items-center text-sm">
                <span class="text-sogan/70"><?php echo e($lowStockSpareparts->count()); ?> item di bawah minimum</span>
                <i class="fas fa-chevron-right ml-auto text-emas"></i>
            </div>
        </div>
    </div>

    <!-- Penjualan Hari Ini Card -->
    <div class="stat-card-gradient bg-white rounded-xl shadow-md p-6 hover-lift">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm text-sogan/60 mb-1">Penjualan Hari Ini</p>
                <h3 class="text-3xl font-bold text-emas">Rp <?php echo e(number_format($todaySales, 0, ',', '.')); ?></h3>
                <p class="text-xs text-green-600 mt-2">
                    <i class="fas fa-shopping-cart mr-1"></i>
                    <?php echo e($todayTransactions); ?> transaksi
                </p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-emas to-emas-dark rounded-lg flex items-center justify-center shadow-lg">
                <i class="fas fa-shopping-cart text-white text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-emas/20">
            <div class="flex items-center text-sm">
                <span class="text-sogan/70">Target: Rp 3.000.000</span>
                <span class="ml-auto text-emas"><?php echo e(round(($todaySales/3000000)*100)); ?>%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                <div class="bg-emas h-1.5 rounded-full" style="width: <?php echo e(min(($todaySales/3000000)*100, 100)); ?>%"></div>
            </div>
        </div>
    </div>

    <!-- Total Transaksi Card -->
    <div class="stat-card-gradient bg-white rounded-xl shadow-md p-6 hover-lift">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm text-sogan/60 mb-1">Total Transaksi</p>
                <h3 class="text-3xl font-bold text-sogan"><?php echo e($todayTransactions); ?></h3>
                <p class="text-xs text-purple-600 mt-2">
                    <i class="fas fa-calendar-day mr-1"></i>
                    Hari ini
                </p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-700 rounded-lg flex items-center justify-center shadow-lg">
                <i class="fas fa-receipt text-white text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-emas/20">
            <div class="flex items-center text-sm">
                <span class="text-sogan/70">Rp <?php echo e(number_format($totalBulanIni ?? 12500000, 0, ',', '.')); ?> total bulan ini</span>
                <i class="fas fa-chevron-right ml-auto text-emas"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <a href="#" class="bg-white rounded-xl p-4 text-center hover:shadow-lg transition-all duration-300 group">
        <div class="w-14 h-14 mx-auto bg-gradient-to-br from-emas/20 to-emas/5 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
            <i class="fas fa-barcode text-2xl text-emas"></i>
        </div>
        <p class="text-sm font-medium text-sogan">Generate Barcode</p>
        <p class="text-xs text-sogan/50 mt-1">Buat barcode baru</p>
    </a>

    <a href="#" class="bg-white rounded-xl p-4 text-center hover:shadow-lg transition-all duration-300 group">
        <div class="w-14 h-14 mx-auto bg-gradient-to-br from-emas/20 to-emas/5 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
            <i class="fas fa-camera text-2xl text-emas"></i>
        </div>
        <p class="text-sm font-medium text-sogan">Scan Barcode</p>
        <p class="text-xs text-sogan/50 mt-1">Stock opname</p>
    </a>

    <a href="#" class="bg-white rounded-xl p-4 text-center hover:shadow-lg transition-all duration-300 group">
        <div class="w-14 h-14 mx-auto bg-gradient-to-br from-emas/20 to-emas/5 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
            <i class="fas fa-cash-register text-2xl text-emas"></i>
        </div>
        <p class="text-sm font-medium text-sogan">Kasir</p>
        <p class="text-xs text-sogan/50 mt-1">Transaksi penjualan</p>
    </a>

    <a href="#" class="bg-white rounded-xl p-4 text-center hover:shadow-lg transition-all duration-300 group">
        <div class="w-14 h-14 mx-auto bg-gradient-to-br from-emas/20 to-emas/5 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
            <i class="fas fa-file-alt text-2xl text-emas"></i>
        </div>
        <p class="text-sm font-medium text-sogan">Laporan</p>
        <p class="text-xs text-sogan/50 mt-1">Lihat rekap</p>
    </a>
</div>

<!-- Grafik dan Tabel -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Grafik Penjualan -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-playfair font-semibold text-sogan">Grafik Penjualan 7 Hari Terakhir</h2>
            <select class="border border-emas/30 rounded-lg px-3 py-1 text-sm bg-white focus:outline-none focus:border-emas">
                <option>Minggu Ini</option>
                <option>Bulan Ini</option>
                <option>Tahun Ini</option>
            </select>
        </div>
        <div class="h-64 flex items-center justify-center bg-gradient-to-br from-emas/5 to-transparent rounded-lg">
            <div class="text-center">
                <i class="fas fa-chart-line text-4xl text-emas/30 mb-2"></i>
                <p class="text-sogan/50">Grafik penjualan akan ditampilkan di sini</p>
                <p class="text-xs text-sogan/40 mt-1">(Integrasi dengan Chart.js)</p>
            </div>
        </div>
    </div>

    <!-- Barang Menipis -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-playfair font-semibold text-sogan">Barang Menipis</h2>
            <?php if($lowStockSpareparts->count() > 0): ?>
            <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full"><?php echo e($lowStockSpareparts->count()); ?> item</span>
            <?php endif; ?>
        </div>

        <div class="space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $lowStockSpareparts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-white rounded-lg hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-exclamation-triangle text-red-500"></i>
                    </div>
                    <div>
                        <p class="font-medium text-sm text-sogan"><?php echo e($item->name); ?></p>
                        <p class="text-xs text-sogan/60">Kode: <?php echo e($item->code); ?></p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-sm font-semibold text-red-600"><?php echo e($item->stock); ?> pcs</span>
                    <p class="text-xs text-sogan/50">Min: <?php echo e($item->min_stock); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-8">
                <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-3">
                    <i class="fas fa-check-circle text-3xl text-green-600"></i>
                </div>
                <p class="text-sogan font-medium">Semua stok aman</p>
                <p class="text-xs text-sogan/50 mt-1">Tidak ada barang yang menipis</p>
            </div>
            <?php endif; ?>
        </div>

        <?php if($lowStockSpareparts->count() > 0): ?>
        <a href="#" class="block text-center mt-6 py-2 text-emas hover:text-sogan transition border-t border-emas/20 pt-4">
            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
        </a>
        <?php endif; ?>
    </div>
</div>

<!-- Tabel Transaksi Terbaru -->
<div class="bg-white rounded-xl shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-playfair font-semibold text-sogan">Transaksi Terbaru</h2>
            <p class="text-xs text-sogan/50 mt-1"><?php echo e($todayTransactions); ?> transaksi hari ini</p>
        </div>
        <a href="#" class="text-emas hover:text-sogan transition flex items-center">
            Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-sogan/5 to-transparent">
                    <th class="text-left py-3 px-4 text-sogan font-semibold text-sm">No. Invoice</th>
                    <th class="text-left py-3 px-4 text-sogan font-semibold text-sm">Pelanggan</th>
                    <th class="text-left py-3 px-4 text-sogan font-semibold text-sm">Tanggal</th>
                    <th class="text-left py-3 px-4 text-sogan font-semibold text-sm">Total</th>
                    <th class="text-left py-3 px-4 text-sogan font-semibold text-sm">Status</th>
                    <th class="text-left py-3 px-4 text-sogan font-semibold text-sm">Kasir</th>
                    <th class="text-left py-3 px-4 text-sogan font-semibold text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-100 hover:bg-emas/5 transition group">
                    <td class="py-3 px-4 font-medium"><?php echo e($transaction['invoice']); ?></td>
                    <td class="py-3 px-4">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-emas/20 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-user text-xs text-emas"></i>
                            </div>
                            <?php echo e($transaction['customer']); ?>

                        </div>
                    </td>
                    <td class="py-3 px-4"><?php echo e($transaction['date']->format('d/m/Y H:i')); ?></td>
                    <td class="py-3 px-4 font-semibold">Rp <?php echo e(number_format($transaction['total'], 0, ',', '.')); ?></td>
                    <td class="py-3 px-4">
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs flex items-center w-fit">
                            <i class="fas fa-check-circle mr-1 text-xs"></i>
                            <?php echo e($transaction['status']); ?>

                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-sogan/20 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-cashier text-xs text-sogan"></i>
                            </div>
                            <?php echo e($transaction['kasir'] ?? 'Admin'); ?>

                        </div>
                    </td>
                    <td class="py-3 px-4">
                        <button class="text-sogan/50 hover:text-emas transition mr-2 tooltip-jawa" data-tooltip="Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="text-sogan/50 hover:text-emas transition tooltip-jawa" data-tooltip="Cetak">
                            <i class="fas fa-print"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center py-8">
                        <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-receipt text-3xl text-gray-400"></i>
                        </div>
                        <p class="text-sogan font-medium">Belum ada transaksi hari ini</p>
                        <p class="text-xs text-sogan/50 mt-1">Transaksi akan muncul di sini</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($recentTransactions->count() > 0): ?>
    <div class="mt-4 pt-4 border-t border-emas/20 flex justify-between items-center">
        <p class="text-xs text-sogan/50">
            Menampilkan <?php echo e($recentTransactions->count()); ?> transaksi terbaru
        </p>
        <div class="flex space-x-2">
            <button class="w-8 h-8 rounded border border-emas/30 text-sogan hover:bg-emas hover:text-white transition">
                <i class="fas fa-chevron-left text-xs"></i>
            </button>
            <button class="w-8 h-8 rounded bg-emas text-white">1</button>
            <button class="w-8 h-8 rounded border border-emas/30 text-sogan hover:bg-emas hover:text-white transition">
                2
            </button>
            <button class="w-8 h-8 rounded border border-emas/30 text-sogan hover:bg-emas hover:text-white transition">
                3
            </button>
            <button class="w-8 h-8 rounded border border-emas/30 text-sogan hover:bg-emas hover:text-white transition">
                <i class="fas fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Informasi Tambahan untuk Admin -->
<?php if(auth()->user()->isAdmin()): ?>
<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Aktivitas User -->
    <div class="bg-gradient-to-br from-sogan/5 to-transparent rounded-xl p-6">
        <h3 class="font-playfair font-semibold text-sogan mb-4 flex items-center">
            <i class="fas fa-users mr-2 text-emas"></i>
            Aktivitas User Hari Ini
        </h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-emas rounded-full flex items-center justify-center text-white text-xs">
                        SA
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Super Admin</p>
                        <p class="text-xs text-sogan/50">Terakhir login: 08:30</p>
                    </div>
                </div>
                <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">Online</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-emas rounded-full flex items-center justify-center text-white text-xs">
                        OM
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Admin</p>
                        <p class="text-xs text-sogan/50">Terakhir login: 08:45</p>
                    </div>
                </div>
                <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">Online</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-sogan/30 rounded-full flex items-center justify-center text-sogan text-xs">
                        K1
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Kasir 1</p>
                        <p class="text-xs text-sogan/50">Terakhir login: 09:15</p>
                    </div>
                </div>
                <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">Online</span>
            </div>
        </div>
    </div>

    <!-- Pengingat -->
    <div class="bg-gradient-to-br from-emas/5 to-transparent rounded-xl p-6">
        <h3 class="font-playfair font-semibold text-sogan mb-4 flex items-center">
            <i class="fas fa-bell mr-2 text-emas"></i>
            Pengingat & Catatan
        </h3>
        <div class="space-y-3">
            <div class="flex items-start p-3 bg-white rounded-lg">
                <i class="fas fa-box text-emas mt-1 mr-3"></i>
                <div>
                    <p class="text-sm font-medium">Restock sparepart</p>
                    <p class="text-xs text-sogan/50">5 item perlu diorder hari ini</p>
                </div>
            </div>
            <div class="flex items-start p-3 bg-white rounded-lg">
                <i class="fas fa-file-invoice text-emas mt-1 mr-3"></i>
                <div>
                    <p class="text-sm font-medium">Laporan bulanan</p>
                    <p class="text-xs text-sogan/50">Buat laporan akhir bulan</p>
                </div>
            </div>
            <div class="flex items-start p-3 bg-white rounded-lg">
                <i class="fas fa-tools text-emas mt-1 mr-3"></i>
                <div>
                    <p class="text-sm font-medium">Stock opname</p>
                    <p class="text-xs text-sogan/50">Jadwal: Jumat, 15 Feb 2026</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Motif batik untuk background */
    .bg-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 5L5 30L30 55L55 30L30 5z' fill='%236b4f3c' fill-opacity='0.03'/%3E%3C/svg%3E");
    }

    /* Animasi untuk card */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(107, 79, 60, 0.2);
    }

    /* Gradient untuk stat card */
    .stat-card-gradient {
        position: relative;
        overflow: hidden;
    }

    .stat-card-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #c19a6b, #6b4f3c, #c19a6b);
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI\OneDrive\Documents\GitHub\SparttaPOS\resources\views/dashboard/index.blade.php ENDPATH**/ ?>