<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
use Illuminate\Http\Request;

class BibitController extends Controller
{
    // Menampilkan daftar bibit
    public function index()
    {
        $bibits = Bibit::paginate(10);
        return view('bibit.index', compact('bibits')); // Mengirim data ke view
    }

    // Menampilkan halaman untuk membuat bibit baru
    public function create()
    {
        return view('bibit.create'); // Menampilkan form untuk menambahkan bibit
    }

    // Menyimpan bibit baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'Nama_Bibit' => 'required|string|max:255',
            'Jenis' => 'required|string|max:255',
            // 'Unit' => 'required|integer|min:1',
            'Umur' => 'required|integer|min:0',
            'Harga_Jual' => 'required|numeric|min:0',
        ]);

        // Menyimpan data bibit baru
        Bibit::create($validated);

        // Redirect ke halaman daftar bibit dengan pesan sukses
        return redirect()->route('bibit.index')->with('success', 'Bibit berhasil ditambahkan');
    }

    // Menampilkan detail bibit berdasarkan ID
    public function show(string $id)
    {

        $bibit = Bibit::findOrFail($id); // Mencari bibit berdasarkan ID, jika tidak ditemukan akan melempar 404
        return view('bibit.show', compact('bibit')); // Mengirim data ke view
    }

    // Menampilkan halaman edit bibit berdasarkan ID
    public function edit(Bibit $bibit)
{
    $bibit = Bibit::findOrFail($bibit->id);
    return view('bibit.edit', compact('bibit'));
}

public function update(Request $request, Bibit $bibit)
{


    $validatedData = $request->validate([
        'Nama_Bibit' => 'required|string|max:255',
        'Jenis' => 'required|string|max:255',
        // 'Unit' => 'required|integer|min:1',
        'Umur' => 'required|integer|min:0',
        'Harga_Jual' => 'required|numeric|min:0',
    ]);

    $bibit->update($validatedData);

    return redirect()->route('bibit.index')->with('success', 'Data bibit berhasil diperbarui.');
}

    // Menghapus bibit berdasarkan ID
    public function destroy(string $id)
    {
        $bibit = Bibit::findOrFail($id); // Mencari bibit berdasarkan ID
        $bibit->delete(); // Menghapus bibit

        // Redirect ke halaman daftar bibit dengan pesan sukses
        return redirect()->route('bibit.index')->with('success', 'Bibit berhasil dihapus');
    }
}
