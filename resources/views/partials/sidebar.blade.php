<aside class="fixed inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 w-64 bg-sogan text-krem flex flex-col shadow-2xl sidebar-mobile" id="sidebar">
    <!-- Logo Area dengan motif batik -->
    <div class="p-6 border-b border-emas/20 relative overflow-hidden">
        <div class="absolute inset-0 bg-batik-pattern opacity-10"></div>
        <div class="flex items-center space-x-3 relative z-10">
            <div class="w-10 h-10 bg-emas rounded-lg flex items-center justify-center shadow-lg transform transition-all duration-300 hover:scale-110 hover:rotate-3">
                <i class="fas fa-tools text-sogan text-xl"></i>
            </div>
            <div>
                <h1 class="font-bold text-lg font-playfair tracking-wide">Viar Genuine Part</h1>
                <p class="text-xs text-krem/60">Inventory System</p>
            </div>
        </div>

        <!-- Close button for mobile -->
        <button class="absolute top-4 right-4 lg:hidden text-krem/60 hover:text-emas transition-all duration-200 hover:scale-110 active:scale-95 z-20" id="sidebar-close">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- User Info for Mobile -->
    @auth
    <div class="lg:hidden p-4 border-b border-emas/20 bg-sogan-light/20">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-emas rounded-full flex items-center justify-center ring-2 ring-emas/30 transition-all duration-300 hover:scale-110">
                <span class="text-sogan font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                <p class="text-xs text-krem/60">{{ auth()->user()->role_name }}</p>
            </div>
        </div>
    </div>
    @endauth

    <!-- Menu Navigasi -->
    <nav class="flex-1 px-3 py-6 overflow-y-auto scrollbar-thin scrollbar-thumb-emas/30 scrollbar-track-transparent">
        <div class="space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="menu-item flex items-center space-x-3 px-4 py-3 text-krem/80 rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md group {{ request()->routeIs('dashboard') ? 'bg-emas/20 text-emas shadow-md' : 'hover:bg-sogan-light' }}">
                <i class="fas fa-home w-5 transition-all duration-200 group-hover:scale-110 group-hover:text-emas group-hover:rotate-3"></i>
                <span class="flex-1 font-medium">Dashboard</span>
                @if(request()->routeIs('dashboard'))
                <i class="fas fa-chevron-right text-xs text-emas animate-pulse"></i>
                @endif
            </a>

            @auth
            @if(auth()->user()->isAdmin())
            <!-- Manajemen User -->
            <a href="{{ route('users.index') }}"
                class="menu-item flex items-center space-x-3 px-4 py-3 text-krem/80 rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md group {{ request()->routeIs('users.*') ? 'bg-emas/20 text-emas shadow-md' : 'hover:bg-sogan-light' }}">
                <i class="fas fa-users-cog w-5 transition-all duration-200 group-hover:scale-110 group-hover:text-emas group-hover:rotate-3"></i>
                <span class="flex-1 font-medium">Manajemen User</span>
                @if(request()->routeIs('users.*'))
                <i class="fas fa-chevron-right text-xs text-emas animate-pulse"></i>
                @endif
            </a>
            @endif
            @endauth

            <!-- Sparepart with submenu -->
            <div x-data="{ open: {{ request()->routeIs('spareparts.*') || request()->routeIs('categories.*') ? 'true' : 'false' }} }" class="relative">
                <button @click="open = !open"
                    class="menu-item w-full flex items-center space-x-3 px-4 py-3 text-krem/80 rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md group {{ request()->routeIs('spareparts.*') || request()->routeIs('categories.*') ? 'bg-emas/20 text-emas shadow-md' : 'hover:bg-sogan-light' }}">
                    <i class="fas fa-box w-5 transition-all duration-200 group-hover:scale-110 group-hover:text-emas group-hover:rotate-3"></i>
                    <span class="flex-1 text-left font-medium">Sparepart</span>
                    <i class="fas fa-chevron-down text-xs transition-all duration-300 group-hover:scale-110" :class="{ 'rotate-180': open }"></i>
                </button>

                <div x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform opacity-0 -translate-y-2"
                    x-transition:enter-end="transform opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="transform opacity-100 translate-y-0"
                    x-transition:leave-end="transform opacity-0 -translate-y-2"
                    class="pl-11 pr-3 py-2 space-y-2">
                    <a href="{{ route('spareparts.index') }}"
                        class="submenu-item block text-sm text-krem/70 hover:text-emas py-2 px-3 rounded-lg transition-all duration-200 hover:translate-x-1 hover:bg-sogan-light/50 active:translate-x-0 {{ request()->routeIs('spareparts.index') ? 'text-emas bg-sogan-light/30' : '' }}">
                        <i class="fas fa-list mr-2 text-xs"></i>
                        Daftar Sparepart
                    </a>
                    <a href="{{ route('spareparts.create') }}"
                        class="submenu-item block text-sm text-krem/70 hover:text-emas py-2 px-3 rounded-lg transition-all duration-200 hover:translate-x-1 hover:bg-sogan-light/50 active:translate-x-0 {{ request()->routeIs('spareparts.create') ? 'text-emas bg-sogan-light/30' : '' }}">
                        <i class="fas fa-plus-circle mr-2 text-xs"></i>
                        Tambah Sparepart
                    </a>
                    <a href="{{ route('categories.index') }}"
                        class="submenu-item block text-sm text-krem/70 hover:text-emas py-2 px-3 rounded-lg transition-all duration-200 hover:translate-x-1 hover:bg-sogan-light/50 active:translate-x-0 {{ request()->routeIs('categories.*') ? 'text-emas bg-sogan-light/30' : '' }}">
                        <i class="fas fa-tags mr-2 text-xs"></i>
                        Kategori
                    </a>
                </div>
            </div>

            <!-- Generate Barcode -->
            <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 text-krem/80 rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md group hover:bg-sogan-light">
                <i class="fas fa-barcode w-5 transition-all duration-200 group-hover:scale-110 group-hover:text-emas group-hover:rotate-3"></i>
                <span class="flex-1 font-medium">Generate Barcode</span>
            </a>

            <!-- Scan Barcode -->
            <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 text-krem/80 rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md group hover:bg-sogan-light">
                <i class="fas fa-camera w-5 transition-all duration-200 group-hover:scale-110 group-hover:text-emas group-hover:rotate-3"></i>
                <span class="flex-1 font-medium">Scan Barcode</span>
                <span class="px-2 py-0.5 bg-emas/20 text-emas text-xs rounded-full transition-all duration-200 group-hover:scale-110 group-hover:bg-emas/30 animate-pulse-slow">Stock Opname</span>
            </a>

            <!-- Penjualan with badge -->
            <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 text-krem/80 rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md group hover:bg-sogan-light">
                <i class="fas fa-shopping-cart w-5 transition-all duration-200 group-hover:scale-110 group-hover:text-emas group-hover:rotate-3"></i>
                <span class="flex-1 font-medium">Penjualan</span>
                <span class="px-2 py-0.5 bg-green-500/20 text-green-400 text-xs rounded-full transition-all duration-200 group-hover:scale-110 group-hover:bg-green-500/30">12</span>
            </a>

            <!-- Laporan -->
            <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 text-krem/80 rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md group hover:bg-sogan-light">
                <i class="fas fa-chart-bar w-5 transition-all duration-200 group-hover:scale-110 group-hover:text-emas group-hover:rotate-3"></i>
                <span class="flex-1 font-medium">Laporan</span>
            </a>

            <!-- Pengaturan -->
            <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 text-krem/80 rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md group hover:bg-sogan-light">
                <i class="fas fa-cog w-5 transition-all duration-200 group-hover:scale-110 group-hover:text-emas group-hover:rotate-3"></i>
                <span class="flex-1 font-medium">Pengaturan</span>
            </a>
        </div>
    </nav>

    <!-- User Profile untuk Desktop -->
    @auth
    <div class="hidden lg:block p-4 border-t border-emas/20 bg-gradient-to-t from-sogan-dark/20 to-transparent">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-emas rounded-full flex items-center justify-center ring-2 ring-emas/30 transition-all duration-300 hover:scale-110 hover:ring-4 cursor-pointer">
                <span class="text-sogan font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium truncate transition-all duration-200 hover:text-emas">{{ auth()->user()->name }}</p>
                <p class="text-xs text-krem/60 flex items-center">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-1 animate-pulse"></span>
                    {{ auth()->user()->role_name }}
                </p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-krem/60 hover:text-emas p-2 rounded-lg hover:bg-sogan-light transition-all duration-200 hover:scale-110 active:scale-95 group" title="Logout">
                    <i class="fas fa-sign-out-alt group-hover:rotate-12 transition-transform"></i>
                </button>
            </form>
        </div>
    </div>
    @endauth

    <!-- Sidebar Footer -->
    <div class="p-3 text-center text-xs text-krem/40 border-t border-emas/20">
        <p>© {{ date('Y') }} Viar Genuine Part</p>
        <p class="mt-1 flex items-center justify-center gap-1">
            <i class="fas fa-code-branch text-emas/30 text-[10px]"></i>
            v1.0.0
            <i class="fas fa-heart text-emas/30 text-[10px] ml-1"></i>
        </p>
    </div>
</aside>

<!-- Overlay for mobile -->
<div class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden transition-opacity duration-300" id="sidebar-overlay"></div>

<!-- Alpine.js untuk dropdown -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menu-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const overlay = document.getElementById('sidebar-overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            if (overlay) {
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.style.opacity = '1';
                }, 10);
            }
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            if (overlay) {
                overlay.style.opacity = '0';
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
            }
            document.body.style.overflow = '';
        }

        if (menuToggle) {
            menuToggle.addEventListener('click', openSidebar);
        }

        if (sidebarClose) {
            sidebarClose.addEventListener('click', closeSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        // Close sidebar on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar && sidebar.classList.contains('translate-x-0')) {
                closeSidebar();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                if (overlay) {
                    overlay.classList.add('hidden');
                    overlay.style.opacity = '0';
                }
                document.body.style.overflow = '';
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Tambahkan efek ripple pada menu items
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // Efek klik kedalaman
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    });
</script>

<!-- <style>
    /* Custom scrollbar untuk sidebar */
    .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: rgba(193, 154, 107, 0.3);
        border-radius: 20px;
        transition: background 0.3s;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: rgba(193, 154, 107, 0.5);
    }

    /* Motif batik untuk background sidebar */
    .bg-sogan {
        background-color: #6b4f3c;
        position: relative;
    }

    .bg-sogan::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: repeating-linear-gradient(45deg, rgba(193, 154, 107, 0.1) 0px, rgba(193, 154, 107, 0.1) 2px, transparent 2px, transparent 10px);
        pointer-events: none;
    }

    .bg-batik-pattern {
        background-image: repeating-linear-gradient(45deg, rgba(193, 154, 107, 0.2) 0px, rgba(193, 154, 107, 0.2) 2px, transparent 2px, transparent 10px);
    }

    /* Active menu indicator */
    .bg-emas\/20 {
        position: relative;
        overflow: hidden;
    }

    .bg-emas\/20::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 70%;
        background: #c19a6b;
        border-radius: 0 4px 4px 0;
        animation: slideInLeft 0.3s ease-out;
    }

    .bg-emas\/20::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(193, 154, 107, 0.1), transparent);
        transform: translateX(-100%);
        animation: shimmer 2s infinite;
    }

    /* Menu item animations */
    .menu-item {
        position: relative;
        overflow: hidden;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .menu-item:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
    }

    .menu-item:active {
        transform: translateY(2px) scale(0.98) !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
    }

    /* Submenu item */
    .submenu-item {
        position: relative;
        overflow: hidden;
        transition: all 0.2s ease;
    }

    .submenu-item::before {
        content: '→';
        position: absolute;
        left: -20px;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .submenu-item:hover::before {
        left: 4px;
        opacity: 1;
    }

    /* Animations */
    @keyframes slideInLeft {
        from {
            transform: translateY(-50%) scaleY(0);
            opacity: 0;
        }

        to {
            transform: translateY(-50%) scaleY(1);
            opacity: 1;
        }
    }

    @keyframes shimmer {
        100% {
            transform: translateX(100%);
        }
    }

    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes pulse-slow {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    .animate-pulse-slow {
        animation: pulse-slow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .sidebar-mobile.translate-x-0 {
        animation: slideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Transisi untuk overlay */
    #sidebar-overlay {
        transition: opacity 0.3s ease;
        opacity: 0;
    }

    #sidebar-overlay:not(.hidden) {
        opacity: 1;
    }
</style> -->