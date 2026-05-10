<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan foreign key sementara
        Schema::disableForeignKeyConstraints();

        // Kosongkan tabel
        DB::table('pelanggan')->truncate();

        // Aktifkan lagi foreign key
        Schema::enableForeignKeyConstraints();

        $pelanggan = [
            [
                'nama' => 'Budi Santoso',
                'no_telepon' => '081234567890',
                'email' => 'budi@example.com',
                'alamat' => 'Jl. Sudirman No. 10, Jakarta',
                'tipe' => 'perorangan',
                'npwp' => null,
                'total_transaksi' => 5,
                'total_nilai_transaksi' => 8500000,
                'status' => 'aktif',
                'keterangan' => 'Pelanggan rutin untuk acara perusahaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'PT Maju Jaya',
                'no_telepon' => '081298765432',
                'email' => 'admin@majujaya.com',
                'alamat' => 'Jl. Gatot Subroto No. 21, Bandung',
                'tipe' => 'perusahaan',
                'npwp' => '12.345.678.9-123.000',
                'total_transaksi' => 12,
                'total_nilai_transaksi' => 27500000,
                'status' => 'aktif',
                'keterangan' => 'Sering menyewa TV dan proyektor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Aminah',
                'no_telepon' => '081377788899',
                'email' => 'sitiaminah@example.com',
                'alamat' => 'Jl. Merdeka No. 5, Yogyakarta',
                'tipe' => 'perorangan',
                'npwp' => null,
                'total_transaksi' => 2,
                'total_nilai_transaksi' => 2400000,
                'status' => 'aktif',
                'keterangan' => 'Pernah menyewa untuk seminar kampus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'CV Teknologi Nusantara',
                'no_telepon' => '082112223333',
                'email' => 'info@teknologinusantara.com',
                'alamat' => 'Jl. Ahmad Yani No. 88, Surabaya',
                'tipe' => 'perusahaan',
                'npwp' => '98.765.432.1-456.000',
                'total_transaksi' => 8,
                'total_nilai_transaksi' => 18400000,
                'status' => 'aktif',
                'keterangan' => 'Langganan event tahunan perusahaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Rahmat Hidayat',
                'no_telepon' => '081355566677',
                'email' => null,
                'alamat' => 'Jl. Diponegoro No. 15, Bekasi',
                'tipe' => 'perorangan',
                'npwp' => null,
                'total_transaksi' => 1,
                'total_nilai_transaksi' => 950000,
                'status' => 'nonaktif',
                'keterangan' => 'Tidak aktif sejak tahun lalu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('pelanggan')->insert($pelanggan);

        $this->command->info('Data pelanggan berhasil ditambahkan!');
        $this->command->info('Total: ' . count($pelanggan) . ' pelanggan');
    }
}