<?php
namespace App\Http\Controllers;
use App\Models\Toko;
use Illuminate\Http\Request;
use App\Models\ProdukBibit;
use App\Models\StokBibit;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Determine the date range
        $range = $request->input('range', '30d');
        $days = $range === '1y' ? 365 : 30;
        $toko = Toko::first();

        // Prepare chart data
        $chartLabels = [];
        $chartMasuk = [];
        $chartKeluar = [];
        for ($i = $days; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = now()->subDays($i)->format('d M');
            $masuk = StokBibit::whereDate('created_at', $date)->sum('Masuk');
            $keluar = StokBibit::whereDate('created_at', $date)->sum('Keluar');
            $chartMasuk[] = $masuk ?? 0;
            $chartKeluar[] = $keluar ?? 0;
        }

        // Fixed queries to use ProdukBibit model for Jenis
        $totalBibit = ProdukBibit::count();
        $varianBibit = ProdukBibit::distinct('Jenis')->count('Jenis');
        $totalStok = StokBibit::sum('Stok_Akhir');
        $totalMasuk = StokBibit::sum('Masuk');
        $totalKeluar = StokBibit::sum('Keluar');
        $jenisBenih = ProdukBibit::distinct('Jenis')->count('Jenis');

        $recentStocks = StokBibit::with('produkBibit')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $lowStocks = StokBibit::with('produkBibit')
            ->where('Stok_Akhir', '<', 100) // Adjust threshold as needed
            ->orderBy('Stok_Akhir')
            ->limit(5)
            ->get();

        $bibits = ProdukBibit::orderBy('Nama_Bibit')
            ->limit(5)
            ->get();

        return view('dashboard', [
            'toko' => $toko,
            'totalBibit' => $totalBibit,
            'varianBibit' => $varianBibit,
            'totalStok' => $totalStok,
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'jenisBenih' => $jenisBenih,
            'recentStocks' => $recentStocks,
            'lowStocks' => $lowStocks,
            'bibits' => $bibits,
            'chartLabels' => $chartLabels,
            'chartMasuk' => $chartMasuk,
            'chartKeluar' => $chartKeluar,
            'range' => $range
        ]);
    }
}
