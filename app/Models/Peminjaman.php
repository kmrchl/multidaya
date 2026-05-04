<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'invoice_number',
        'pelanggan_id',
        'nama_penyewa',
        'no_telepon',
        'customer_whatsapp',
        'nama_acara',
        'lokasi_acara',
        'tanggal_sewa',
        'tanggal_kembali',
        'waktu_sewa',
        'waktu_kembali',
        'status_pembayaran',
        'status_pengembalian',
        'total_harga',
        'diskon',
        'grand_total',
        'keterangan',
        'bukti_pembayaran',
        'foto_pengembalian',
        'catatan_pengembalian',
        'kondisi_barang',
        'kerusakan',
        'biaya_kerusakan',
        'denda',
        'tanggal_pengembalian_real',
        'whatsapp_sent_pengiriman',
        'whatsapp_sent_pengingat',
        'whatsapp_pengingat_sent_at',
        'created_by',
        'ppn',
        'total_ppn',
        'grand_total_with_ppn',
        'jatuh_tempo_pembayaran',
    ];

    protected $casts = [
        'tanggal_sewa' => 'date',
        'tanggal_kembali' => 'date',
        'waktu_sewa' => 'string',
        'waktu_kembali' => 'string',
        'tanggal_pengembalian_real' => 'datetime',
        'total_harga' => 'decimal:2',
        'diskon' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'biaya_kerusakan' => 'decimal:2',
        'denda' => 'decimal:2',
        'whatsapp_sent_pengiriman' => 'boolean',
        'whatsapp_sent_pengingat' => 'boolean',
        'whatsapp_pengingat_sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(DetailPeminjaman::class, 'peminjaman_id');
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function generateInvoiceNumber(): string
    {
        $year = date('Y');
        $month = date('m');

        $last = self::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('id', 'desc')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->invoice_number, -4);
            $number = $lastNumber + 1;
        } else {
            $number = 1;
        }

        return 'INV/MIP/' . $year . '/' . $month . '/' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function getStatusPembayaranTextAttribute(): string
    {
        $status = [
            'belum_bayar' => 'Belum Bayar',
            'dp' => 'DP',
            'lunas' => 'Lunas'
        ];
        return $status[$this->status_pembayaran] ?? $this->status_pembayaran;
    }

    public function getStatusPengembalianTextAttribute(): string
    {
        $status = [
            'aktif' => 'Aktif',
            'selesai' => 'Selesai',
            'terlambat' => 'Terlambat'
        ];
        return $status[$this->status_pengembalian] ?? $this->status_pengembalian;
    }

    public function getKondisiBarangTextAttribute(): string
    {
        $kondisi = [
            'baik' => 'Baik',
            'kurang_baik' => 'Kurang Baik',
            'rusak' => 'Rusak'
        ];
        return $kondisi[$this->kondisi_barang] ?? $this->kondisi_barang;
    }

    public function getTotalBayarAttribute(): float
    {
        return (float)($this->grand_total + ($this->denda ?? 0));
    }

    // Scopes
    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('status_pengembalian', 'aktif');
    }

    public function scopeSelesai(Builder $query): Builder
    {
        return $query->where('status_pengembalian', 'selesai');
    }

    public function scopeTerlambat(Builder $query): Builder
    {
        return $query->where('status_pengembalian', 'terlambat');
    }

    public function scopePelangganBaru(Builder $query): Builder
    {
        return $query->whereHas('pelanggan', function ($q) {
            $q->where('total_transaksi', '<=', 1);
        });
    }

    public function scopePelangganLama(Builder $query): Builder
    {
        return $query->whereHas('pelanggan', function ($q) {
            $q->where('total_transaksi', '>', 1);
        });
    }

    public function scopeByBulan(Builder $query, int $bulan, int $tahun): Builder
    {
        return $query->whereMonth('tanggal_sewa', $bulan)
            ->whereYear('tanggal_sewa', $tahun);
    }

    public function scopeByPeriode(Builder $query, string $startDate, string $endDate): Builder
    {
        return $query->whereBetween('tanggal_sewa', [$startDate, $endDate]);
    }
}
