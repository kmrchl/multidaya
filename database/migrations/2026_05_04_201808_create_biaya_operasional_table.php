<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('biaya_operasional', function (Blueprint $table) {
            $table->id();
            $table->string('kode_biaya')->unique(); // INV/BIAYA/2024/05/001
            $table->string('sumber'); // operasional, promosi, inventaris
            $table->string('kategori');
            $table->string('deskripsi');
            $table->decimal('jumlah', 15, 2);
            $table->date('tanggal');
            $table->string('referensi')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('foto_bukti')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('biaya_operasional');
    }
};
