

<?php $__env->startSection('title', 'Manajemen User'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl md:text-4xl font-playfair font-bold text-sogan mb-2">Manajemen User</h1>
            <p class="text-sogan/70">Kelola semua pengguna sistem inventory sparepart.</p>
        </div>
        <?php if(Auth::user()->isAdmin()): ?>
        <a href="<?php echo e(route('users.create')); ?>" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-emas text-sogan rounded-lg hover:bg-emas-dark transition">
            <i class="fas fa-plus mr-2"></i>
            Tambah User Baru
        </a>
        <?php endif; ?>
    </div>
</div>

<!-- Statistik Users -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-purple-600">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-crown text-purple-600"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-600">Super Admin</p>
                <p class="text-xl font-bold"><?php echo e($users->where('role', 'super_admin')->count()); ?></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-emas">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-emas/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-tie text-emas"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-600">Admin</p>
                <p class="text-xl font-bold"><?php echo e($users->where('role', 'admin')->count()); ?></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-sogan">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-sogan/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-cashier text-sogan"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-600">Kasir</p>
                <p class="text-xl font-bold"><?php echo e($users->where('role', 'kasir')->count()); ?></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-green-600">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-check text-green-600"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-600">Aktif</p>
                <p class="text-xl font-bold"><?php echo e($users->where('is_active', true)->count()); ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Users -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-sogan/10">
                <tr>
                    <th class="text-left py-4 px-6 text-sogan font-semibold">User</th>
                    <th class="text-left py-4 px-6 text-sogan font-semibold">Role</th>
                    <th class="text-left py-4 px-6 text-sogan font-semibold">Kontak</th>
                    <th class="text-left py-4 px-6 text-sogan font-semibold">Dibuat Oleh</th>
                    <th class="text-left py-4 px-6 text-sogan font-semibold">Status</th>
                    <th class="text-left py-4 px-6 text-sogan font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b border-gray-100 hover:bg-emas/5 transition">
                    <td class="py-4 px-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 <?php echo e($user->role_color); ?> rounded-full flex items-center justify-center text-white">
                                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                            </div>
                            <div class="ml-3">
                                <p class="font-medium"><?php echo e($user->name); ?></p>
                                <p class="text-sm text-sogan/60"><?php echo e($user->email); ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="px-3 py-1 <?php echo e($user->role_color); ?> text-white rounded-full text-xs">
                            <?php echo e($user->role_name); ?>

                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <?php if($user->phone): ?>
                        <div class="flex items-center">
                            <i class="fas fa-phone-alt text-sogan/50 w-4 mr-2"></i>
                            <?php echo e($user->phone); ?>

                        </div>
                        <?php else: ?>
                        <span class="text-sogan/40">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-6">
                        <?php if($user->creator): ?>
                        <div class="flex items-center">
                            <span><?php echo e($user->creator->name); ?></span>
                            <span class="ml-2 text-xs px-2 py-0.5 bg-gray-100 rounded">
                                <?php echo e($user->creator->role_name); ?>

                            </span>
                        </div>
                        <?php else: ?>
                        <span class="text-sogan/40">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-6">
                        <button onclick="toggleActive(<?php echo e($user->id); ?>)"
                            class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none <?php echo e($user->is_active ? 'bg-emas' : 'bg-gray-300'); ?>">
                            <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform <?php echo e($user->is_active ? 'translate-x-6' : 'translate-x-1'); ?>"></span>
                        </button>
                        <span class="ml-2 text-sm <?php echo e($user->is_active ? 'text-green-600' : 'text-red-600'); ?>">
                            <?php echo e($user->is_active ? 'Aktif' : 'Nonaktif'); ?>

                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex space-x-2">
                            <a href="<?php echo e(route('users.edit', $user)); ?>" class="text-sogan/50 hover:text-emas transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if(Auth::user()->isSuperAdmin() && !$user->isSuperAdmin()): ?>
                            <button onclick="deleteUser(<?php echo e($user->id); ?>)" class="text-sogan/50 hover:text-red-600 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t">
        <?php echo e($users->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function toggleActive(userId) {
        if (confirm('Apakah Anda yakin ingin mengubah status user ini?')) {
            fetch(`/users/${userId}/toggle-active`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    showToast('Terjadi kesalahan', 'error');
                });
        }
    }

    function deleteUser(userId) {
        if (confirm('Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/users/${userId}`;
            form.innerHTML = `
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        `;
            document.body.appendChild(form);
            form.submit();
        }
    }

    function showToast(message, type = 'success') {
        // Buat elemen toast
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } z-50 animate-slide-in`;
        toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-3"></i>
            <span>${message}</span>
        </div>
    `;

        document.body.appendChild(toast);

        // Hapus setelah 3 detik
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    @keyframes slide-in {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .animate-slide-in {
        animation: slide-in 0.3s ease-out;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI\OneDrive\Documents\GitHub\SparttaPOS\resources\views/users/index.blade.php ENDPATH**/ ?>