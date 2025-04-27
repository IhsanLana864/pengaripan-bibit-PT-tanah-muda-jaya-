<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
use App\Models\ProdukBibit;
use App\Models\StokBibit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stokBibits = StokBibit::with('bibit')->paginate(10); // Changed from get() to paginate()
        return view('stock.index', compact('stokBibits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stokBibits = StokBibit::paginate(10);

        $bibits = ProdukBibit::all();
        return view('stock.create', compact('bibits', 'stokBibits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ID_Bibit' => 'required|exists:produk_bibit,id',
            'Stok_Awal' => 'required|numeric|min:0',
            'Masuk' => 'required|numeric|min:0',
            'Keluar' => 'required|numeric|min:0',
        ]);

        // Cek apakah stok keluar valid
        $stokAkhir = $request->Stok_Awal + $request->Masuk - $request->Keluar;

        if ($stokAkhir < 0) {
            return redirect()->back()
                ->with('error', 'Stok tidak cukup untuk keluar sejumlah ' . $request->Keluar)
                ->withInput();
        }

        // Simpan data dengan stok akhir terhitung
        $request->merge(['Stok_Akhir' => $stokAkhir]);
        StokBibit::create($request->all());

        return redirect()->route('stok_bibit.index')
            ->with('success', 'Data stok bibit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $stokBibit = StokBibit::with('bibit')->findOrFail($id);

        // Create virtual stock logs from your existing table
        // Assuming you have a StokBibitLog model that relates to the same table
        $recentStocks = StokBibit::where('ID_Bibit', $stokBibit->ID_Bibit)
            ->select([
                'id',
                'Stok_Awal',
                'Masuk',
                'Keluar',
                'Stok_Akhir',
                'created_at',
                'updated_at'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Add computed properties needed for the view
        foreach ($recentStocks as $log) {
            // Determine if this was mainly a stock in or stock out event
            $log->type = $log->Masuk > $log->Keluar ? 'in' : 'out';

            // Fix: Always set quantity to exact value rather than conditionally
            // Show the actual quantity that came in or out (not conditional on type)
            $log->quantity_in = $log->Masuk;
            $log->quantity_out = $log->Keluar;

            // Keep track of ending stock
            $log->ending_stock = $log->Stok_Akhir;

            // Add a blank user object since user relationship isn't in your schema
            $log->user = null;
        }

        return view('stock.show', compact('stokBibit', 'recentStocks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stokBibit = StokBibit::findOrFail($id);
        $bibits = ProdukBibit::all();
        return view('stock.edit', compact('stokBibit', 'bibits'));
    }

    public function update(Request $request, $id)
    {
        $stokBibit = StokBibit::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'ID_Bibit' => 'required|exists:produk_bibit,id',
            'Stok_Awal' => 'required|integer|min:0',
            'Masuk' => 'required|integer|min:0',
            'Keluar' => 'required|integer|min:0',
        ]);

        // Hitung Stok Akhir
        $stok_akhir = $validated['Stok_Awal'] + $validated['Masuk'] - $validated['Keluar'];

        // Cek jika stok akhir negatif
        if ($stok_akhir < 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Stok akhir tidak boleh negatif!');
        }

        // Update data
        $stokBibit->update([
            'ID_Bibit' => $validated['ID_Bibit'],
            'Stok_Awal' => $validated['Stok_Awal'],
            'Masuk' => $validated['Masuk'],
            'Keluar' => $validated['Keluar'],
            'Stok_Akhir' => $stok_akhir,
        ]);

        return redirect()->route('stok_bibit.index')
            ->with('success', 'Stok bibit berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StokBibit $stok_bibit)
    {
        $stok_bibit->delete();

        return redirect()->route('stok_bibit.index')
            ->with('success', 'Data stok bibit berhasil dihapus.');
    }

    /**
     * Menambah jumlah stok masuk.
     */
    public function addStokMasuk(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
        ]);

        $stokBibit = StokBibit::findOrFail($id);

        // Flow B: Update stok masuk
        $stokBibit->Masuk += $request->jumlah;
        $stokBibit->Stok_Akhir = $stokBibit->Stok_Awal + $stokBibit->Masuk - $stokBibit->Keluar;
        $stokBibit->save();

        return redirect()->route('stok_bibit.index')
            ->with('success', 'Stok masuk berhasil ditambahkan.');
    }

    /**
     * Menambah jumlah stok keluar.
     */
    public function addStokKeluar(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
        ]);

        $stokBibit = StokBibit::findOrFail($id);

        // Flow B: Cek stok keluar
        if ($stokBibit->Stok_Akhir < $request->jumlah) {
            return redirect()->route('stok_bibit.index')
                ->with('error', 'Stok tidak cukup! Stok tersedia: ' . $stokBibit->Stok_Akhir);
        }

        // Update stok keluar
        $stokBibit->Keluar += $request->jumlah;
        $stokBibit->Stok_Akhir = $stokBibit->Stok_Awal + $stokBibit->Masuk - $stokBibit->Keluar;
        $stokBibit->save();

        return redirect()->route('stok_bibit.index')
            ->with('success', 'Stok keluar berhasil dicatat.');
    }
}
