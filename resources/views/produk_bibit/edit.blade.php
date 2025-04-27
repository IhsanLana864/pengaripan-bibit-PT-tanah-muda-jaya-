@extends('layouts.app')

@section('title', 'Edit Produk Bibit')
@section('header', 'Edit Produk Bibit')

@section('content')
<div class="space-y-6">
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="p-6 lg:p-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Form Edit Produk Bibit</h2>
                    <p class="text-sm text-gray-500 mt-1">Silakan edit data produk bibit yang diperlukan</p>
                </div>
                <a href="{{ route('produk-bibit.index') }}"
                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>

            <form action="{{ route('produk-bibit.update', $produkBibit->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Grid untuk input yang berhubungan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Bibit -->
                    <div>
                        <label for="Nama_Bibit" class="block text-sm font-medium text-gray-700 mb-2">Nama Bibit</label>
                        <input type="text" name="Nama_Bibit" id="Nama_Bibit"
                            class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('Nama_Bibit') border-red-500 @enderror"
                            value="{{ old('Nama_Bibit', $produkBibit->Nama_Bibit) }}" required>
                        @error('Nama_Bibit')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis -->
                    <div>
                        <label for="Jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis Bibit</label>
                        <input type="text" name="Jenis" id="Jenis"
                            class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('Jenis') border-red-500 @enderror"
                            value="{{ old('Jenis', $produkBibit->Jenis) }}" required>
                        @error('Jenis')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Umur -->
                    <div>
                        <label for="Umur" class="block text-sm font-medium text-gray-700 mb-2">Umur Bibit</label>
                        <div class="relative">
                            <input type="number" name="Umur" id="Umur"
                                class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('Umur') border-red-500 @enderror"
                                value="{{ old('Umur', $produkBibit->Umur) }}" required min="0">
                            <div class="absolute inset-y-0 right-0 pr-8 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">hari</span>
                            </div>
                        </div>
                        @error('Umur')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pupuk -->
                    <div>
                        <label for="Pupuk" class="block text-sm font-medium text-gray-700 mb-2">Jenis Pupuk</label>
                        <input type="text" name="Pupuk" id="Pupuk"
                            class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('Pupuk') border-red-500 @enderror"
                            value="{{ old('Pupuk', $produkBibit->Pupuk) }}" required>
                        @error('Pupuk')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Benih -->
                    <div>
                        <label for="Nama_Benih" class="block text-sm font-medium text-gray-700 mb-2">Nama Benih</label>
                        <input type="text" name="Nama_Benih" id="Nama_Benih"
                            class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('Nama_Benih') border-red-500 @enderror"
                            value="{{ old('Nama_Benih', $produkBibit->Nama_Benih) }}" required>
                        @error('Nama_Benih')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga Beli -->
                    <div>
                        <label for="Harga_Beli" class="block text-sm font-medium text-gray-700 mb-2">Harga Beli</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">Rp</span>
                            </div>
                            <input type="number" name="Harga_Beli" id="Harga_Beli"
                                class="block w-full pl-12 pr-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('Harga_Beli') border-red-500 @enderror"
                                value="{{ old('Harga_Beli', $produkBibit->Harga_Beli) }}" required min="0" step="0.01">
                        </div>
                        @error('Harga_Beli')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga Jual -->
                    <div>
                        <label for="Harga_Jual" class="block text-sm font-medium text-gray-700 mb-2">Harga Jual</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">Rp</span>
                            </div>
                            <input type="number" name="Harga_Jual" id="Harga_Jual"
                                class="block w-full pl-12 pr-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('Harga_Jual') border-red-500 @enderror"
                                value="{{ old('Harga_Jual', $produkBibit->Harga_Jual) }}" required min="0" step="0.01">
                        </div>
                        @error('Harga_Jual')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
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
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
