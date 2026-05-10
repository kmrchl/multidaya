<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('detail_peminjaman')->truncate();
        DB::table('peminjaman')->truncate();

        Schema::enableForeignKeyConstraints();

        // ==================== AMBIL DATA PELANGGAN ====================

        $budi = DB::table('pelanggan')->where('nama', 'Budi Santoso')->first();
        $siti = DB::table('pelanggan')->where('nama', 'Siti Aminah')->first();
        $ptMajuJaya = DB::table('pelanggan')->where('nama', 'PT Maju Jaya')->first();
        $cvTeknologi = DB::table('pelanggan')->where('nama', 'CV Teknologi Nusantara')->first();
        $rahmat = DB::table('pelanggan')->where('nama', 'Rahmat Hidayat')->first();

        // ==================== DATA PEMINJAMAN ====================

        $peminjaman = [

            [
                'invoice_number' => 'INV/2025/001',
                'pelanggan_id' => $budi?->id,
                'nama_penyewa' => 'Budi Santoso',
                'no_telepon' => '081234567890',
                'customer_whatsapp' => '081234567890',
                'nama_acara' => 'Presentasi Produk',
                'lokasi_acara' => 'Jakarta Convention Center',
                'tanggal_sewa' => '2025-05-10',
                'tanggal_kembali' => '2025-05-12',
                'waktu_sewa' => '08:00',
                'waktu_kembali' => '17:00',
                'status_pembayaran' => 'lunas',
                'status_pengembalian' => 'aktif',
                'total_harga' => 1850000,
                'diskon' => 0,
                'grand_total' => 1850000,
                'keterangan' => 'Acara presentasi produk',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'invoice_number' => 'INV/2025/002',
                'pelanggan_id' => $siti?->id,
                'nama_penyewa' => 'Siti Aminah',
                'no_telepon' => '081377788899',
                'customer_whatsapp' => '081377788899',
                'nama_acara' => 'Seminar Kampus',
                'lokasi_acara' => 'Yogyakarta',
                'tanggal_sewa' => '2025-05-15',
                'tanggal_kembali' => '2025-05-16',
                'waktu_sewa' => '09:00',
                'waktu_kembali' => '20:00',
                'status_pembayaran' => 'dp',
                'status_pengembalian' => 'aktif',
                'total_harga' => 1350000,
                'diskon' => 50000,
                'grand_total' => 1300000,
                'keterangan' => 'Seminar kampus',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'invoice_number' => 'INV/2025/003',
                'pelanggan_id' => $ptMajuJaya?->id,
                'nama_penyewa' => 'PT Maju Jaya',
                'no_telepon' => '081298765432',
                'customer_whatsapp' => '081298765432',
                'nama_acara' => 'Company Gathering',
                'lokasi_acara' => 'Bandung',
                'tanggal_sewa' => '2025-05-20',
                'tanggal_kembali' => '2025-05-22',
                'waktu_sewa' => '07:00',
                'waktu_kembali' => '22:00',
                'status_pembayaran' => 'lunas',
                'status_pengembalian' => 'aktif',
                'total_harga' => 5200000,
                'diskon' => 200000,
                'grand_total' => 5000000,
                'keterangan' => 'Gathering perusahaan',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'invoice_number' => 'INV/2025/004',
                'pelanggan_id' => $ptMajuJaya?->id,
                'nama_penyewa' => 'PT Maju Jaya',
                'no_telepon' => '081298765432',
                'customer_whatsapp' => '081298765432',
                'nama_acara' => 'Rapat Tahunan',
                'lokasi_acara' => 'Bandung',
                'tanggal_sewa' => '2025-04-01',
                'tanggal_kembali' => '2025-04-02',
                'waktu_sewa' => '08:00',
                'waktu_kembali' => '17:00',
                'status_pembayaran' => 'lunas',
                'status_pengembalian' => 'selesai',
                'total_harga' => 1750000,
                'diskon' => 0,
                'grand_total' => 1750000,
                'keterangan' => 'Rapat tahunan',
                'created_by' => 1,
                'tanggal_pengembalian_real' => now(),
                'kondisi_barang' => 'baik',
                'denda' => 0,
                'catatan_pengembalian' => 'Barang lengkap',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'invoice_number' => 'INV/2025/005',
                'pelanggan_id' => $cvTeknologi?->id,
                'nama_penyewa' => 'CV Teknologi Nusantara',
                'no_telepon' => '082112223333',
                'customer_whatsapp' => '082112223333',
                'nama_acara' => 'Exhibition',
                'lokasi_acara' => 'Surabaya',
                'tanggal_sewa' => '2025-04-10',
                'tanggal_kembali' => '2025-04-12',
                'waktu_sewa' => '09:00',
                'waktu_kembali' => '21:00',
                'status_pembayaran' => 'lunas',
                'status_pengembalian' => 'selesai',
                'total_harga' => 7850000,
                'diskon' => 350000,
                'grand_total' => 7500000,
                'keterangan' => 'Pameran teknologi',
                'created_by' => 1,
                'tanggal_pengembalian_real' => now(),
                'kondisi_barang' => 'baik',
                'denda' => 50000,
                'catatan_pengembalian' => 'Terlambat 1 jam',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'invoice_number' => 'INV/2025/006',
                'pelanggan_id' => $rahmat?->id,
                'nama_penyewa' => 'Rahmat Hidayat',
                'no_telepon' => '081355566677',
                'customer_whatsapp' => '081355566677',
                'nama_acara' => 'Workshop',
                'lokasi_acara' => 'Bekasi',
                'tanggal_sewa' => '2025-04-25',
                'tanggal_kembali' => '2025-04-27',
                'waktu_sewa' => '09:00',
                'waktu_kembali' => '18:00',
                'status_pembayaran' => 'dp',
                'status_pengembalian' => 'terlambat',
                'total_harga' => 950000,
                'diskon' => 0,
                'grand_total' => 950000,
                'keterangan' => 'Workshop digital',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($peminjaman as $item) {
            Peminjaman::create($item);
        }

        // ==================== DETAIL PEMINJAMAN ====================

        $details = [

            [
                'peminjaman_id' => 1,
                'barang_id' => 9,
                'nama_barang' => 'TV 65 INCH',
                'jenis_barang' => 'TV',
                'harga_sewa' => 700000,
                'jumlah' => 1,
                'subtotal' => 700000,
            ],

            [
                'peminjaman_id' => 1,
                'barang_id' => 1,
                'nama_barang' => 'EPSON 6000 LUMENS',
                'jenis_barang' => 'Proyektor',
                'harga_sewa' => 1000000,
                'jumlah' => 1,
                'subtotal' => 1000000,
            ],

            [
                'peminjaman_id' => 1,
                'barang_id' => 11,
                'nama_barang' => 'KABEL HDMI 2 METER',
                'jenis_barang' => 'Kabel',
                'harga_sewa' => 25000,
                'jumlah' => 2,
                'subtotal' => 50000,
            ],

            [
                'peminjaman_id' => 2,
                'barang_id' => 1,
                'nama_barang' => 'EPSON 6000 LUMENS',
                'jenis_barang' => 'Proyektor',
                'harga_sewa' => 1000000,
                'jumlah' => 1,
                'subtotal' => 1000000,
            ],

            [
                'peminjaman_id' => 2,
                'barang_id' => 4,
                'nama_barang' => 'SCREEN 2x3',
                'jenis_barang' => 'Layar',
                'harga_sewa' => 300000,
                'jumlah' => 1,
                'subtotal' => 300000,
            ],

            [
                'peminjaman_id' => 3,
                'barang_id' => 8,
                'nama_barang' => 'TV 55 INCH',
                'jenis_barang' => 'TV',
                'harga_sewa' => 550000,
                'jumlah' => 2,
                'subtotal' => 1100000,
            ],

            [
                'peminjaman_id' => 3,
                'barang_id' => 9,
                'nama_barang' => 'TV 65 INCH',
                'jenis_barang' => 'TV',
                'harga_sewa' => 700000,
                'jumlah' => 2,
                'subtotal' => 1400000,
            ],

            [
                'peminjaman_id' => 3,
                'barang_id' => 1,
                'nama_barang' => 'EPSON 6000 LUMENS',
                'jenis_barang' => 'Proyektor',
                'harga_sewa' => 1000000,
                'jumlah' => 1,
                'subtotal' => 1000000,
            ],

            [
                'peminjaman_id' => 4,
                'barang_id' => 2,
                'nama_barang' => 'BENQ 4000 LUMENS',
                'jenis_barang' => 'Proyektor',
                'harga_sewa' => 750000,
                'jumlah' => 1,
                'subtotal' => 750000,
            ],

            [
                'peminjaman_id' => 5,
                'barang_id' => 3,
                'nama_barang' => 'PANASONIC 5000 LUMENS',
                'jenis_barang' => 'Proyektor',
                'harga_sewa' => 850000,
                'jumlah' => 2,
                'subtotal' => 1700000,
            ],

            [
                'peminjaman_id' => 5,
                'barang_id' => 8,
                'nama_barang' => 'TV 55 INCH',
                'jenis_barang' => 'TV',
                'harga_sewa' => 550000,
                'jumlah' => 3,
                'subtotal' => 1650000,
            ],

            [
                'peminjaman_id' => 6,
                'barang_id' => 1,
                'nama_barang' => 'EPSON 6000 LUMENS',
                'jenis_barang' => 'Proyektor',
                'harga_sewa' => 1000000,
                'jumlah' => 1,
                'subtotal' => 1000000,
            ],
        ];

        foreach ($details as $detail) {
            DetailPeminjaman::create($detail);
        }

        $this->command->info('✅ Data peminjaman berhasil ditambahkan!');
        $this->command->info('📊 Total peminjaman: ' . count($peminjaman));
        $this->command->info('📦 Total detail barang: ' . count($details));
    }
}