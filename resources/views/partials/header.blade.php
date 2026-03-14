<header class="bg-white shadow-sm border-b border-emas/20 sticky top-0 z-30">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left section with mobile menu button -->
            <div class="flex items-center lg:hidden">
                <button type="button"
                    class="mobile-menu-button text-sogan hover:text-emas focus:outline-none p-2 rounded-lg hover:bg-emas/10 transition-colors"
                    id="menu-toggle"
                    aria-label="Toggle menu">
                    <i class="fas fa-bars text-2xl"></i>
                </button>

                <!-- Mobile logo -->
                <div class="ml-3 lg:hidden">
                    <span class="text-lg font-playfair font-bold text-sogan">Spartta Motor</span>
                </div>
            </div>

            <!-- Desktop logo (hidden on mobile) -->
            <div class="hidden lg:block">
                <h2 class="text-lg font-playfair font-semibold text-sogan">
                    Selamat datang, <span class="text-emas">{{ auth()->user()->name }}</span>
                </h2>
            </div>

            <!-- Search Bar - hidden on smallest screens -->
            <div class="hidden sm:block flex-1 max-w-md mx-4">
                <div class="relative group">
                    <input type="text"
                        placeholder="Cari sparepart, barcode, atau invoice..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-emas/30 focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition bg-gray-50 focus:bg-white">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-sogan/40 group-focus-within:text-emas transition-colors"></i>

                    <!-- Quick search results dropdown (hidden by default) -->
                    <div class="absolute top-full left-0 right-0 mt-1 bg-white rounded-lg shadow-lg border border-emas/20 hidden group-focus-within:block">
                        <div class="p-2 text-sm text-sogan/50">Ketik untuk mencari...</div>
                    </div>
                </div>
            </div>

            <!-- Right Menu -->
            <div class="flex items-center space-x-1 sm:space-x-2 md:space-x-4">
                <!-- Search icon for mobile -->
                <button class="sm:hidden text-sogan hover:text-emas p-2 rounded-lg hover:bg-emas/10 transition-colors">
                    <i class="fas fa-search text-xl"></i>
                </button>

                <!-- Notifications -->
                <div class="relative group">
                    <button class="relative text-sogan hover:text-emas p-2 rounded-lg hover:bg-emas/10 transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                    </button>

                    <!-- Notification dropdown -->
                    <div class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-emas/20 hidden group-hover:block hover:block z-50">
                        <div class="p-3 border-b border-emas/20">
                            <h3 class="font-semibold text-sogan">Notifikasi</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <a href="#" class="block p-3 hover:bg-emas/5 transition border-b border-emas/10">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-sogan">Stok Oli Samping menipis</p>
                                        <p class="text-xs text-sogan/50">Sisa 5 pcs</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block p-3 hover:bg-emas/5 transition border-b border-emas/10">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-check-circle text-green-600 text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-sogan">Transaksi #INV-001 berhasil</p>
                                        <p class="text-xs text-sogan/50">2 menit yang lalu</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 text-center border-t border-emas/20">
                            <a href="#" class="text-sm text-emas hover:text-sogan">Lihat Semua</a>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="relative group hidden md:block">
                    <button class="relative text-sogan hover:text-emas p-2 rounded-lg hover:bg-emas/10 transition-colors">
                        <i class="fas fa-envelope text-xl"></i>
                        <span class="absolute top-1 right-1 w-4 h-4 bg-emas text-sogan text-xs rounded-full flex items-center justify-center">5</span>
                    </button>

                    <!-- Messages dropdown -->
                    <div class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-emas/20 hidden group-hover:block z-50">
                        <div class="p-3 border-b border-emas/20">
                            <h3 class="font-semibold text-sogan">Pesan</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <a href="#" class="block p-3 hover:bg-emas/5 transition">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-emas rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-sogan text-sm font-bold">S</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-sogan">Supplier Motor</p>
                                        <p class="text-xs text-sogan/70 truncate">Pesanan sedang diproses...</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Date/Time - hidden on mobile -->
                <div class="hidden lg:flex items-center space-x-2 text-sm text-sogan/70 bg-emas/5 px-3 py-1.5 rounded-lg">
                    <i class="far fa-calendar-alt text-emas"></i>
                    <span>{{ now()->format('d M Y') }}</span>
                    <i class="far fa-clock text-emas ml-2"></i>
                    <span id="live-time">{{ now()->format('H:i') }}</span>
                </div>

                <!-- User menu dropdown -->
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-sogan hover:text-emas p-1 rounded-lg hover:bg-emas/10 transition-colors">
                        <div class="w-8 h-8 bg-emas rounded-full flex items-center justify-center">
                            <span class="text-sogan font-bold text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                        <span class="hidden md:inline text-sm font-medium">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs hidden md:inline"></i>
                    </button>

                    <!-- User dropdown menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-emas/20 hidden group-hover:block hover:block z-50">
                        <div class="p-3 border-b border-emas/20">
                            <p class="text-sm font-medium text-sogan">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-sogan/50">{{ auth()->user()->role_name }}</p>
                        </div>
                        <div class="p-2">
                            <a href="#" class="block px-3 py-2 text-sm text-sogan hover:bg-emas/10 rounded-lg transition">
                                <i class="fas fa-user mr-2 text-emas"></i> Profil Saya
                            </a>
                            <a href="#" class="block px-3 py-2 text-sm text-sogan hover:bg-emas/10 rounded-lg transition">
                                <i class="fas fa-cog mr-2 text-emas"></i> Pengaturan
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile search bar (hidden by default) -->
        <div class="sm:hidden py-2 border-t border-emas/20 hidden mobile-search">
            <div class="relative">
                <input type="text"
                    placeholder="Cari sparepart..."
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-emas/30 focus:border-emas focus:ring-2 focus:ring-emas/20 outline-none transition bg-gray-50">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-sogan/40"></i>
            </div>
        </div>
    </div>
</header>

<script>
    // Live clock update
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        const clockElement = document.getElementById('live-time');
        if (clockElement) {
            clockElement.textContent = timeString;
        }
    }
    setInterval(updateClock, 1000);

    // Mobile search toggle
    document.addEventListener('DOMContentLoaded', function() {
        const searchIcon = document.querySelector('.sm:hidden .fa-search').parentElement;
        const mobileSearch = document.querySelector('.mobile-search');

        if (searchIcon && mobileSearch) {
            searchIcon.addEventListener('click', function() {
                mobileSearch.classList.toggle('hidden');
            });
        }
    });
</script>