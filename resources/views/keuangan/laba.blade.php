@extends('layouts.app')

@section('title', 'Laporan Laba Bersih')

@section('main-content')
<div class="p-6 max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Laporan Laba Bersih</h1>
            <p class="text-slate-500">
                Bulan {{ $bulan }} Tahun {{ $tahun }}
            </p>
        </div>

        <a href="{{ route('keuangan.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
           class="bg-slate-700 text-white px-4 py-2 rounded-xl">
            Kembali
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-3xl border shadow-sm p-6">
            <h3 class="text-sm font-bold text-slate-500 uppercase mb-2">
                Pendapatan
            </h3>

            <p class="text-3xl font-black text-green-600">
                Rp {{ number_format($pendapatan, 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white rounded-3xl border shadow-sm p-6">
            <h3 class="text-sm font-bold text-slate-500 uppercase mb-2">
                Pengeluaran
            </h3>

            <p class="text-3xl font-black text-red-600">
                Rp {{ number_format($pengeluaran, 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white rounded-3xl border shadow-sm p-6">
            <h3 class="text-sm font-bold text-slate-500 uppercase mb-2">
                Laba Bersih
            </h3>

            <p class="text-3xl font-black text-blue-600">
                Rp {{ number_format($laba, 0, ',', '.') }}
            </p>
        </div>

    </div>
</div>
@endsection