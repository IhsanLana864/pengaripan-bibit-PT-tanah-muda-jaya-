<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem Manajemen Bibit</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Mobile Trigger -->
        <div class="lg:hidden fixed top-0 left-0 z-50 w-full bg-white border-b border-gray-200 px-4 py-3 flex items-center shadow-sm">
            <div class="flex items-center space-x-3">
                <button id="sidebarTrigger"
                    class="p-2 rounded-lg text-green-600 hover:bg-gray-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <span class="text-base font-medium text-gray-800">Manajemen Produk Bibit</span>
            </div>
        </div>

        <!-- Enhanced Sidebar -->
        <div id="sidebar"
            class="bg-gradient-to-b from-green-700 to-green-800 text-white w-72 flex-shrink-0 shadow-xl transform transition-all duration-300 ease-in-out z-40 fixed lg:relative h-full lg:translate-x-0 -translate-x-full">
            <div class="pt-16 lg:pt-4 px-4 border-b border-green-600/50">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-lg bg-green-600/30 flex items-center justify-center">
                        <i class="fas fa-leaf text-green-300 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold tracking-tight">PT Tanah Muda Jaya</h1>
                        <p class="text-xs text-green-200/80">Sistem Akuntansi Persediaan</p>
                    </div>
                </div>
            </div>

            <nav class="mt-4 flex flex-col h-[calc(100%-180px)] overflow-y-auto">
                <div class="px-4 py-2 text-xs font-semibold text-green-300/80 uppercase tracking-wider">
                    Menu Utama
                </div>

                <div class="space-y-1.5 px-3">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-2.5 transition-all duration-200 hover:bg-green-600/50 hover:shadow-md rounded-lg group {{ request()->routeIs('dashboard') ? 'bg-green-600/30 border-l-4 border-green-300' : '' }}">
                        <span class="w-7 h-7 rounded-lg bg-green-600/30 flex items-center justify-center mr-3 group-hover:bg-green-500/50">
                            <i class="fas fa-home text-green-200 text-sm"></i>
                        </span>
                        <span class="font-medium text-sm">Dashboard</span>
                    </a>

                    <a href="{{ route('toko.index') }}"
                        class="flex items-center px-4 py-2.5 transition-all duration-200 hover:bg-green-600/50 hover:shadow-md rounded-lg group {{ request()->routeIs('toko*') ? 'bg-green-600/30 border-l-4 border-green-300' : '' }}">
                        <span class="w-7 h-7 rounded-lg bg-green-600/30 flex items-center justify-center mr-3 group-hover:bg-green-500/50">
                            <i class="fas fa-store text-green-200 text-sm"></i>
                        </span>
                        <span class="font-medium text-sm">Kelola Toko</span>
                    </a>
                </div>

                <div class="px-4 py-2 text-xs font-semibold text-green-300/80 uppercase tracking-wider mt-4">
                    Manajemen
                </div>

                <div class="space-y-1.5 px-3">
                    <a href="{{ route('produk-bibit.index') }}"
                        class="flex items-center px-4 py-2.5 transition-all duration-200 hover:bg-green-600/50 hover:shadow-md rounded-lg group {{ request()->routeIs('produk-bibit*') ? 'bg-green-600/30 border-l-4 border-green-300' : '' }}">
                        <span class="w-7 h-7 rounded-lg bg-green-600/30 flex items-center justify-center mr-3 group-hover:bg-green-500/50">
                            <i class="fas fa-seedling text-green-200 text-sm"></i>
                        </span>
                        <span class="font-medium text-sm">Produk Bibit</span>
                    </a>

                    <a href="{{ route('stok_bibit.index') }}"
                        class="flex items-center px-4 py-2.5 transition-all duration-200 hover:bg-green-600/50 hover:shadow-md rounded-lg group {{ request()->routeIs('stok_bibit*') ? 'bg-green-600/30 border-l-4 border-green-300' : '' }}">
                        <span class="w-7 h-7 rounded-lg bg-green-600/30 flex items-center justify-center mr-3 group-hover:bg-green-500/50">
                            <i class="fas fa-warehouse text-green-200 text-sm"></i>
                        </span>
                        <span class="font-medium text-sm">Stok</span>
                    </a>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="w-full p-4 bg-green-700/50 mt-auto">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-full bg-green-600/30 flex items-center justify-center">
                        <i class="fas fa-user-circle text-green-200 text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-green-200/80">Admin</p>
                    </div>
                    <button id="logoutButton"
                        class="p-1.5 hover:bg-green-600/30 rounded-full transition-colors duration-200">
                        <i class="fas fa-sign-out-alt text-green-200/70 hover:text-white"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden w-full">
            <!-- Enhanced Header -->
            <header class="bg-white shadow-sm border-b mt-14 lg:mt-0">
                <div class="flex justify-between items-center px-4 lg:px-6 py-4">
                    <div class="flex-1 min-w-0">
                        <h1 class="text-lg lg:text-xl font-semibold text-gray-800 truncate">@yield('header')</h1>
                        <nav class="flex items-center text-sm text-gray-500 mt-2 space-x-2">
                            <a href="{{ route('dashboard') }}"
                                class="hover:text-green-600 transition-colors duration-200">Dashboard</a>
                            @yield('breadcrumbs')
                        </nav>
                    </div>

                    <div class="flex items-center space-x-6">
                        <div class="h-8 w-px bg-gray-200 hidden lg:block"></div>
                        <div class="flex items-center space-x-3">
                            <span class="text-gray-700 text-sm font-medium hidden lg:block">
                                {{ Auth::user()->name }}
                            </span>
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-user text-green-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content dengan padding yang lebih baik -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-6 lg:p-8">
                @hasSection('stats')
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
                        @yield('stats')
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 lg:p-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Logout Modal - dengan penyesuaian untuk mobile -->
    <div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden p-4">
        <div class="bg-white rounded-lg shadow-2xl border border-gray-200 p-4 lg:p-6 w-full max-w-sm mx-4">
            <h2 class="text-lg font-semibold mb-2 text-gray-800">Konfirmasi Logout</h2>
            <p class="mb-4 text-gray-600">Apakah Anda yakin ingin keluar?</p>
            <div class="flex justify-end space-x-2">
                <button onclick="toggleLogoutModal(false)"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-gray-700">Batal</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Logout</button>
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
    <script>
        // Toggle Sidebar untuk Mobile
        document.getElementById('sidebarTrigger').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });

        // Tutup sidebar saat mengklik di luar sidebar pada mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarTrigger = document.getElementById('sidebarTrigger');

            if (!sidebar.contains(event.target) && !sidebarTrigger.contains(event.target) && window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Fungsi Logout Modal
        function toggleLogoutModal(show = true) {
            document.getElementById('logoutModal').classList.toggle('hidden', !show);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const logoutButton = document.getElementById('logoutButton');
            if (logoutButton) {
                logoutButton.addEventListener('click', function() {
                    toggleLogoutModal(true);
                });
            }
        });
    </script>
</body>

</html>
