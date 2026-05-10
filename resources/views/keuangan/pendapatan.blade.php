@extends('layouts.app')

@section('title', 'Laporan Pendapatan')

@section('main-content')
<div class="p-6 max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Laporan Pendapatan</h1>
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
        <h2 class="text-lg font-bold mb-2">Total Pendapatan</h2>
        <p class="text-3xl font-black text-green-600">
            Rp {{ number_format($total, 0, ',', '.') }}
        </p>
    </div>

    <div class="mb-4 text-sm text-slate-500">
        Jumlah data:
        <span class="font-bold">
            {{ $data->count() }}
        </span>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-100">
                <tr>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <<th class="px-4 py-3 text-left">Deskripsi</th>
                    <th class="px-4 py-3 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr class="border-t">
                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $item->deskripsi }}
                        </td>
                        <td class="px-4 py-3 text-right font-bold text-green-600">
                            Rp {{ number_format($item->grand_total, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-6 text-slate-400">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection