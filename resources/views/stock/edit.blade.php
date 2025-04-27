@extends('layouts.app')

@section('title', 'Edit Stok')
@section('header', 'Edit Data Stok')

@section('content')
    <div class="space-y-6">
        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-semibold text-gray-800">Form Edit Stok</h2>
                    <a href="{{ route('stok_bibit.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>

                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('stok_bibit.update', $stokBibit->id) }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Pilih Bibit -->
                    <div class="mb-6">
                        <label for="ID_Bibit" class="block text-base font-medium text-gray-700 mb-3">Pilih Bibit</label>
                        <select id="ID_Bibit" name="ID_Bibit"
                            class="mt-1 block w-full px-4 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 rounded-md shadow-sm @error('ID_Bibit') border-red-500 @enderror">
                            <option value="">-- Pilih Bibit --</option>
                            @foreach ($bibits as $bibit)
                                <option value="{{ $bibit->id }}" {{ old('ID_Bibit', $stokBibit->ID_Bibit) == $bibit->id ? 'selected' : '' }}>
                                    {{ $bibit->Nama_Bibit }}
                                </option>
                            @endforeach
                        </select>
                        @error('ID_Bibit')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grid untuk input stok -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Stok Awal -->
                        <div>
                            <label for="Stok_Awal" class="block text-base font-medium text-gray-700 mb-3">Stok Awal</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" name="Stok_Awal" id="Stok_Awal"
                                    class="block w-full px-4 py-2.5 text-base border-gray-300 focus:ring-green-500 focus:border-green-500 rounded-md @error('Stok_Awal') border-red-500 @enderror"
                                    value="{{ old('Stok_Awal', $stokBibit->Stok_Awal) }}" min="0">
                                <div class="absolute inset-y-0 right-0 pr-8 flex items-center pointer-events-none">
                                    <span class="text-gray-500">unit</span>
                                </div>
                            </div>
                            @error('Stok_Awal')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Masuk -->
                        <div>
                            <label for="Masuk" class="block text-base font-medium text-gray-700 mb-3">Jumlah Masuk</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" name="Masuk" id="Masuk"
                                    class="block w-full px-4 py-2.5 text-base border-gray-300 focus:ring-green-500 focus:border-green-500 rounded-md @error('Masuk') border-red-500 @enderror"
                                    value="{{ old('Masuk', $stokBibit->Masuk) }}" min="0">
                                <div class="absolute inset-y-0 right-0 pr-8 flex items-center pointer-events-none">
                                    <span class="text-gray-500">unit</span>
                                </div>
                            </div>
                            @error('Masuk')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keluar -->
                        <div>
                            <label for="Keluar" class="block text-base font-medium text-gray-700 mb-3">Jumlah Keluar</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" name="Keluar" id="Keluar"
                                    class="block w-full px-4 py-2.5 text-base border-gray-300 focus:ring-green-500 focus:border-green-500 rounded-md @error('Keluar') border-red-500 @enderror"
                                    value="{{ old('Keluar', $stokBibit->Keluar) }}" min="0">
                                <div class="absolute inset-y-0 right-0 pr-8 flex items-center pointer-events-none">
                                    <span class="text-gray-500">unit</span>
                                </div>
                            </div>
                            @error('Keluar')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preview Stok Akhir -->
                        <div>
                            <label for="stok_akhir_preview" class="block text-base font-medium text-gray-700 mb-3">Stok Akhir (Preview)</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" id="stok_akhir_preview" readonly disabled
                                    class="block w-full px-4 py-2.5 text-base bg-gray-50 border-gray-300 rounded-md"
                                    value="{{ $stokBibit->Stok_Akhir }}">
                                <div class="absolute inset-y-0 right-0 pr-8 flex items-center pointer-events-none">
                                    <span class="text-gray-500">unit</span>
                                </div>
                            </div>
                            <p id="stok-warning" class="mt-2 text-sm text-red-600 hidden">Stok akhir akan menjadi negatif!</p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-4 pt-8">
                        <a href="{{ route('stok_bibit.index') }}"
                            class="px-6 py-2.5 text-base border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit"
                            class="bg-green-600 text-white px-6 py-2.5 text-base rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function hitungStokAkhir() {
            const stokAwal = parseInt(document.getElementById('Stok_Awal').value) || 0;
            const masuk = parseInt(document.getElementById('Masuk').value) || 0;
            const keluar = parseInt(document.getElementById('Keluar').value) || 0;

            const stokAkhir = stokAwal + masuk - keluar;
            const previewInput = document.getElementById('stok_akhir_preview');
            const warningElement = document.getElementById('stok-warning');

            previewInput.value = stokAkhir;

            if (stokAkhir < 0) {
                warningElement.classList.remove('hidden');
                previewInput.classList.add('border-red-500', 'text-red-600');
                previewInput.classList.remove('border-gray-300');
            } else {
                warningElement.classList.add('hidden');
                previewInput.classList.remove('border-red-500', 'text-red-600');
                previewInput.classList.add('border-gray-300');
            }
        }

        document.getElementById('Stok_Awal').addEventListener('input', hitungStokAkhir);
        document.getElementById('Masuk').addEventListener('input', hitungStokAkhir);
        document.getElementById('Keluar').addEventListener('input', hitungStokAkhir);

        document.addEventListener('DOMContentLoaded', hitungStokAkhir);
    </script>
    @endpush
@endsection
