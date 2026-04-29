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
        // Nonaktifkan foreign key checks
        Schema::disableForeignKeyConstraints();

        // Kosongkan tabel
        DB::table('detail_peminjaman')->truncate();
        DB::table('peminjaman')->truncate();

        // Aktifkan kembali foreign key checks
        Schema::enableForeignKeyConstraints();

        // ==================== DATA PEMINJAMAN ====================
        $peminjaman = [
            // ==================== PEMINJAMAN AKTIF ====================
            [
                'invoice_number' => 'INV/2025/001',
                'pelanggan_id' => 1,
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
                'keterangan' => 'Acara presentasi produk baru perusahaan',
                'created_by' => 1,
                'created_at' => '2025-05-05 10:00:00',
                'updated_at' => '2025-05-05 10:00:00'
            ],
            [
                'invoice_number' => 'INV/2025/002',
                'pelanggan_id' => 2,
                'nama_penyewa' => 'Siti Aminah',
                'no_telepon' => '081298765432',
                'customer_whatsapp' => '081298765432',
                'nama_acara' => 'Acara Pernikahan',
                'lokasi_acara' => 'Gedung Serbaguna, Depok',
                'tanggal_sewa' => '2025-05-15',
                'tanggal_kembali' => '2025-05-16',
                'waktu_sewa' => '09:00',
                'waktu_kembali' => '21:00',
                'status_pembayaran' => 'dp',
                'status_pengembalian' => 'aktif',
                'total_harga' => 1350000,
                'diskon' => 50000,
                'grand_total' => 1300000,
                'keterangan' => 'Acara pernikahan anak pertama',
                'created_by' => 1,
                'created_at' => '2025-05-08 14:30:00',
                'updated_at' => '2025-05-08 14:30:00'
            ],
            [
                'invoice_number' => 'INV/2025/003',
                'pelanggan_id' => 3,
                'nama_penyewa' => 'PT. Maju Jaya Abadi',
                'no_telepon' => '082233445566',
                'customer_whatsapp' => '082233445566',
                'nama_acara' => 'Company Gathering',
                'lokasi_acara' => 'Hotel Grand Indonesia',
                'tanggal_sewa' => '2025-05-20',
                'tanggal_kembali' => '2025-05-22',
                'waktu_sewa' => '07:00',
                'waktu_kembali' => '22:00',
                'status_pembayaran' => 'lunas',
                'status_pengembalian' => 'aktif',
                'total_harga' => 5200000,
                'diskon' => 200000,
                'grand_total' => 5000000,
                'keterangan' => 'Company gathering tahunan PT Maju Jaya',
                'created_by' => 1,
                'created_at' => '2025-05-10 09:15:00',
                'updated_at' => '2025-05-10 09:15:00'
            ],

            // ==================== PEMINJAMAN SELESAI ====================
            [
                'invoice_number' => 'INV/2025/004',
                'pelanggan_id' => 3,
                'nama_penyewa' => 'PT. Maju Jaya Abadi',
                'no_telepon' => '082233445566',
                'customer_whatsapp' => '082233445566',
                'nama_acara' => 'Rapat Tahunan',
                'lokasi_acara' => 'Kantor PT Maju Jaya',
                'tanggal_sewa' => '2025-04-01',
                'tanggal_kembali' => '2025-04-02',
                'waktu_sewa' => '08:00',
                'waktu_kembali' => '17:00',
                'status_pembayaran' => 'lunas',
                'status_pengembalian' => 'selesai',
                'total_harga' => 1750000,
                'diskon' => 0,
                'grand_total' => 1750000,
                'keterangan' => 'Rapat tahunan dengan investor',
                'created_by' => 1,
                'tanggal_pengembalian_real' => '2025-04-02 18:30:00',
                'kondisi_barang' => 'baik',
                'denda' => 0,
                'catatan_pengembalian' => 'Barang dikembalikan dalam kondisi baik',
                'created_at' => '2025-03-28 10:00:00',
                'updated_at' => '2025-04-02 19:00:00'
            ],
            [
                'invoice_number' => 'INV/2025/005',
                'pelanggan_id' => 4,
                'nama_penyewa' => 'Dewi Puspita',
                'no_telepon' => '085677889900',
                'customer_whatsapp' => '085677889900',
                'nama_acara' => 'Ulang Tahun Anak',
                'lokasi_acara' => 'Rumah pribadi, Surabaya',
                'tanggal_sewa' => '2025-04-10',
                'tanggal_kembali' => '2025-04-11',
                'waktu_sewa' => '10:00',
                'waktu_kembali' => '20:00',
                'status_pembayaran' => 'lunas',
                'status_pengembalian' => 'selesai',
                'total_harga' => 850000,
                'diskon' => 0,
                'grand_total' => 850000,
                'keterangan' => 'Acara ulang tahun anak ke-7',
                'created_by' => 1,
                'tanggal_pengembalian_real' => '2025-04-11 21:30:00',
                'kondisi_barang' => 'baik',
                'denda' => 0,
                'catatan_pengembalian' => 'Barang kembali tepat waktu',
                'created_at' => '2025-04-05 14:00:00',
                'updated_at' => '2025-04-11 22:00:00'
            ],
            [
                'invoice_number' => 'INV/2025/006',
                'pelanggan_id' => 5,
                'nama_penyewa' => 'CV. Karya Mandiri',
                'no_telepon' => '081377889900',
                'customer_whatsapp' => '081377889900',
                'nama_acara' => 'Exhibition',
                'lokasi_acara' => 'Bandung Convention Center',
                'tanggal_sewa' => '2025-04-15',
                'tanggal_kembali' => '2025-04-17',
                'waktu_sewa' => '08:00',
                'waktu_kembali' => '21:00',
                'status_pembayaran' => 'lunas',
                'status_pengembalian' => 'selesai',
                'total_harga' => 7850000,
                'diskon' => 350000,
                'grand_total' => 7500000,
                'keterangan' => 'Pameran produk di Bandung',
                'created_by' => 1,
                'tanggal_pengembalian_real' => '2025-04-17 22:00:00',
                'kondisi_barang' => 'baik',
                'denda' => 50000,
                'catatan_pengembalian' => 'Terlambat 1 jam, dikenakan denda',
                'created_at' => '2025-04-10 11:00:00',
                'updated_at' => '2025-04-17 23:00:00'
            ],

            // ==================== PEMINJAMAN TERLAMBAT ====================
            [
                'invoice_number' => 'INV/2025/007',
                'pelanggan_id' => 1,
                'nama_penyewa' => 'Budi Santoso',
                'no_telepon' => '081234567890',
                'customer_whatsapp' => '081234567890',
                'nama_acara' => 'Workshop Digital',
                'lokasi_acara' => 'Jakarta Pusat',
                'tanggal_sewa' => '2025-04-25',
                'tanggal_kembali' => '2025-04-27',
                'waktu_sewa' => '09:00',
                'waktu_kembali' => '18:00',
                'status_pembayaran' => 'dp',
                'status_pengembalian' => 'terlambat',
                'total_harga' => 950000,
                'diskon' => 0,
                'grand_total' => 950000,
                'keterangan' => 'Workshop digital marketing',
                'created_by' => 1,
                'created_at' => '2025-04-20 09:00:00',
                'updated_at' => '2025-04-28 08:00:00'
            ],
            [
                'invoice_number' => 'INV/2025/008',
                'pelanggan_id' => 6,
                'nama_penyewa' => 'Rudi Hartono',
                'no_telepon' => '087712345678',
                'customer_whatsapp' => '087712345678',
                'nama_acara' => 'Seminar',
                'lokasi_acara' => 'Semarang',
                'tanggal_sewa' => '2025-04-28',
                'tanggal_kembali' => '2025-04-30',
                'waktu_sewa' => '08:00',
                'waktu_kembali' => '17:00',
                'status_pembayaran' => 'belum_bayar',
                'status_pengembalian' => 'terlambat',
                'total_harga' => 2100000,
                'diskon' => 100000,
                'grand_total' => 2000000,
                'keterangan' => 'Seminar teknologi',
                'created_by' => 1,
                'created_at' => '2025-04-25 13:00:00',
                'updated_at' => '2025-05-01 08:00:00'
            ]
        ];

        foreach ($peminjaman as $item) {
            Peminjaman::create($item);
        }

        // ==================== DETAIL PEMINJAMAN ====================

        // Detail untuk INV/2025/001
        $details = [
            // Peminjaman 1
            ['peminjaman_id' => 1, 'barang_id' => 5, 'nama_barang' => 'TV 65 INCH', 'jenis_barang' => 'TV', 'harga_sewa' => 700000, 'jumlah' => 1, 'subtotal' => 700000],
            ['peminjaman_id' => 1, 'barang_id' => 1, 'nama_barang' => 'EPSON 6000 LUMENS', 'jenis_barang' => 'Proyektor', 'harga_sewa' => 1000000, 'jumlah' => 1, 'subtotal' => 1000000],
            ['peminjaman_id' => 1, 'barang_id' => 9, 'nama_barang' => 'KABEL HDMI 2 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 25000, 'jumlah' => 2, 'subtotal' => 50000],
            ['peminjaman_id' => 1, 'barang_id' => 11, 'nama_barang' => 'KABEL VGA 3 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 20000, 'jumlah' => 1, 'subtotal' => 20000],
            ['peminjaman_id' => 1, 'barang_id' => 12, 'nama_barang' => 'KABEL POWER EXTENSION', 'jenis_barang' => 'Kabel', 'harga_sewa' => 15000, 'jumlah' => 2, 'subtotal' => 30000],

            // Peminjaman 2
            ['peminjaman_id' => 2, 'barang_id' => 1, 'nama_barang' => 'EPSON 6000 LUMENS', 'jenis_barang' => 'Proyektor', 'harga_sewa' => 1000000, 'jumlah' => 1, 'subtotal' => 1000000],
            ['peminjaman_id' => 2, 'barang_id' => 6, 'nama_barang' => 'SCREEN 2x3', 'jenis_barang' => 'Layar', 'harga_sewa' => 300000, 'jumlah' => 1, 'subtotal' => 300000],
            ['peminjaman_id' => 2, 'barang_id' => 9, 'nama_barang' => 'KABEL HDMI 2 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 25000, 'jumlah' => 2, 'subtotal' => 50000],

            // Peminjaman 3
            ['peminjaman_id' => 3, 'barang_id' => 4, 'nama_barang' => 'TV 55 INCH', 'jenis_barang' => 'TV', 'harga_sewa' => 550000, 'jumlah' => 2, 'subtotal' => 1100000],
            ['peminjaman_id' => 3, 'barang_id' => 5, 'nama_barang' => 'TV 65 INCH', 'jenis_barang' => 'TV', 'harga_sewa' => 700000, 'jumlah' => 2, 'subtotal' => 1400000],
            ['peminjaman_id' => 3, 'barang_id' => 1, 'nama_barang' => 'EPSON 6000 LUMENS', 'jenis_barang' => 'Proyektor', 'harga_sewa' => 1000000, 'jumlah' => 1, 'subtotal' => 1000000],
            ['peminjaman_id' => 3, 'barang_id' => 7, 'nama_barang' => 'SCREEN 3x4', 'jenis_barang' => 'Layar', 'harga_sewa' => 400000, 'jumlah' => 2, 'subtotal' => 800000],
            ['peminjaman_id' => 3, 'barang_id' => 9, 'nama_barang' => 'KABEL HDMI 2 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 25000, 'jumlah' => 4, 'subtotal' => 100000],
            ['peminjaman_id' => 3, 'barang_id' => 10, 'nama_barang' => 'KABEL HDMI 5 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 35000, 'jumlah' => 2, 'subtotal' => 70000],
            ['peminjaman_id' => 3, 'barang_id' => 12, 'nama_barang' => 'KABEL POWER EXTENSION', 'jenis_barang' => 'Kabel', 'harga_sewa' => 15000, 'jumlah' => 6, 'subtotal' => 90000],

            // Peminjaman 4
            ['peminjaman_id' => 4, 'barang_id' => 2, 'nama_barang' => 'BENQ 4000 LUMENS', 'jenis_barang' => 'Proyektor', 'harga_sewa' => 750000, 'jumlah' => 1, 'subtotal' => 750000],
            ['peminjaman_id' => 4, 'barang_id' => 6, 'nama_barang' => 'SCREEN 2x3', 'jenis_barang' => 'Layar', 'harga_sewa' => 300000, 'jumlah' => 1, 'subtotal' => 300000],
            ['peminjaman_id' => 4, 'barang_id' => 2, 'nama_barang' => 'TV 50 INCH', 'jenis_barang' => 'TV', 'harga_sewa' => 450000, 'jumlah' => 1, 'subtotal' => 450000],
            ['peminjaman_id' => 4, 'barang_id' => 9, 'nama_barang' => 'KABEL HDMI 2 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 25000, 'jumlah' => 2, 'subtotal' => 50000],
            ['peminjaman_id' => 4, 'barang_id' => 11, 'nama_barang' => 'KABEL VGA 3 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 20000, 'jumlah' => 1, 'subtotal' => 20000],
            ['peminjaman_id' => 4, 'barang_id' => 12, 'nama_barang' => 'KABEL POWER EXTENSION', 'jenis_barang' => 'Kabel', 'harga_sewa' => 15000, 'jumlah' => 2, 'subtotal' => 30000],

            // Peminjaman 5
            ['peminjaman_id' => 5, 'barang_id' => 2, 'nama_barang' => 'TV 50 INCH', 'jenis_barang' => 'TV', 'harga_sewa' => 450000, 'jumlah' => 1, 'subtotal' => 450000],
            ['peminjaman_id' => 5, 'barang_id' => 14, 'nama_barang' => 'SOUND SYSTEM PORTABLE', 'jenis_barang' => 'Audio', 'harga_sewa' => 350000, 'jumlah' => 1, 'subtotal' => 350000],
            ['peminjaman_id' => 5, 'barang_id' => 12, 'nama_barang' => 'KABEL POWER EXTENSION', 'jenis_barang' => 'Kabel', 'harga_sewa' => 15000, 'jumlah' => 2, 'subtotal' => 30000],
            ['peminjaman_id' => 5, 'barang_id' => 14, 'nama_barang' => 'KABEL AUDIO JACK', 'jenis_barang' => 'Kabel', 'harga_sewa' => 10000, 'jumlah' => 2, 'subtotal' => 20000],

            // Peminjaman 6
            ['peminjaman_id' => 6, 'barang_id' => 3, 'nama_barang' => 'PANASONIC 5000 LUMENS', 'jenis_barang' => 'Proyektor', 'harga_sewa' => 850000, 'jumlah' => 2, 'subtotal' => 1700000],
            ['peminjaman_id' => 6, 'barang_id' => 4, 'nama_barang' => 'TV 55 INCH', 'jenis_barang' => 'TV', 'harga_sewa' => 550000, 'jumlah' => 3, 'subtotal' => 1650000],
            ['peminjaman_id' => 6, 'barang_id' => 5, 'nama_barang' => 'TV 65 INCH', 'jenis_barang' => 'TV', 'harga_sewa' => 700000, 'jumlah' => 2, 'subtotal' => 1400000],
            ['peminjaman_id' => 6, 'barang_id' => 1, 'nama_barang' => 'EPSON 6000 LUMENS', 'jenis_barang' => 'Proyektor', 'harga_sewa' => 1000000, 'jumlah' => 1, 'subtotal' => 1000000],
            ['peminjaman_id' => 6, 'barang_id' => 7, 'nama_barang' => 'SCREEN 3x4', 'jenis_barang' => 'Layar', 'harga_sewa' => 400000, 'jumlah' => 2, 'subtotal' => 800000],
            ['peminjaman_id' => 6, 'barang_id' => 9, 'nama_barang' => 'KABEL HDMI 2 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 25000, 'jumlah' => 6, 'subtotal' => 150000],
            ['peminjaman_id' => 6, 'barang_id' => 10, 'nama_barang' => 'KABEL HDMI 5 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 35000, 'jumlah' => 3, 'subtotal' => 105000],
            ['peminjaman_id' => 6, 'barang_id' => 11, 'nama_barang' => 'KABEL VGA 3 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 20000, 'jumlah' => 2, 'subtotal' => 40000],
            ['peminjaman_id' => 6, 'barang_id' => 12, 'nama_barang' => 'KABEL POWER EXTENSION', 'jenis_barang' => 'Kabel', 'harga_sewa' => 15000, 'jumlah' => 8, 'subtotal' => 120000],

            // Peminjaman 7
            ['peminjaman_id' => 7, 'barang_id' => 1, 'nama_barang' => 'EPSON 6000 LUMENS', 'jenis_barang' => 'Proyektor', 'harga_sewa' => 1000000, 'jumlah' => 1, 'subtotal' => 1000000],
            ['peminjaman_id' => 7, 'barang_id' => 9, 'nama_barang' => 'KABEL HDMI 2 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 25000, 'jumlah' => 2, 'subtotal' => 50000],

            // Peminjaman 8
            ['peminjaman_id' => 8, 'barang_id' => 4, 'nama_barang' => 'TV 55 INCH', 'jenis_barang' => 'TV', 'harga_sewa' => 550000, 'jumlah' => 2, 'subtotal' => 1100000],
            ['peminjaman_id' => 8, 'barang_id' => 2, 'nama_barang' => 'TV 50 INCH', 'jenis_barang' => 'TV', 'harga_sewa' => 450000, 'jumlah' => 2, 'subtotal' => 900000],
            ['peminjaman_id' => 8, 'barang_id' => 9, 'nama_barang' => 'KABEL HDMI 2 METER', 'jenis_barang' => 'Kabel', 'harga_sewa' => 25000, 'jumlah' => 4, 'subtotal' => 100000],
        ];

        foreach ($details as $detail) {
            DetailPeminjaman::create($detail);
        }

        $this->command->info('✅ Data peminjaman berhasil ditambahkan!');
        $this->command->info('📊 Total: ' . count($peminjaman) . ' peminjaman');
        $this->command->info('   - Sewa Aktif: 3 peminjaman');
        $this->command->info('   - Riwayat Selesai: 3 peminjaman');
        $this->command->info('   - Terlambat: 2 peminjaman');
        $this->command->info('📦 Total detail: ' . count($details) . ' item barang');
    }
}
