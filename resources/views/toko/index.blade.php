@extends('layouts.app')

@section('title', 'Data Toko')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-green-600 to-green-500 rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white">Kelola Toko</h2>
                    <p class="text-green-100 mt-1">Informasi detail toko Anda</p>
                </div>
                @if($tokos->isEmpty())
                    <a href="{{ route('toko.create') }}"
                       class="flex items-center px-5 py-2.5 bg-white text-green-600 rounded-lg font-semibold hover:bg-green-50 transition-colors duration-200">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Tambah Toko
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-400 p-4">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-emerald-400 mr-3"></i>
                <p class="text-emerald-700">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @forelse($tokos as $toko)
        <div class="p-6 lg:p-8">
            <!-- Information Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Store Details -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-start">
                        <div class="w-10 flex-shrink-0">
                            <i class="fas fa-store text-green-500 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Nama Toko</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $toko->nama_toko }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-10 flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-green-500 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                            <p class="mt-1 text-gray-700 leading-relaxed">{{ $toko->alamat }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-10 flex-shrink-0">
                            <i class="fas fa-envelope text-green-500 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Email</h3>
                            <p class="mt-1 text-gray-700">{{ $toko->email }}</p>
                        </div>
                    </div>

                    @if($toko->deskripsi)
                    <div class="flex items-start">
                        <div class="w-10 flex-shrink-0">
                            <i class="fas fa-info-circle text-green-500 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Deskripsi</h3>
                            <p class="mt-1 text-gray-700 leading-relaxed">{{ $toko->deskripsi }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Store Photo -->
                <div class="relative group">
                    <div class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-xl overflow-hidden border-2 border-gray-200">
                        @if($toko->foto)
                            <img src="{{ Storage::url($toko->foto) }}" alt="{{ $toko->nama_toko }}"
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <i class="fas fa-camera-retro text-4xl"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 mt-6 border-t border-gray-100 flex justify-end space-x-3">
                <a href="{{ route('toko.edit', $toko->id) }}"
                   class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-pencil-alt mr-2"></i>
                    Edit Toko
                </a>
                <form action="{{ route('toko.destroy', $toko->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50 transition-colors duration-200"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus toko ini?')">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="text-center py-16 px-6">
            <div class="max-w-md mx-auto">
                <div class="mb-6 text-green-500">
                    <i class="fas fa-store-alt text-6xl opacity-50"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">Belum Ada Toko Terdaftar</h3>
                <p class="text-gray-500 mb-6">Mulai dengan mendaftarkan toko Anda untuk mengelola produk dan transaksi</p>
                <a href="{{ route('toko.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Tambah Toko Sekarang
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
