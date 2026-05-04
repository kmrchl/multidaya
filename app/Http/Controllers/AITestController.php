<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Barang;

class AITestController extends Controller
{
    public function page()
    {
        return view('ai-test.index');
    }


     public function runAIAuto()
    {
        $barangList = Barang::all();

        if ($barangList->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada barang'
            ]);
        }

        $results = [];

        foreach ($barangList as $b) {

            $response = Http::timeout(10)->post('http://127.0.0.1:5000/predict', [
                'nama_barang'   => $b->nama_barang,
                'durasi_sewa'   => 3,
                'stok_saat_itu' => $b->stok,
                'bulan'         => now()->month,
                'hari'          => now()->format('l')
            ]);

            if (!$response->successful()) {
                continue;
            }

            $ai = $response->json();

            /**
             * 🔥 SKOR DISKON (INI BUKAN RULE BASED KEPUTUSAN,
             * tapi hanya scoring dari hasil ML)
             *
             * asumsi:
             * promo_besar = paling tidak laku
             */
            $score = 0;

            if (($ai['rekomendasi'] ?? '') === 'promo_besar') {
                $score = 3;
            } elseif (($ai['rekomendasi'] ?? '') === 'promo_ringan') {
                $score = 2;
            } else {
                $score = 1;
            }

            $results[] = [
                'barang' => $b,
                'ai' => $ai,
                'score' => $score
            ];
        }

        if (empty($results)) {
            return response()->json([
                'status' => 'error',
                'message' => 'ML gagal memproses semua barang'
            ]);
        }

        /**
         * 🔥 AMBIL BARANG PALING BUTUH DISKON
         */
        $best = collect($results)->sortByDesc('score')->first();

        return response()->json([
            'status' => 'success',
            'barang' => $best['barang']->nama_barang,

            // dari ML
            'rekomendasi' => $best['ai']['rekomendasi'],
            'harga_prediksi' => $best['ai']['harga_prediksi'],
            'alasan' => $best['ai']['alasan'] ?? 'berdasarkan pola historis',

            // debug opsional
            'score' => $best['score']
        ]);
    }

    public function runRekomendasiBarang()
    {
        $barangList = Barang::all();

        if ($barangList->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada barang'
            ]);
        }

        $results = [];

        foreach ($barangList as $b) {

            $response = Http::timeout(10)->post('http://127.0.0.1:5000/recommend-barang', [
                'nama_barang'   => $b->nama_barang,
                'durasi_sewa'   => 3,
                'stok_saat_itu' => $b->stok,
                'bulan'         => now()->month,
                'hari'          => now()->format('l')
            ]);

            // 🔥 DEBUG PENTING
            if (!$response->successful()) {
                \Log::error('Flask error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                continue;
            }

            $ai = $response->json();

            $results[] = [
                'barang' => $b,
                'ai' => $ai,
                'confidence' => $ai['confidence'] ?? 0
            ];
        }

        if (empty($results)) {
            return response()->json([
                'status' => 'error',
                'message' => 'ML gagal memproses semua barang'
            ]);
        }

        $best = collect($results)->sortByDesc('confidence')->first();

            return response()->json([
            'status' => 'success',

            // jangan "barang" kalau tidak selalu ada
            'barang' => $best['barang']->nama_barang ?? null,

            // FIX INI (WAJIB)
            'rekomendasi' => $best['ai']['rekomendasi_barang'] ?? null,

            'confidence' => $best['confidence'] ?? 0,

            'demand_score' => $best['ai']['demand_score'] ?? 0,
            'stock_pressure' => $best['ai']['stock_pressure'] ?? 0,
            'final_score' => $best['ai']['final_score'] ?? 0,

            'explanation' => $best['ai']['explanation'] ?? '-',
        ]);
    }
}

