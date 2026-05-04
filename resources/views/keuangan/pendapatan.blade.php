@extends('layouts.app')

@section('title', 'Detail Pendapatan')

@section('main-content')
<div class="p-6 max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Detail Pendapatan</h1>

    <div class="bg-white shadow rounded-xl p-4 mb-4">
        <p class="text-lg font-semibold">Total: Rp {{ number_format($total,0,',','.') }}</p>
    </div>

    <div class="bg-white shadow rounded-xl p-4">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b">
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr class="border-b">
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td class="text-green-600">Rp {{ number_format($item->jumlah,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection