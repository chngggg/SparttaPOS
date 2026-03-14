<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Spartta Motor - <?php echo $__env->yieldContent('title'); ?></title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS - Terpisah dan Terstruktur -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-krem font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-64">
            <!-- Header -->
            <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gradient-to-b from-krem to-white">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>

            <!-- Footer -->
            <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden transition-opacity duration-300" id="sidebar-overlay"></div>

    <!-- Alpine.js untuk dropdown dan interaktivitas -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Axios untuk HTTP requests -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Custom JavaScript - Terpisah dan Terstruktur -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH C:\Users\MSI\OneDrive\Desktop\Terakhirbisa\SparttaPOS\resources\views/layouts/app.blade.php ENDPATH**/ ?>