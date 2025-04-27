<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahanBaku = BahanBaku::all();
        return view('bahan-baku.index', compact('bahanBaku'));
    }

    public function create()
    {
        return view('bahan-baku.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_Benih' => 'required|string|max:255',
            'ID_Pupuk' => 'required|integer',
            'Harga_Beli' => 'required|numeric|min:0'
        ]);

        BahanBaku::create($validated);
        return redirect()->route('bahan-baku.index')->with('success', 'Bahan baku berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        return view('bahan-baku.edit', compact('bahanBaku'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'Nama_Benih' => 'required|string|max:255',
            'ID_Pupuk' => 'required|integer',
            'Harga_Beli' => 'required|numeric|min:0'
        ]);

        $bahanBaku = BahanBaku::findOrFail($id);
        $bahanBaku->update($validated);
        return redirect()->route('bahan-baku.index')->with('success', 'Bahan baku berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        $bahanBaku->delete();
        return redirect()->route('bahan-baku.index')->with('success', 'Bahan baku berhasil dihapus');
    }
}
