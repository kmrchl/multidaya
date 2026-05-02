<!-- Mobile Overlay -->
<div id="mobileOverlay"
    class="fixed inset-0 bg-black/50 z-20 opacity-0 invisible transition-all duration-300 sidebar-overlay lg:hidden"
    onclick="closeSidebar()"></div>

<div class="flex min-h-screen relative bg-[#f8fbff]">
    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="mobile-sidebar fixed lg:sticky top-0 z-30 w-65 bg-white shadow-xl flex flex-col border-r border-[#cfe1f4] h-screen overflow-y-auto sidebar-hidden lg:translate-x-0 transition-transform duration-300">

        <!-- Brand Area -->
        <div class="px-6 pt-8 pb-6 border-b border-[#cfe1f4]">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group relative overflow-hidden rounded-xl">
                <!-- Efek cahaya pada brand saat hover -->
                <div
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700">
                </div>

                <div
                    class="h-10 w-10 flex items-center justify-center overflow-hidden rounded-xl shadow-sm group-hover:shadow-md transition-all duration-200">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Multidaya" class="h-full w-full object-contain">
                </div>

                <div>
                    <h1 class="text-xl font-extrabold tracking-tight text-slate-800 leading-tight">Multidaya</h1>
                    <p class="text-[10px] font-bold text-[#0a3d84] uppercase tracking-widest -mt-0.5">Inti Persada</p>
                </div>
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-1.5">
            <!-- Dashboard Menu -->
            <a href="{{ route('dashboard') }}"
                class="relative overflow-hidden flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-300 group
                @if (Request::routeIs('dashboard')) bg-[#213c61] text-white shadow-md @else text-slate-600 hover:bg-[#213c61] hover:text-white @endif">
                <!-- Efek Cahaya (Glow Sweep) untuk semua menu -->
                <div
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 pointer-events-none">
                </div>
                <i
                    class="fas fa-tachometer-alt w-5 relative z-10 @if (Request::routeIs('dashboard')) text-white @else text-[#4d7cbf] group-hover:text-white @endif"></i>
                <span class="relative z-10">Dashboard</span>
            </a>

            <!-- Peminjaman Menu -->
            <a href="{{ route('peminjaman.index') }}"
                class="relative overflow-hidden flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 group
                @if (Request::routeIs('peminjaman.index')) bg-[#213c61] text-white shadow-md @else text-slate-600 hover:bg-[#213c61] hover:text-white @endif">
                <!-- Efek Cahaya (Glow Sweep) -->
                <div
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 pointer-events-none">
                </div>
                <i
                    class="fas fa-hand-holding-usd w-5 relative z-10 @if (Request::routeIs('peminjaman.index')) text-white @else text-[#4d7cbf] group-hover:text-white @endif"></i>
                <span class="relative z-10">Peminjaman</span>
            </a>

            <!-- Barang Menu -->
            <a href="{{ route('barang.index') }}"
                class="relative overflow-hidden flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 group
                @if (Request::routeIs('barang.index')) bg-[#213c61] text-white shadow-md @else text-slate-600 hover:bg-[#213c61] hover:text-white @endif">
                <!-- Efek Cahaya (Glow Sweep) -->
                <div
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 pointer-events-none">
                </div>
                <i
                    class="fas fa-boxes w-5 relative z-10 @if (Request::routeIs('barang.index')) text-white @else text-[#4d7cbf] group-hover:text-white @endif"></i>
                <span class="relative z-10">Barang</span>
            </a>

            <!-- Keuangan Menu -->
            <a href="{{ route('keuangan.index') }}"
                class="relative overflow-hidden flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 group
                @if (Request::routeIs('keuangan.index')) bg-[#213c61] text-white shadow-md @else text-slate-600 hover:bg-[#213c61] hover:text-white @endif">
                <!-- Efek Cahaya (Glow Sweep) -->
                <div
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 pointer-events-none">
                </div>
                <i
                    class="fas fa-coins w-5 relative z-10 @if (Request::routeIs('keuangan.index')) text-white @else text-[#4d7cbf] group-hover:text-white @endif"></i>
                <span class="relative z-10">Keuangan</span>
            </a>
        </nav>

        <!-- Promo Button -->
        <div class="p-5 border-t border-[#cfe1f4]">
            <button onclick="showPromoModal()"
                class="relative overflow-hidden w-full flex items-center justify-center gap-2 bg-[#05234f] hover:bg-[#05234f] text-white font-semibold py-2.5 px-4 rounded-xl shadow-md transition-all duration-200 group">
                <!-- Efek Cahaya pada tombol Promo -->
                <div
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 pointer-events-none">
                </div>
                <i class="fas fa-plus-circle relative z-10"></i>
                <span class="relative z-10">Tambah Promo/Inventaris</span>
            </button>
        </div>
    </aside>

    <!-- MAIN CONTENT CONTAINER -->
    <div class="flex-1 w-full min-w-0">
        <!-- Top Header -->
        <div
            class="bg-white/80 backdrop-blur-sm sticky top-0 z-20 border-b border-[#cfe1f4] px-4 sm:px-6 lg:px-8 py-3 sm:py-4 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <button id="mobileMenuBtn"
                    class="lg:hidden p-2 -ml-2 rounded-lg text-slate-600 hover:bg-[#cfe1f4]/50 transition"
                    onclick="openSidebar()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div>
                    <h2 class="text-lg sm:text-xl font-semibold text-slate-800 tracking-tight">@yield('page-title', 'Dashboard Overview')</h2>
                    <div class="flex items-center gap-2 text-xs sm:text-sm text-[#4d7cbf] mt-0.5 font-medium">
                        <i class="far fa-calendar-alt"></i>
                        <span id="currentDateSpan"></span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 sm:gap-4">
                <!-- Notifications -->
                <div class="relative cursor-pointer group" onclick="showNotifications()">
                    <i
                        class="far fa-bell text-slate-400 text-lg sm:text-xl group-hover:text-[#4d7cbf] transition-colors"></i>
                    <span
                        class="absolute -top-1 -right-1.5 h-2.5 w-2.5 bg-red-500 rounded-full ring-2 ring-white"></span>
                </div>

                <!-- User Dropdown -->
                <div class="relative group">
                    <div
                        class="flex items-center gap-2 bg-white rounded-full shadow-sm pl-2 pr-3 py-1 border border-[#cfe1f4] cursor-pointer hover:border-[#4d7cbf] transition-all group">
                        <div
                            class="h-7 w-7 sm:h-8 sm:w-8 rounded-full bg-[#4d7cbf] flex items-center justify-center text-white text-xs font-bold">
                            {{ Auth::user() ? strtoupper(substr(Auth::user()->username, 0, 2)) : 'GU' }}
                        </div>
                        <div class="hidden sm:block">
                            <span class="text-xs sm:text-sm font-medium text-slate-700">
                                {{ Auth::user() ? Auth::user()->name : 'Guest' }}
                            </span>
                            <span class="text-xs text-slate-400 block -mt-0.5">
                                @ {{ Auth::user() ? Auth::user()->username : 'guest' }}
                            </span>
                        </div>
                        <i
                            class="fas fa-chevron-down text-xs text-slate-400 group-hover:text-[#4d7cbf] transition-colors"></i>
                    </div>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-[#cfe1f4] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="px-4 py-3 border-b border-[#cfe1f4]">
                            <p class="text-sm font-semibold text-slate-800">{{ Auth::user() ? Auth::user()->name : '' }}
                            </p>
                            <p class="text-xs text-slate-500">@ {{ Auth::user() ? Auth::user()->username : '' }}</p>
                        </div>
                        <a href="#"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-[#cfe1f4]/30 transition-colors">
                            <i class="fas fa-user-circle text-[#4d7cbf]"></i> Profile
                        </a>
                        <a href="#"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-[#cfe1f4]/30 transition-colors">
                            <i class="fas fa-cog text-[#4d7cbf]"></i> Settings
                        </a>
                        <hr class="my-1 border-[#cfe1f4]">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        @yield('main-content')
    </div>
</div>

<script>
    // Set current date
    function updateDateTime() {
        const now = new Date();
        const options = {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        };
        const dateStr = now.toLocaleDateString('id-ID', options);
        const timeStr = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });
        const dateTimeElement = document.getElementById('currentDateSpan');
        if (dateTimeElement) {
            dateTimeElement.innerText = `${dateStr}, ${timeStr}`;
        }
    }
    updateDateTime();
    setInterval(updateDateTime, 60000);

    // Mobile sidebar functions
    function openSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobileOverlay');
        if (sidebar && overlay) {
            sidebar.classList.remove('sidebar-hidden');
            overlay.classList.remove('invisible', 'opacity-0');
            overlay.classList.add('visible', 'opacity-100');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobileOverlay');
        if (sidebar && overlay) {
            sidebar.classList.add('sidebar-hidden');
            overlay.classList.add('invisible', 'opacity-0');
            overlay.classList.remove('visible', 'opacity-100');
            document.body.style.overflow = '';
        }
    }

    function showPromoModal() {
        alert("⚡ Multidaya Inti Persada - Tambah Promo/Inventaris");
    }

    function showNotifications() {
        alert("📢 Notifikasi: Belum ada notifikasi baru");
    }

    // Mobile menu button
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', openSidebar);
    }

    // Close sidebar when clicking links on mobile
    document.querySelectorAll('#sidebar a, #sidebar button').forEach(link => {
        link.addEventListener('click', (e) => {
            if (window.innerWidth < 1024 && !e.target.closest('button')) {
                setTimeout(closeSidebar, 150);
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.classList.remove('sidebar-hidden');
            }
            closeSidebar();
        } else {
            const sidebar = document.getElementById('sidebar');
            if (sidebar && !sidebar.classList.contains('sidebar-hidden')) {
                sidebar.classList.add('sidebar-hidden');
            }
        }
    });

    // Close sidebar when pressing ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && window.innerWidth < 1024) {
            closeSidebar();
        }
    });

    // Overlay click handler
    const overlay = document.getElementById('mobileOverlay');
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }
</script>
