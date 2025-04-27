@extends('layouts.app')

@section('title', 'Detail Stok Bibit')
@section('header', 'Detail Stok Bibit')

@section('content')
<div class="space-y-6">
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="p-6 lg:p-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Detail Stok Bibit</h2>
                    <p class="text-sm text-gray-500 mt-1">Informasi detail stok bibit tanaman</p>
                </div>
                <a href="{{ route('stok_bibit.index') }}"
                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>

            <!-- Informasi Bibit -->
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $stokBibit->bibit->Nama_Bibit }}</h3>
                    <p class="text-sm text-gray-500">Kode: {{ $stokBibit->bibit->id }}</p>
                </div>
                <span class="px-3 py-1.5 rounded-full text-sm font-medium {{ $stokBibit->Stok_Akhir < 20 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                    Stok Tersedia: {{ $stokBibit->Stok_Akhir }} unit
                </span>
            </div>

            <!-- Statistik Stok -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Stok Awal -->
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Stok Awal</h4>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-800">{{ $stokBibit->Stok_Awal }}</p>
                        <span class="ml-2 text-sm text-gray-500">unit</span>
                    </div>
                </div>

                <!-- Total Masuk -->
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Total Masuk</h4>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-green-600">+{{ $stokBibit->Masuk }}</p>
                        <span class="ml-2 text-sm text-gray-500">unit</span>
                    </div>
                </div>

                <!-- Total Keluar -->
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Total Keluar</h4>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-red-600">-{{ $stokBibit->Keluar }}</p>
                        <span class="ml-2 text-sm text-gray-500">unit</span>
                    </div>
                </div>

                <!-- Stok Akhir -->
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Stok Akhir</h4>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-blue-600">{{ $stokBibit->Stok_Akhir }}</p>
                        <span class="ml-2 text-sm text-gray-500">unit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
