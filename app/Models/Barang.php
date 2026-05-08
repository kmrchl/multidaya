<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jenis',
        'harga_sewa',
        'stok',
        'tersedia',
        'disewa',
        'status',
        'deskripsi',
        'gambar',
        'created_by'
    ];

    protected $casts = [
        'harga_sewa' => 'decimal:2',
        'stok' => 'integer',
        'tersedia' => 'integer',
        'disewa' => 'integer'
    ];

    // Relasi ke detail peminjaman
    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'barang_id');
    }

    // Generate kode barang otomatis
    public static function generateKodeBarang()
    {
        $last = self::orderBy('id', 'desc')->first();
        $number = $last ? intval(substr($last->kode_barang, 2)) + 1 : 1;
        return 'BS' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
