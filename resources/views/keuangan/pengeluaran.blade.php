@extends('layouts.app')

@section('title', 'Laporan Pengeluaran')

@section('main-content')
<div class="p-6 max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Laporan Pengeluaran</h1>
            <p class="text-slate-500">
                Bulan {{ $bulan }} Tahun {{ $tahun }}
            </p>
        </div>

        <a href="{{ route('keuangan.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
           class="bg-slate-700 text-white px-4 py-2 rounded-xl">
            Kembali
        </a>
    </div>
    <div class="bg-white rounded-3xl shadow-sm border p-6 mb-6">
        <h2 class="text-lg font-bold mb-2">Total Pengeluaran</h2>
        <p class="text-3xl font-black text-red-600">
            Rp {{ number_format($total, 0, ',', '.') }}
        </p>
    </div>

    <div class="mb-4 text-sm text-slate-500">
        Total Data:
        <span class="font-bold">
            {{ $data->count() }}
        </span>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-100">
                <tr>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Deskripsi</th>
                    <th class="px-4 py-3 text-right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr class="border-t">
                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $item->kategori }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $item->deskripsi }}
                        </td>
                        <td class="px-4 py-3 text-right font-bold text-red-600">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-slate-400">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection