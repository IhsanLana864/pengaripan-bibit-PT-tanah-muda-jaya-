@extends('layouts.app')

@section('title', 'Edit Toko')
@section('header', 'Edit Data Toko')

@section('content')
<div class="space-y-6">
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="p-6 lg:p-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Form Edit Toko</h2>
                    <p class="text-sm text-gray-500 mt-1">Silakan edit informasi toko Anda</p>
                </div>
                <a href="{{ route('toko.index') }}"
                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>

            <form action="{{ route('toko.update', $toko->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Grid untuk input yang berhubungan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Toko -->
                    <div>
                        <label for="nama_toko" class="block text-sm font-medium text-gray-700 mb-2">Nama Toko</label>
                        <input type="text" name="nama_toko" id="nama_toko"
                            class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('nama_toko') border-red-500 @enderror"
                            value="{{ old('nama_toko', $toko->nama_toko) }}" required>
                        @error('nama_toko')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email"
                            class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('email') border-red-500 @enderror"
                            value="{{ old('email', $toko->email) }}" required>
                        @error('email')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3"
                            class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('alamat') border-red-500 @enderror"
                            required>{{ old('alamat', $toko->alamat) }}</textarea>
                        @error('alamat')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="block w-full px-4 py-2.5 text-sm border border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-lg bg-white @error('deskripsi') border-red-500 @enderror"
                            >{{ old('deskripsi', $toko->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Foto Toko -->
                    <div class="md:col-span-2">
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto Toko</label>
                        @if($toko->foto)
                            <div class="mb-4">
                                <img src="{{ Storage::url($toko->foto) }}" alt="Foto Toko"
                                    class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                            </div>
                        @endif
                        <input type="file" name="foto" id="foto"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all">
                        @error('foto')
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
