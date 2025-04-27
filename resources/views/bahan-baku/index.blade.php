@extends('layouts.app')

@section('title', 'Bahan Baku')
@section('header', 'Manajemen Bahan Baku')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Daftar Bahan Baku</h2>
        <a href="{{ route('bahan-baku.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
            <i class="fas fa-plus mr-2"></i>Tambah Bahan Baku
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Benih</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Benih</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pupuk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Beli</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($bahanBaku as $bahan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $bahan->ID_Benih }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $bahan->Nama_Benih }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $bahan->ID_Pupuk }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($bahan->Harga_Beli, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('bahan-baku.edit', $bahan->ID_Benih) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('bahan-baku.destroy', $bahan->ID_Benih) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data bahan baku</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
