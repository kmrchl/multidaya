<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'no_telepon',
        'email',
        'alamat',
        'tipe',
        'npwp',
        'total_transaksi',
        'total_nilai_transaksi',
        'status',
        'keterangan'
    ];

    protected $attributes = [
        'total_transaksi' => 0,
        'total_nilai_transaksi' => 0,
        'status' => 'aktif'
    ];

    protected $casts = [
        'total_nilai_transaksi' => 'decimal:2',
        'total_transaksi' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function getIsPelangganBaruAttribute(): bool
    {
        return $this->total_transaksi <= 1;
    }

    public function getIsPelangganLamaAttribute(): bool
    {
        return $this->total_transaksi > 1;
    }

    public function getTipePelangganTextAttribute(): string
    {
        return $this->tipe === 'perusahaan' ? 'Perusahaan' : 'Perorangan';
    }

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('status', 'aktif');
    }

    public function scopePelangganBaru(Builder $query): Builder
    {
        return $query->where('total_transaksi', '<=', 1);
    }

    public function scopePelangganLama(Builder $query): Builder
    {
        return $query->where('total_transaksi', '>', 1);
    }
}
