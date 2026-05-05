<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 12px; }
    </style>
</head>
<body>

<h1>Laporan Keuangan</h1>
<p>Bulan: {{ $bulan }} / {{ $tahun }}</p>

<h3>Pendapatan</h3>
<table>
    <tr>
        <th>Tanggal</th>
        <th>Deskripsi</th>
        <th>Jumlah</th>
    </tr>
    @foreach($pendapatan as $item)
    <tr>
        <td>{{ $item->tanggal }}</td>
        <td>{{ $item->deskripsi }}</td>
        <td>Rp {{ number_format($item->jumlah,0,',','.') }}</td>
    </tr>
    @endforeach
</table>

<h3>Pengeluaran</h3>
<table>
    <tr>
        <th>Tanggal</th>
        <th>Deskripsi</th>
        <th>Jumlah</th>
    </tr>
    @foreach($pengeluaran as $item)
    <tr>
        <td>{{ $item->tanggal }}</td>
        <td>{{ $item->deskripsi }}</td>
        <td>Rp {{ number_format($item->jumlah,0,',','.') }}</td>
    </tr>
    @endforeach
</table>

<h3>Ringkasan</h3>
<p>Total Pendapatan: Rp {{ number_format($totalPendapatan,0,',','.') }}</p>
<p>Total Pengeluaran: Rp {{ number_format($totalPengeluaran,0,',','.') }}</p>
<p><strong>Laba Bersih: Rp {{ number_format($laba,0,',','.') }}</strong></p>

</body>
</html>