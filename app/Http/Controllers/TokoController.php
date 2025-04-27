<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::latest()->paginate(10);
        return view('toko.index', compact('tokos'));
    }

    public function create()
    {
        // Cek apakah sudah ada toko
        if (Toko::count() > 0) {
            return redirect()->route('toko.index')
                ->with('error', 'Tidak dapat menambahkan toko baru karena sudah ada toko yang terdaftar.');
        }
        return view('toko.create');
    }

    public function store(Request $request)
    {
        // Cek lagi untuk keamanan
        if (Toko::count() > 0) {
            return redirect()->route('toko.index')
                ->with('error', 'Tidak dapat menambahkan toko baru karena sudah ada toko yang terdaftar.');
        }

        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:toko,email',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = $foto->store('toko', 'public');
            $data['foto'] = $path;
        }

        Toko::create($data);

        return redirect()->route('toko.index')
            ->with('success', 'Toko berhasil ditambahkan');
    }

    public function show(Toko $toko)
    {
        return view('toko.show', compact('toko'));
    }

    public function edit(Toko $toko)
    {
        return view('toko.edit', compact('toko'));
    }

    public function update(Request $request, Toko $toko)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:toko,email,'.$toko->id,
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($toko->foto) {
                Storage::disk('public')->delete($toko->foto);
            }

            $foto = $request->file('foto');
            $path = $foto->store('toko', 'public');
            $data['foto'] = $path;
        }

        $toko->update($data);

        return redirect()->route('toko.index')
            ->with('success', 'Data toko berhasil diperbarui');
    }

    public function destroy(Toko $toko)
    {
        if ($toko->foto) {
            Storage::disk('public')->delete($toko->foto);
        }

        $toko->delete();

        return redirect()->route('toko.index')
            ->with('success', 'Toko berhasil dihapus');
    }
}
