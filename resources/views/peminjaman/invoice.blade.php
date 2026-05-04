<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $peminjaman->invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #1e293b;
            padding: 20px;
            background: #f1f5f9;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* ==================== HEADER 3 KOLOM SEJAJAR ==================== */
        .header {
            padding: 20px 25px;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            padding: 0;
            vertical-align: top;
        }

        /* Kolom 1: Logo */
        .header-logo {
            width: 100px;
            text-align: center;
        }

        .header-logo img {
            max-width: 70px;
            max-height: 70px;
            object-fit: contain;
            background: white;
            border-radius: 8px;
            padding: 5px;
        }

        /* Kolom 2: Nama Perusahaan & Alamat */
        .header-company {
            text-align: center;
        }

        .header-company h1 {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 5px;
            color: rgb(7, 7, 7), 0, 0);
        }

        .header-company h4 {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            color: #94a3b8;
        }

        .header-company p {
            font-size: 9px;
            line-height: 1.4;
            color: #000000;
        }

        /* Kolom 3: INVOICE & Nomor */
        .header-invoice {
            width: 130px;
            text-align: right;
        }

        .invoice-label {
            font-size: 11px;
            font-weight: 600;
            color: #000000;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .invoice-number {
            font-size: 12px;
            font-weight: 700;
            color: #000000;
            letter-spacing: 0.5px;
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
        }

        /* ==================== TITLE ==================== */
        .title {
            text-align: center;
            margin: 20px 0;
        }

        .title h2 {
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #0f172a;
            padding-bottom: 8px;
            border-bottom: 2px solid #0f172a;
            display: inline-block;
        }

        /* ==================== INFO SECTION ==================== */
        .info-section {
            padding: 0 25px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            background: #f8fafc;
            border-radius: 8px;
            overflow: hidden;
        }

        .info-table td {
            padding: 10px 12px;
            vertical-align: top;
            border-bottom: 1px solid #e2e8f0;
        }

        .info-table tr:last-child td {
            border-bottom: none;
        }

        .info-table td:first-child {
            width: 35%;
            font-weight: 700;
            color: #0f172a;
            background: #f1f5f9;
        }

        .info-table td:last-child {
            color: #334155;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
        }

        .status-aktif {
            background: #dcfce7;
            color: #166534;
        }

        .status-selesai {
            background: #f1f5f9;
            color: #475569;
        }

        .status-terlambat {
            background: #fee2e2;
            color: #991b1b;
        }

        .payment-status {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
        }

        .payment-belum_bayar {
            background: #fee2e2;
            color: #991b1b;
        }

        .payment-dp {
            background: #fef3c7;
            color: #b45309;
        }

        .payment-lunas {
            background: #dcfce7;
            color: #166534;
        }

        /* ==================== ITEMS TABLE ==================== */
        .items-section {
            padding: 0 25px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 11px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #e2e8f0;
            padding: 10px 8px;
            text-align: left;
        }

        .items-table th {
            background-color: #1e293b;
            color: white;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .items-table td:last-child,
        .items-table th:last-child {
            text-align: right;
        }

        .items-table td:nth-child(3),
        .items-table th:nth-child(3),
        .items-table td:nth-child(4),
        .items-table th:nth-child(4) {
            text-align: right;
        }

        .items-table td:nth-child(2),
        .items-table th:nth-child(2) {
            text-align: center;
        }

        /* ==================== TOTAL SECTION ==================== */
        .total-section {
            padding: 0 25px;
            margin-top: 15px;
        }

        .total {
            text-align: right;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
        }

        .total table {
            width: 320px;
            margin-left: auto;
            border-collapse: collapse;
        }

        .total td {
            padding: 6px 5px;
        }

        .total .grand-total {
            font-size: 14px;
            font-weight: 800;
            color: #0f172a;
        }

        /* ==================== TERBILANG ==================== */
        .terbilang {
            margin: 15px 25px;
            padding: 12px 15px;
            background: #f8fafc;
            border-left: 3px solid #0f172a;
            font-size: 11px;
            color: #334155;
        }

        /* ==================== JATUH TEMPO ==================== */
        .jatuh-tempo {
            margin: 10px 25px;
            padding: 10px 15px;
            background: #fffbeb;
            border-left: 3px solid #f59e0b;
            font-size: 11px;
        }

        .ttd-section {
            padding: 0 25px;
            margin-top: 30px;
        }

        .ttd {
            display: flex;
            justify-content: space-between;
        }

        .ttd div {
            text-align: center;
            width: 200px;
        }

        .ttd p:first-child {
            font-size: 10px;
            color: #475569;
            margin-bottom: 5px;
        }

        .ttd .line {
            margin-top: 30px;
            padding-top: 5px;
            border-top: 1px solid #cbd5e1;
            width: 180px;
        }

        .ttd .line+p {
            margin-top: 8px;
            font-weight: 600;
            font-size: 11px;
        }

        /* ==================== FOOTER ==================== */
        .footer {
            margin-top: 30px;
            padding: 15px 25px;
            background: #f8fafc;
            text-align: center;
            font-size: 9px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- ==================== HEADER 3 KOLOM SEJAJAR ==================== -->
        <div class="header">
            <table class="header-table">
                <tr>
                    <!-- Kolom 1: Logo -->
                    <td class="header-logo">
                        <img src="{{ public_path('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
                    </td>

                    <!-- Kolom 2: Nama Perusahaan & Alamat -->
                    <td class="header-company">
                        <h1>CV. MULTIDAYA INTI PERSADA</h1>
                        <p>Jln Rayong, Berdikari No. 17, Kebon Jeruk, Jakarta Barat 11540</p>
                        <p>Telp: 08123456789 | Email: info@multidaya.com</p>
                    </td>

                    <!-- Kolom 3: INVOICE & Nomor -->
                    <td class="header-invoice">
                        <div class="invoice-label">No. </div>
                        <div class="invoice-number">{{ $peminjaman->invoice_number }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Title -->
        <div class="title">
            <h2>INVOICE</h2>
        </div>

        <!-- Info Peminjaman -->
        <div class="info-section">
            <table class="info-table">
                <tr>
                    <td><strong>Nama Penyewa</strong></td>
                    <td>: {{ $peminjaman->nama_penyewa }}</td>
                </tr>
                <tr>
                    <td><strong>No. Telepon</strong></td>
                    <td>: {{ $peminjaman->no_telepon }}</td>
                </tr>
                <tr>
                    <td><strong>Nama Acara</strong></td>
                    <td>: {{ $peminjaman->nama_acara ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Lokasi Acara</strong>
                    <td>: {{ $peminjaman->lokasi_acara ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Periode Sewa</strong></td>
                    <td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_sewa)->format('d/m/Y') }} -
                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Status Pengembalian</strong></td>
                    <td>: <span
                            class="status-badge status-{{ $peminjaman->status_pengembalian }}">{{ strtoupper($peminjaman->status_pengembalian) }}</span>
                    </td>
                </tr>
                <tr>
                    <td><strong>Status Pembayaran</strong></td>
                    <td>: <span
                            class="payment-status payment-{{ $peminjaman->status_pembayaran }}">{{ ucfirst(str_replace('_', ' ', $peminjaman->status_pembayaran)) }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Jatuh Tempo Pembayaran -->
        @if ($peminjaman->jatuh_tempo_pembayaran)
            <div class="jatuh-tempo">
                <strong>⚠️ Jatuh Tempo Pembayaran:</strong>
                {{ \Carbon\Carbon::parse($peminjaman->jatuh_tempo_pembayaran)->format('d/m/Y') }}
                @if (now() > \Carbon\Carbon::parse($peminjaman->jatuh_tempo_pembayaran))
                    <span style="color: #dc2626; margin-left: 10px;">(LEWAT JATUH TEMPO!)</span>
                @endif
            </div>
        @endif

        <!-- Detail Barang -->
        <div class="items-section">
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th width="50">Jml</th>
                        <th width="100">Harga</th>
                        <th width="100">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman->details as $detail)
                        <tr>
                            <td>{{ $detail->nama_barang }} {!! $detail->jenis_barang ? '<br><small style="color:#64748b">' . $detail->jenis_barang . '</small>' : '' !!}</td>
                            <td style="text-align: center">{{ $detail->jumlah }}</td>
                            <td style="text-align: right">Rp {{ number_format($detail->harga_sewa, 0, ',', '.') }}</td>
                            <td style="text-align: right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Perhitungan -->
        <div class="total-section">
            <div class="total">
                <table>
                    <tr>
                        <td width="150">Subtotal</td>
                        <td width="10">:</td>
                        <td width="160">Rp {{ number_format($peminjaman->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @if ($peminjaman->diskon > 0)
                        <tr>
                            <td>Diskon</td>
                            <td>:</td>
                            <td>- Rp {{ number_format($peminjaman->diskon, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                    <tr style="background-color: #f0fdf4;">
                        <td><strong>Grand Total</strong> <br><small>(sebelum PPN)</small></td>
                        <td>:</td>
                        <td><strong>Rp {{ number_format($peminjaman->grand_total, 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr class="ppn-row">
                        <td>PPN 11%</td>
                        <td>:</td>
                        <td>Rp
                            {{ number_format($peminjaman->total_ppn ?? $peminjaman->grand_total * 0.11, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr style="background-color: #eff6ff;">
                        <td><strong>TOTAL TAGIHAN</strong> <br><small>(termasuk PPN)</small></td>
                        <td>:</td>
                        <td><strong class="grand-total">Rp
                                {{ number_format($peminjaman->grand_total_with_ppn ?? $peminjaman->grand_total * 1.11, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                    @if (($peminjaman->denda ?? 0) > 0)
                        <tr style="color: #dc2626;">
                            <td>Denda Keterlambatan</td>
                            <td>:</td>
                            <td>Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                    @if (($peminjaman->biaya_kerusakan ?? 0) > 0)
                        <tr style="color: #dc2626;">
                            <td>Biaya Kerusakan</td>
                            <td>:</td>
                            <td>Rp {{ number_format($peminjaman->biaya_kerusakan, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                    @if (($peminjaman->denda ?? 0) > 0 || ($peminjaman->biaya_kerusakan ?? 0) > 0)
                        <tr style="background-color: #fef2f2; font-weight: bold;">
                            <td>TOTAL AKHIR</td>
                            <td>:</td>
                            <td>Rp
                                {{ number_format(($peminjaman->grand_total_with_ppn ?? $peminjaman->grand_total * 1.11) + ($peminjaman->denda ?? 0) + ($peminjaman->biaya_kerusakan ?? 0), 0, ',', '.') }}
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        <!-- Terbilang -->
        <div class="terbilang">
            <strong>Terbilang:</strong>
            @php
                $totalTagihan = $peminjaman->grand_total_with_ppn ?? $peminjaman->grand_total * 1.11;
                $totalAkhir = $totalTagihan + ($peminjaman->denda ?? 0) + ($peminjaman->biaya_kerusakan ?? 0);
            @endphp
            {{ terbilang(round($totalAkhir)) }} Rupiah
        </div>

        <!-- Catatan / Keterangan -->
        @if ($peminjaman->keterangan)
            <div class="terbilang" style="background: #f0fdf4; border-left-color: #22c55e;">
                <strong>📝 Catatan:</strong> {{ $peminjaman->keterangan }}
            </div>
        @endif
        <!-- ==================== TANDA TANGAN ==================== -->
        <div class="ttd-section">
            <div class="ttd">
                <div>
                    <p>Jakarta, {{ formatTanggalIndonesia(now()) }}</p>
                    <div class="line"></div>
                    <p><strong>MULTIDAYA MITRA PERSADA</strong></p>
                </div>
                <div>
                    <p>Jakarta, {{ formatTanggalIndonesia(now()) }}</p>
                    <div class="line"></div>
                    <p><strong>{{ $peminjaman->nama_penyewa }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda menggunakan jasa kami</p>
            <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
            <p style="margin-top: 5px; font-size: 8px;">*Invoice ini adalah bukti transaksi yang sah</p>
        </div>
    </div>
</body>

</html>
@php
    function formatTanggalIndonesia($date)
    {
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $tanggal = date('d', strtotime($date));
        $bln = $bulan[(int) date('m', strtotime($date))];
        $tahun = date('Y', strtotime($date));
        return $tanggal . ' ' . $bln . ' ' . $tahun;
    }

    function terbilang($angka)
    {
        $angka = (float) $angka;
        $bilangan = [
            '',
            'Satu',
            'Dua',
            'Tiga',
            'Empat',
            'Lima',
            'Enam',
            'Tujuh',
            'Delapan',
            'Sembilan',
            'Sepuluh',
            'Sebelas',
        ];

        if ($angka < 12) {
            return $bilangan[$angka];
        } elseif ($angka < 20) {
            return $bilangan[$angka - 10] . ' Belas';
        } elseif ($angka < 100) {
            return $bilangan[floor($angka / 10)] . ' Puluh ' . $bilangan[$angka % 10];
        } elseif ($angka < 200) {
            return 'Seratus ' . terbilang($angka - 100);
        } elseif ($angka < 1000) {
            return $bilangan[floor($angka / 100)] . ' Ratus ' . terbilang($angka % 100);
        } elseif ($angka < 2000) {
            return 'Seribu ' . terbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            return terbilang(floor($angka / 1000)) . ' Ribu ' . terbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            return terbilang(floor($angka / 1000000)) . ' Juta ' . terbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            return terbilang(floor($angka / 1000000000)) . ' Milyar ' . terbilang($angka % 1000000000);
        }
        return 'Angka terlalu besar';
    }
@endphp
