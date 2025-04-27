@extends('layouts.app')

@section('title', 'Edit Bahan Baku')
@section('header', 'Edit Bahan Baku')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <form action="{{ route('bahan-baku.update', $bahanBaku->ID_Benih) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="Nama_Benih" class="block text-gray-700 text-sm font-bold mb-2">Nama Benih</label>
            <input type="text" name="Nama_Benih" id="Nama_Benih" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('Nama_Benih') border-red-500 @enderror" value="{{ old('Nama_Benih', $bahanBaku->Nama_Benih) }}">
            @error('Nama_Benih')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ID_Pupuk" class="block text-gray-700 text-sm font-bold mb-2">ID Pupuk</label>
            <input type="text" name="ID_Pupuk" id="ID_Pupuk" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('ID_Pupuk') border-red-500 @enderror" value="{{ old('ID_Pupuk', $bahanBaku->ID_Pupuk) }}">
            @error('ID_Pupuk')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="Harga_Beli" class="block text-gray-700 text-sm font-bold mb-2">Harga Beli</label>
            <input type="number" name="Harga_Beli" id="Harga_Beli" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('Harga_Beli') border-red-500 @enderror" value="{{ old('Harga_Beli', $bahanBaku->Harga_Beli) }}">
            @error('Harga_Beli')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update
            </button>
            <a href="{{ route('bahan-baku.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
