@extends('layouts.app')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- Bahan Baku Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="p-3.5 rounded-xl bg-green-100 flex items-center justify-center">
                        <i class="fas fa-box text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-500">Jenis Benih</h2>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($jenisBenih) }}</p>
                    </div>
                </div>
                <div class="mt-4 text-xs text-gray-500 flex items-center">
                    <i class="fas fa-seedling mr-1.5"></i>
                    <span>{{ $jenisBenih }} Jenis Benih</span>
                </div>
            </div>

            <!-- Bibit Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="p-3.5 rounded-xl bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-seedling text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-500">Total Bibit</h2>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalBibit) }}</p>
                    </div>
                </div>
                <div class="mt-4 text-xs text-gray-500 flex items-center">
                    <i class="fas fa-tags mr-1.5"></i>
                    <span>{{ $varianBibit }} Varian</span>
                </div>
            </div>

            <!-- Stok Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="p-3.5 rounded-xl bg-amber-100 flex items-center justify-center">
                        <i class="fas fa-warehouse text-amber-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-500">Total Stok Akhir</h2>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalStok) }}</p>
                    </div>
                </div>
                <div class="mt-4 text-xs text-gray-500 flex items-center">
                    <i class="fas fa-exchange-alt mr-1.5"></i>
                    <span>{{ number_format($totalMasuk) }} Masuk / {{ number_format($totalKeluar) }} Keluar</span>
                </div>
            </div>
        </div>

        <!-- Second Row - Shop Information and Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Toko Information -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Toko</h2>
                <div class="flex flex-col sm:flex-row sm:items-start sm:space-x-5">
                    @if($toko && $toko->foto)
                    <div class="flex-shrink-0 mb-4 sm:mb-0">
                        <img src="{{ asset('storage/' . $toko->foto) }}" alt="Foto Toko"
                             class="w-24 h-24 rounded-lg object-cover border border-gray-200 shadow-sm">
                    </div>
                    @endif
                    <div class="flex-1">
                        @if($toko)
                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $toko->nama_toko }}</h3>

                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marker-alt text-green-600"></i>
                                </div>
                                <span class="text-sm text-gray-600">{{ $toko->alamat }}</span>
                            </div>

                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-envelope text-green-600"></i>
                                </div>
                                <span class="text-sm text-gray-600">{{ $toko->email }}</span>
                            </div>

                            @if($toko->deskripsi)
                            <div class="mt-4 bg-gray-50 p-3 rounded-lg">
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $toko->deskripsi }}</p>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="flex flex-col items-center justify-center py-10 bg-gray-50 rounded-lg">
                            <i class="fas fa-store text-gray-300 text-3xl mb-2"></i>
                            <p class="text-gray-500">Informasi toko belum tersedia</p>
                            <a href="{{ route('toko.index') }}" class="mt-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700">
                                <i class="fas fa-plus mr-2"></i> Tambah Toko
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Stock Activities -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Aktivitas Stok Terbaru</h3>
                    <a href="{{ route('stok_bibit.index') }}" class="text-sm text-green-600 hover:text-green-800 flex items-center">
                        <span>Lihat Semua</span>
                        <i class="fas fa-chevron-right text-xs ml-1"></i>
                    </a>
                </div>
                <div class="space-y-2">
                    @forelse($recentStocks as $stock)
                        <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full {{ $stock->Masuk > 0 ? 'bg-green-100' : 'bg-red-100' }} flex items-center justify-center">
                                <i class="fas fa-{{ $stock->Masuk > 0 ? 'arrow-down text-green-500' : 'arrow-up text-red-500' }}"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-gray-700">
                                    {{ optional($stock->produkBibit)->Nama_Bibit ?? 'Bibit Tidak Ditemukan' }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    <span class="font-medium {{ $stock->Masuk > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ number_format($stock->Masuk > 0 ? $stock->Masuk : $stock->Keluar) }}
                                    </span> unit
                                </p>
                                <p class="text-xs text-gray-400 mt-1 flex items-center">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span>{{ $stock->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-gray-50 rounded-lg">
                            <i class="fas fa-inbox text-gray-300 text-3xl mb-2"></i>
                            <p class="text-gray-500">Belum ada aktivitas stok</p>
                            <a href="{{ route('stok_bibit.index') }}" class="mt-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700">
                                <i class="fas fa-plus mr-2"></i> Tambah Stok
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Third Row - Low Stock and Bibit List -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Low Stock -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-exclamation-triangle text-amber-500 mr-2"></i>
                        Stok Kritis
                    </h2>
                    <a href="{{ route('stok_bibit.index') }}" class="text-sm text-green-600 hover:text-green-800 flex items-center">
                        <span>Kelola</span>
                        <i class="fas fa-chevron-right text-xs ml-1"></i>
                    </a>
                </div>
                <div class="space-y-3">
                    @forelse($lowStocks as $stock)
                        <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg border border-red-100">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-exclamation-triangle text-red-500"></i>
                                </div>
                                <div>
                                    <span class="text-gray-700 font-medium block">{{ optional($stock->produkBibit)->Nama_Bibit ?? 'Bibit Tidak Ditemukan' }}</span>
                                    <span class="text-xs text-gray-500">{{ optional($stock->produkBibit)->Jenis ?? '-' }}</span>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                {{ number_format($stock->Stok_Akhir) }} unit
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-8 bg-green-50 rounded-lg border border-green-100">
                            <i class="fas fa-check-circle text-green-500 text-3xl mb-2"></i>
                            <p class="text-green-700">Semua stok dalam kondisi aman</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Bibit List -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-seedling text-green-500 mr-2"></i>
                        Daftar Bibit
                    </h3>
                    <a href="{{ route('produk-bibit.index') }}" class="text-sm text-green-600 hover:text-green-800 flex items-center">
                        <span>Lihat Semua</span>
                        <i class="fas fa-chevron-right text-xs ml-1"></i>
                    </a>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach ($bibits as $bibit)
                        <div class="flex items-center justify-between py-3 hover:bg-gray-50 px-3 rounded-lg transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-seedling text-green-500"></i>
                                </div>
                                <div>
                                    <span class="text-gray-700 font-medium block">{{ $bibit->Nama_Bibit }}</span>
                                    <span class="text-xs text-gray-500">{{ $bibit->Jenis }}</span>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">
                                {{ $bibit->Umur ?? 0 }} hari
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chartInstance = null;

        function initChart(labels, masuk, keluar) {
            const ctx = document.getElementById('stockChart');
            if (!ctx) return;

            if (chartInstance) {
                chartInstance.destroy();
            }

            chartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Stok Masuk',
                            data: masuk,
                            borderColor: '#22c55e',
                            backgroundColor: 'rgba(34, 197, 94, 0.1)',
                            tension: 0.4,
                            fill: true,
                            borderWidth: 2,
                            pointBackgroundColor: '#22c55e',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 5
                        },
                        {
                            label: 'Stok Keluar',
                            data: keluar,
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            tension: 0.4,
                            fill: true,
                            borderWidth: 2,
                            pointBackgroundColor: '#ef4444',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y.toLocaleString() + ' unit';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        async function updateChart(range) {
            try {
                // Show loading state
                const chartContainer = document.querySelector('#stockChart').parentElement;
                chartContainer.innerHTML = '<div class="flex justify-center items-center h-full"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-green-500"></div></div>';

                // Fetch new data
                const response = await fetch(`/dashboard?range=${range}`);
                const html = await response.text();

                // Create temporary DOM to extract the data
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const scripts = doc.querySelectorAll('script');

                // Default to current data if we can't extract new data
                let newLabels = @json($chartLabels);
                let newMasuk = @json($chartMasuk);
                let newKeluar = @json($chartKeluar);

                scripts.forEach(script => {
                    const content = script.textContent;
                    if (content && content.includes('initChart')) {
                        const match = content.match(/initChart\(\[(.*?)\],\s*\[(.*?)\],\s*\[(.*?)\]\)/);
                        if (match) {
                            try {
                                newLabels = JSON.parse(`[${match[1]}]`);
                                newMasuk = JSON.parse(`[${match[2]}]`);
                                newKeluar = JSON.parse(`[${match[3]}]`);
                            } catch (e) {
                                console.error('Error parsing chart data:', e);
                            }
                        }
                    }
                });

                // Recreate the chart canvas
                chartContainer.innerHTML = '<canvas id="stockChart"></canvas>';

                // Initialize chart with new data
                initChart(newLabels, newMasuk, newKeluar);

            } catch (error) {
                console.error('Error updating chart:', error);
                alert('Gagal memuat data terbaru');
                // Restore original chart if error occurs
                initChart(@json($chartLabels), @json($chartMasuk), @json($chartKeluar));
            }
        }

        // Initialize chart on page load
        document.addEventListener('DOMContentLoaded', function() {
            initChart(
                @json($chartLabels),
                @json($chartMasuk),
                @json($chartKeluar)
            );
        });
    </script>
    @endpush
@endsection
