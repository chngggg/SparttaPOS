

<?php $__env->startSection('title', 'Daftar Sparepart'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-page">
    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl md:text-4xl font-playfair font-bold text-sogan mb-2">Daftar Sparepart</h1>
            <p class="text-sogan/70">Kelola semua sparepart dalam inventory.</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="<?php echo e(route('spareparts.create')); ?>"
                class="inline-flex items-center px-4 py-2 bg-emas text-sogan rounded-lg hover:bg-emas-dark transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                <i class="fas fa-plus mr-2"></i>
                Tambah Sparepart
            </a>
            <a href="<?php echo e(route('categories.index')); ?>"
                class="inline-flex items-center px-4 py-2 border border-emas text-emas rounded-lg hover:bg-emas/10 transition-all duration-200">
                <i class="fas fa-tags mr-2"></i>
                Kelola Kategori
            </a>
        </div>
    </div>

    <!-- Filter dan Search -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
        <form method="GET" action="<?php echo e(route('spareparts.index')); ?>" class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text"
                        name="search"
                        value="<?php echo e(request('search')); ?>"
                        placeholder="Cari nama, kode, atau brand..."
                        class="w-full pl-10 pr-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-sogan/40"></i>
                </div>
            </div>

            <!-- Filter Category -->
            <div class="md:w-48">
                <select name="category" class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Filter Stock Status -->
            <div class="md:w-48">
                <select name="stock_status" class="w-full px-4 py-2 border border-emas/30 rounded-lg focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition">
                    <option value="">Semua Stok</option>
                    <option value="low" <?php echo e(request('stock_status') == 'low' ? 'selected' : ''); ?>>Stok Menipis</option>
                    <option value="out" <?php echo e(request('stock_status') == 'out' ? 'selected' : ''); ?>>Stok Habis</option>
                    <option value="active" <?php echo e(request('stock_status') == 'active' ? 'selected' : ''); ?>>Aktif</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="px-6 py-2 bg-sogan text-krem rounded-lg hover:bg-sogan-light transition-all duration-200">
                <i class="fas fa-filter mr-2"></i>
                Filter
            </button>
        </form>
    </div>

    <!-- Tabel Sparepart -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-sogan/10">
                    <tr>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Kode</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Nama Sparepart</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Kategori</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Brand</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Stok</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Harga Jual</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Status</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $spareparts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b border-gray-100 hover:bg-emas/5 transition">
                        <td class="py-4 px-6">
                            <span class="font-mono text-sm"><?php echo e($item->code); ?></span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-medium"><?php echo e($item->name); ?></p>
                                <p class="text-xs text-sogan/50"><?php echo e($item->brand); ?></p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 bg-emas/10 text-emas rounded-full text-xs">
                                <?php echo e($item->category->name ?? '-'); ?>

                            </span>
                        </td>
                        <td class="py-4 px-6"><?php echo e($item->brand ?? '-'); ?></td>
                        <td class="py-4 px-6">
                            <?php if($item->stock_status == 'low_stock'): ?>
                            <span class="text-red-600 font-semibold"><?php echo e($item->stock); ?></span>
                            <span class="text-xs text-sogan/50">/ min <?php echo e($item->min_stock); ?></span>
                            <?php elseif($item->stock_status == 'out_of_stock'): ?>
                            <span class="text-red-600 font-semibold">Habis</span>
                            <?php else: ?>
                            <span class="text-green-600"><?php echo e($item->stock); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-6 font-semibold">Rp <?php echo e(number_format($item->selling_price, 0, ',', '.')); ?></td>
                        <td class="py-4 px-6">
                            <?php if($item->is_active): ?>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">Aktif</span>
                            <?php else: ?>
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex space-x-2">
                                <a href="<?php echo e(route('spareparts.show', $item->slug)); ?>"
                                    class="text-sogan/50 hover:text-emas transition p-2 hover:bg-emas/10 rounded-lg"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('spareparts.edit', $item)); ?>"
                                    class="text-sogan/50 hover:text-emas transition p-2 hover:bg-emas/10 rounded-lg"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo e(route('spareparts.barcode', $item)); ?>"
                                    class="text-sogan/50 hover:text-emas transition p-2 hover:bg-emas/10 rounded-lg"
                                    title="Generate Barcode">
                                    <i class="fas fa-barcode"></i>
                                </a>
                                <?php if(auth()->user()->isSuperAdmin()): ?>
                                <form action="<?php echo e(route('spareparts.destroy', $item)); ?>"
                                    method="POST"
                                    onsubmit="return confirm('Hapus sparepart ini?')"
                                    class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                        class="text-sogan/50 hover:text-red-600 transition p-2 hover:bg-red-50 rounded-lg"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center py-8 text-sogan/50">
                            <i class="fas fa-box-open text-4xl mb-3"></i>
                            <p>Belum ada data sparepart</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t">
            <?php echo e($spareparts->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI\OneDrive\Documents\GitHub\SparttaPOS\resources\views/spareparts/index.blade.php ENDPATH**/ ?>