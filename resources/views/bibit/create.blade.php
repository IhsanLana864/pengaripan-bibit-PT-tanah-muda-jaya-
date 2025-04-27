@extends('layouts.app')

@section('title', 'Tambah Bibit')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-green-500 text-white py-4 px-6">
            <h1 class="text-2xl font-bold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Bibit
            </h1>
        </div>
        <div class="p-6 bg-gray-50">
            <form action="{{ route('bibit.store') }}" method="POST">
                @csrf
                <!-- Nama Bibit -->
                <div class="mb-4">
                    <label for="Nama_Bibit" class="block text-sm font-medium text-gray-700">Nama Bibit</label>
                    <input type="text" name="Nama_Bibit" id="Nama_Bibit" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('Nama_Bibit') border-red-500 @enderror" value="{{ old('Nama_Bibit') }}" required>
                    @error('Nama_Bibit')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis -->
                <div class="mb-4">
                    <label for="Jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
                    <input type="text" name="Jenis" id="Jenis" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('Jenis') border-red-500 @enderror" value="{{ old('Jenis') }}" required>
                    @error('Jenis')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- <!-- Unit -->
                <div class="mb-4">
                    <label for="Unit" class="block text-sm font-medium text-gray-700">Unit</label>
                    <input type="number" name="Unit" id="Unit" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('Unit') border-red-500 @enderror" value="{{ old('Unit') }}" min="1" required>
                    @error('Unit')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div> --}}

                <!-- Umur -->
                <div class="mb-4">
                    <label for="Umur" class="block text-sm font-medium text-gray-700">Umur (hari)</label>
                    <input type="number" name="Umur" id="Umur" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('Umur') border-red-500 @enderror" value="{{ old('Umur') }}" min="0" required>
                    @error('Umur')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga Jual -->
                <div class="mb-4">
                    <label for="Harga_Jual" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                    <input type="number" name="Harga_Jual" id="Harga_Jual" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('Harga_Jual') border-red-500 @enderror" value="{{ old('Harga_Jual') }}" min="0" step="0.01" required>
                    @error('Harga_Jual')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-between">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Simpan
                    </button>
                    <a href="{{ route('bibit.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
