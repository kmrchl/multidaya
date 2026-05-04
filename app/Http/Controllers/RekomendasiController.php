<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Ini penting untuk panggil AI

class RekomendasiController extends Controller
{
    public function prediksi(Request $request)
    {
        // 1. Ambil input dari form website
        $payload = [
            'nama_barang'   => $request->nama_barang,
            'durasi_sewa'   => $request->durasi_sewa,
            'stok_saat_itu' => $request->stok_saat_itu,
            'bulan'         => (int)date('n'), // Bulan sekarang
            'hari'          => date('l'),     // Hari sekarang (e.g. Monday)
        ];

        try {
            // 2. Kirim data ke Flask (Pastikan Flask nyala di port 5000)
            $response = Http::timeout(10)->post('http://127.0.0.1:5000/predict', $payload);

            if ($response->successful()) {
                $hasil = $response->json();

                // 3. Tampilkan hasil ke halaman view
                // Sesuaikan 'hasil_prediksi' dengan nama file blade kamu nanti
                return view('hasil_rekomendasi', [
                    'harga' => $hasil['harga_prediksi'],
                    'saran' => $hasil['rekomendasi'],
                    'input' => $request->all()
                ]);
            }

            return "Gagal memproses prediksi. Cek koneksi API.";

        } catch (\Exception $e) {
            return "Waduh! Flask-nya belum nyala. Tolong running dulu 'python api.py' di terminal sebelah. Error: " . $e->getMessage();
        }
    }
}
