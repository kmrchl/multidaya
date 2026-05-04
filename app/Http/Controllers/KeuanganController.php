<?php
// app/Http/Controllers/KeuanganController.php

namespace App\Http\Controllers;

use App\Models\BiayaOperasional;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        // Data Pendapatan dari peminjaman (dengan PPN)
        $pendapatan = Peminjaman::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->sum(DB::raw('grand_total_with_ppn'));

        // Data Pengeluaran dari biaya operasional
        $pengeluaran = BiayaOperasional::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->sum('jumlah');

        // Hitung perubahan vs bulan lalu
        $bulanLalu = $bulan == 1 ? 12 : $bulan - 1;
        $tahunLalu = $bulan == 1 ? $tahun - 1 : $tahun;

        $pendapatanLalu = Peminjaman::whereYear('created_at', $tahunLalu)
            ->whereMonth('created_at', $bulanLalu)
            ->sum(DB::raw('grand_total_with_ppn'));

        $pengeluaranLalu = BiayaOperasional::whereYear('tanggal', $tahunLalu)
            ->whereMonth('tanggal', $bulanLalu)
            ->sum('jumlah');

        $labaBersih = $pendapatan - $pengeluaran;
        $labaBersihLalu = $pendapatanLalu - $pengeluaranLalu;

        $pendapatanGrowth = $pendapatanLalu > 0 ? (($pendapatan - $pendapatanLalu) / $pendapatanLalu) * 100 : 0;
        $pengeluaranGrowth = $pengeluaranLalu > 0 ? (($pengeluaran - $pengeluaranLalu) / $pengeluaranLalu) * 100 : 0;
        $labaGrowth = $labaBersihLalu != 0 ? (($labaBersih - $labaBersihLalu) / abs($labaBersihLalu)) * 100 : 0;

        // Data untuk grafik 12 bulan
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $pendapatanBulan = Peminjaman::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)
                ->sum(DB::raw('grand_total_with_ppn'));

            $pengeluaranBulan = BiayaOperasional::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $i)
                ->sum('jumlah');

            $monthlyData[] = [
                'bulan' => $this->getNamaBulan($i),
                'pendapatan' => $pendapatanBulan,
                'pengeluaran' => $pengeluaranBulan
            ];
        }

        // 5 Transaksi terakhir (peminjaman)
        $recentTransactions = Peminjaman::with('pelanggan')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'jenis' => 'pendapatan',
                    'deskripsi' => 'Penyewaan - ' . $item->nama_penyewa,
                    'kategori' => 'Sewa Barang',
                    'sumber' => 'peminjaman',
                    'jumlah' => $item->grand_total_with_ppn ?? $item->grand_total,
                    'tanggal' => $item->created_at
                ];
            });

        // Tambahkan transaksi biaya ke recent transactions
        $biayaTransactions = BiayaOperasional::orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'jenis' => 'pengeluaran',
                    'deskripsi' => $item->deskripsi,
                    'kategori' => $item->kategori,
                    'sumber' => $item->sumber,
                    'jumlah' => $item->jumlah,
                    'tanggal' => $item->tanggal
                ];
            });

        $recentTransactions = $recentTransactions->concat($biayaTransactions)
            ->sortByDesc('tanggal')
            ->take(10);

        // Top Barang Terlaris
        $topBarang = DB::table('detail_peminjaman')
            ->join('barang', 'detail_peminjaman.barang_id', '=', 'barang.id')
            ->select('barang.nama_barang', DB::raw('SUM(detail_peminjaman.jumlah) as total_sewa'))
            ->groupBy('barang.nama_barang')
            ->orderByDesc('total_sewa')
            ->limit(5)
            ->get();

        // Pengeluaran by kategori
        $pengeluaranByKategori = BiayaOperasional::select('sumber', DB::raw('SUM(jumlah) as total'))
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->groupBy('sumber')
            ->get();

        $totalPengeluaran = $pengeluaran;
        $totalPendapatan = $pendapatan;
        $labaBersih = $pendapatan - $pengeluaran;

        // Data Riwayat Biaya Operasional untuk tabel
        $riwayatBiaya = BiayaOperasional::with('creator')
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('keuangan.index', compact(
            'bulan',
            'tahun',
            'totalPendapatan',
            'totalPengeluaran',
            'labaBersih',
            'pendapatanGrowth',
            'pengeluaranGrowth',
            'labaGrowth',
            'monthlyData',
            'recentTransactions',
            'topBarang',
            'pengeluaranByKategori',
            'riwayatBiaya'
        ));
    }

    private function getNamaBulan($bulan)
    {
        $nama = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        return $nama[$bulan];
    }

    public function store(Request $request)
    {
        $request->validate([
            'sumber' => 'required|in:operasional,promosi,inventaris',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'referensi' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string'
        ]);

        try {
            $biaya = BiayaOperasional::create([
                'kode_biaya' => BiayaOperasional::generateKodeBiaya(),
                'sumber' => $request->sumber,
                'kategori' => $request->kategori,
                'deskripsi' => $request->deskripsi,
                'jumlah' => $request->jumlah,
                'tanggal' => $request->tanggal,
                'referensi' => $request->referensi,
                'keterangan' => $request->keterangan,
                'status' => 'approved',
                'created_by' => Auth::id(),
                'approved_by' => Auth::id(),
                'approved_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Biaya berhasil ditambahkan',
                'data' => $biaya
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan biaya: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $biaya = BiayaOperasional::findOrFail($id);
            $biaya->delete();

            return response()->json([
                'success' => true,
                'message' => 'Biaya berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus biaya'
            ], 500);
        }
    }

    public function getRiwayatByDate(Request $request)
    {
        $startDate = $request->get('start_date', date('Y-m-01'));
        $endDate = $request->get('end_date', date('Y-m-t'));
        $sumber = $request->get('sumber', 'all');

        $query = BiayaOperasional::with('creator')
            ->whereBetween('tanggal', [$startDate, $endDate]);

        if ($sumber !== 'all') {
            $query->where('sumber', $sumber);
        }

        $riwayat = $query->orderBy('tanggal', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $riwayat,
            'total' => $riwayat->sum('jumlah')
        ]);
    }
}
