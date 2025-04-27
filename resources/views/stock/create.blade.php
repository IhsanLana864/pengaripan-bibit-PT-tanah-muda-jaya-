@extends('layouts.app')

@section('title', 'Tambah Stok')
{{-- @section('header', 'Tambah Data Stok') --}}

@section('content')
<div class="space-y-6">
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="p-6 lg:p-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Form Tambah Stok</h2>
                    <p class="text-sm text-gray-500 mt-1">Silakan isi data stok yang diperlukan</p>
                </div>
                <a href="{{ route('stok_bibit.index') }}"
                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('stok_bibit.store') }}" class="space-y-6">
                @csrf

                <!-- Pilih Bibit -->
                <div>
                    <label for="ID_Bibit" class="block text-sm font-medium text-gray-700 mb-2">Pilih Bibit</label>
                    <select id="ID_Bibit" name="ID_Bibit"
                        class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('ID_Bibit') border-red-500 @enderror">
                        <option value="">-- Pilih Bibit --</option>
                        @foreach ($bibits as $bibit)
                            <option value="{{ $bibit->id }}" {{ old('ID_Bibit') == $bibit->id ? 'selected' : '' }}>
                                {{ $bibit->Nama_Bibit }}
                            </option>
                        @endforeach
                    </select>
                    @error('ID_Bibit')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grid untuk input stok -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Stok Awal -->
                    <div>
                        <label for="Stok_Awal" class="block text-sm font-medium text-gray-700 mb-2">Stok Awal</label>
                        <div class="relative">
                            <input type="number" name="Stok_Awal" id="Stok_Awal"
                                class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('Stok_Awal') border-red-500 @enderror"
                                value="{{ old('Stok_Awal', 0) }}" min="0">
                            <div class="absolute inset-y-0 right-0 pr-8 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">unit</span>
                            </div>
                        </div>
                        @error('Stok_Awal')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Masuk -->
                    <div>
                        <label for="Masuk" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Masuk</label>
                        <div class="relative">
                            <input type="number" name="Masuk" id="Masuk"
                                class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('Masuk') border-red-500 @enderror"
                                value="{{ old('Masuk', 0) }}" min="0">
                            <div class="absolute inset-y-0 right-0 pr-8 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">unit</span>
                            </div>
                        </div>
                        @error('Masuk')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keluar -->
                    <div>
                        <label for="Keluar" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Keluar</label>
                        <div class="relative">
                            <input type="number" name="Keluar" id="Keluar"
                                class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('Keluar') border-red-500 @enderror"
                                value="{{ old('Keluar', 0) }}" min="0">
                            <div class="absolute inset-y-0 right-0 pr-8 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">unit</span>
                            </div>
                        </div>
                        @error('Keluar')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview Stok Akhir -->
                    <div>
                        <label for="stok_akhir_preview" class="block text-sm font-medium text-gray-700 mb-2">Stok Akhir (Preview)</label>
                        <div class="relative">
                            <input type="number" id="stok_akhir_preview" readonly disabled
                                class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm rounded-lg bg-gray-50">
                            <div class="absolute inset-y-0 right-0 pr-8 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">unit</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-3 pt-6 mt-6 border-t border-gray-200">
                    <button type="button" onclick="window.history.back()"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Hitung stok akhir secara otomatis
    function hitungStokAkhir() {
        const stokAwal = parseInt(document.getElementById('Stok_Awal').value) || 0;
        const masuk = parseInt(document.getElementById('Masuk').value) || 0;
        const keluar = parseInt(document.getElementById('Keluar').value) || 0;

        const stokAkhir = stokAwal + masuk - keluar;
        const previewInput = document.getElementById('stok_akhir_preview');

        previewInput.value = stokAkhir;

        // Tambahkan validasi visual jika stok akhir negatif
        if (stokAkhir < 0) {
            previewInput.classList.add('border-red-500', 'text-red-600');
            previewInput.classList.remove('border-gray-300');
        } else {
            previewInput.classList.remove('border-red-500', 'text-red-600');
            previewInput.classList.add('border-gray-300');
        }
    }

    // Tambahkan event listener untuk input
    document.getElementById('Stok_Awal').addEventListener('input', hitungStokAkhir);
    document.getElementById('Masuk').addEventListener('input', hitungStokAkhir);
    document.getElementById('Keluar').addEventListener('input', hitungStokAkhir);

    // Hitung nilai awal saat halaman dimuat
    document.addEventListener('DOMContentLoaded', hitungStokAkhir);
</script>
@endpush
@endsection
