<?php

namespace App\Http\Controllers;

use App\Models\ProdukBibit;
use Illuminate\Http\Request;

class ProdukBibitController extends Controller
{
    public function index()
    {
        $produkBibits = ProdukBibit::latest()->paginate(10);
        return view('produk_bibit.index', compact('produkBibits'));
    }

    public function create()
    {
        return view('produk_bibit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Bibit' => 'required|string|max:255',
            'Jenis' => 'required|string|max:255',
            'Umur' => 'required|integer|min:0',
            'Pupuk' => 'required|string|max:255',
            'Nama_Benih' => 'required|string|max:255',
            'Harga_Beli' => 'required|numeric|min:0',
            'Harga_Jual' => 'required|numeric|min:0'
        ]);

        ProdukBibit::create($request->all());

        return redirect()->route('produk-bibit.index')
            ->with('success', 'Produk bibit berhasil ditambahkan');
    }

    public function show(ProdukBibit $produkBibit)
    {
        return view('produk_bibit.show', compact('produkBibit'));
    }

    public function edit(ProdukBibit $produkBibit)
    {
        return view('produk_bibit.edit', compact('produkBibit'));
    }

    public function update(Request $request, ProdukBibit $produkBibit)
    {
        $request->validate([
            'Nama_Bibit' => 'required|string|max:255',
            'Jenis' => 'required|string|max:255',
            'Umur' => 'required|integer|min:0',
            'Pupuk' => 'required|string|max:255',
            'Nama_Benih' => 'required|string|max:255',
            'Harga_Beli' => 'required|numeric|min:0',
            'Harga_Jual' => 'required|numeric|min:0'
        ]);

        $produkBibit->update($request->all());

        return redirect()->route('produk-bibit.index')
            ->with('success', 'Produk bibit berhasil diperbarui');
    }

    public function destroy(ProdukBibit $produkBibit)
    {
        $produkBibit->delete();

        return redirect()->route('produk-bibit.index')
            ->with('success', 'Produk bibit berhasil dihapus');
    }
}
