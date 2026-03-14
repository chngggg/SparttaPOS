

<?php $__env->startSection('title', 'Kategori Sparepart'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-page">
    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl md:text-4xl font-playfair font-bold text-sogan mb-2">Kategori Sparepart</h1>
            <p class="text-sogan/70">Kelola kategori untuk pengelompokan sparepart.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="<?php echo e(route('categories.create')); ?>"
                class="inline-flex items-center px-4 py-2 bg-emas text-sogan rounded-lg hover:bg-emas-dark transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                <i class="fas fa-plus mr-2"></i>
                Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Tabel Kategori -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-sogan/10">
                    <tr>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Nama Kategori</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Slug</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Deskripsi</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Jumlah Item</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Status</th>
                        <th class="text-left py-4 px-6 text-sogan font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b border-gray-100 hover:bg-emas/5 transition">
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <?php if($category->icon): ?>
                                <i class="fas fa-<?php echo e($category->icon); ?> text-emas mr-2"></i>
                                <?php endif; ?>
                                <span class="font-medium"><?php echo e($category->name); ?></span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-sm text-sogan/60"><?php echo e($category->slug); ?></td>
                        <td class="py-4 px-6 text-sm text-sogan/60 max-w-xs truncate">
                            <?php echo e($category->description ?? '-'); ?>

                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 bg-emas/10 text-emas rounded-full text-xs">
                                <?php echo e($category->spareparts_count ?? 0); ?> item
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <?php if($category->is_active): ?>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">Aktif</span>
                            <?php else: ?>
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex space-x-2">
                                <a href="<?php echo e(route('categories.edit', $category)); ?>"
                                    class="text-sogan/50 hover:text-emas transition p-2 hover:bg-emas/10 rounded-lg"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <?php if(auth()->user()->isSuperAdmin()): ?>
                                <form action="<?php echo e(route('categories.destroy', $category)); ?>"
                                    method="POST"
                                    onsubmit="return confirm('Hapus kategori ini? Semua sparepart dalam kategori ini akan kehilangan kategori.')"
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
                        <td colspan="6" class="text-center py-8 text-sogan/50">
                            <i class="fas fa-tags text-4xl mb-3"></i>
                            <p>Belum ada kategori</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t">
            <?php echo e($categories->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI\OneDrive\Desktop\Terakhirbisa\SparttaPOS\resources\views/categories/index.blade.php ENDPATH**/ ?>