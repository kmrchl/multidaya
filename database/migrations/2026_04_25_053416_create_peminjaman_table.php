<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus tabel jika ada
        Schema::dropIfExists('peminjaman');

        // Buat tabel baru dengan struktur sederhana
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->nullOnDelete();
            $table->string('nama_penyewa');
            $table->string('no_telepon');
            $table->string('customer_whatsapp')->nullable();
            $table->string('nama_acara')->nullable();
            $table->text('lokasi_acara')->nullable();
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->time('waktu_sewa');
            $table->time('waktu_kembali');
            $table->enum('status_pembayaran', ['belum_bayar', 'dp', 'lunas'])->default('belum_bayar');
            $table->enum('status_pengembalian', ['aktif', 'selesai', 'terlambat'])->default('aktif');
            $table->decimal('total_harga', 15, 0);
            $table->decimal('diskon', 15, 0)->default(0);
            $table->decimal('grand_total', 15, 0);
            $table->text('keterangan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->datetime('tanggal_pengembalian_real')->nullable();
            $table->enum('kondisi_barang', ['baik', 'kurang_baik', 'rusak'])->nullable();
            $table->decimal('denda', 15, 0)->default(0);
            $table->text('catatan_pengembalian')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
