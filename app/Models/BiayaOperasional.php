<?php
// app/Models/BiayaOperasional.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaOperasional extends Model
{
    use HasFactory;

    protected $table = 'biaya_operasional';

    protected $fillable = [
        'kode_biaya',
        'sumber',
        'kategori',
        'deskripsi',
        'jumlah',
        'tanggal',
        'referensi',
        'keterangan',
        'foto_bukti',
        'status',
        'created_by',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'approved_at' => 'datetime',
        'jumlah' => 'decimal:2'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public static function generateKodeBiaya()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $last = self::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->orderBy('id', 'desc')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->kode_biaya, -4);
            $number = $lastNumber + 1;
        } else {
            $number = 1;
        }

        return 'INV/BIAYA/' . $tahun . '/' . $bulan . '/' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
