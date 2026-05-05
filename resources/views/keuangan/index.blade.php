@extends('layouts.app')

@section('title', 'Keuangan - Multidaya Inti Persada')
@section('page-title', 'Laporan Keuangan')
@section('keuangan-active', 'bg-gray-100 text-gray-800 shadow-sm')

@section('main-content')
<div class="px-4 sm:px-6 lg:px-8 py-4 sm:py-6 max-w-7xl mx-auto">

    <!-- Header -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Laporan Keuangan</h1>
                <p class="text-slate-500 text-sm mt-1">Ringkasan pendapatan dari penyewaan dan biaya operasional</p>
            </div>
            <div class="flex gap-3 flex-wrap">
                <select id="bulanSelect" class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <option value="1" {{ $bulan == 1 ? 'selected' : '' }}>Januari</option>
                    <option value="2" {{ $bulan == 2 ? 'selected' : '' }}>Februari</option>
                    <option value="3" {{ $bulan == 3 ? 'selected' : '' }}>Maret</option>
                    <option value="4" {{ $bulan == 4 ? 'selected' : '' }}>April</option>
                    <option value="5" {{ $bulan == 5 ? 'selected' : '' }}>Mei</option>
                    <option value="6" {{ $bulan == 6 ? 'selected' : '' }}>Juni</option>
                    <option value="7" {{ $bulan == 7 ? 'selected' : '' }}>Juli</option>
                    <option value="8" {{ $bulan == 8 ? 'selected' : '' }}>Agustus</option>
                    <option value="9" {{ $bulan == 9 ? 'selected' : '' }}>September</option>
                    <option value="10" {{ $bulan == 10 ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ $bulan == 11 ? 'selected' : '' }}>November</option>
                    <option value="12" {{ $bulan == 12 ? 'selected' : '' }}>Desember</option>
                </select>
                <select id="tahunSelect" class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <option value="2023" {{ $tahun == 2023 ? 'selected' : '' }}>2023</option>
                    <option value="2024" {{ $tahun == 2024 ? 'selected' : '' }}>2024</option>
                    <option value="2025" {{ $tahun == 2025 ? 'selected' : '' }}>2025</option>
                    <option value="2026" {{ $tahun == 2026 ? 'selected' : '' }}>2026</option>
                </select>
                <!-- Action Button: Cetak Laporan (Blue Interactive Edition) -->
                <button onclick="cetakLaporan()"
                    class="group relative overflow-hidden bg-blue-600 hover:bg-blue-700 text-white text-[11px] font-black uppercase tracking-[0.15em] py-3 px-6 rounded-2xl transition-all duration-300 transform hover:-translate-y-1 active:scale-95 shadow-[0_4px_12px_rgba(37,99,235,0.3)] hover:shadow-[0_8px_20px_rgba(37,99,235,0.4)] flex items-center gap-3 justify-center">

                    <!-- Efek Cahaya (Glow Sweep) -->
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/25 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

                    <i class="fas fa-print text-xs group-hover:rotate-12 transition-transform duration-300"></i>
                    <span>Cetak Laporan</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards: Interactive Finance Edition -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Card Pendapatan -->
        <div onclick="filterByPendapatan()"
            class="group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
            <div class="flex items-start justify-between">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pendapatan Sewa</p>
                    </div>
                    <p class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </p>
                    <div class="flex items-center gap-1.5 {{ $pendapatanGrowth >= 0 ? 'text-emerald-600' : 'text-rose-600' }} font-bold text-xs">
                        <i class="fas {{ $pendapatanGrowth >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                        <span>{{ number_format(abs($pendapatanGrowth), 1) }}%</span>
                        <span class="text-slate-400 font-medium italic">vs bln lalu</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500 shadow-inner">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Card Total Biaya -->
        <div onclick="filterByBiaya()"
            class="group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-rose-500/10 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
            <div class="flex items-start justify-between">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pengeluaran</p>
                    </div>
                    <p class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight">
                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                    </p>
                    <div class="flex items-center gap-1.5 {{ $pengeluaranGrowth <= 0 ? 'text-emerald-600' : 'text-rose-600' }} font-bold text-xs">
                        <i class="fas {{ $pengeluaranGrowth >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                        <span>{{ number_format(abs($pengeluaranGrowth), 1) }}%</span>
                        <span class="text-slate-400 font-medium italic">vs bln lalu</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500 group-hover:bg-rose-500 group-hover:text-white transition-all duration-500 shadow-inner">
                    <i class="fas fa-receipt text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Card Laba Bersih -->
        <div onclick="filterByLaba()"
            class="group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
            <div class="flex items-start justify-between">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Laba Bersih</p>
                    </div>
                    <p class="text-2xl sm:text-3xl font-black text-blue-600 tracking-tight">
                        Rp {{ number_format($labaBersih, 0, ',', '.') }}
                    </p>
                    <div class="flex items-center gap-1.5 {{ $labaGrowth >= 0 ? 'text-emerald-600' : 'text-rose-600' }} font-bold text-xs">
                        <i class="fas {{ $labaGrowth >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                        <span>{{ number_format(abs($labaGrowth), 1) }}%</span>
                        <span class="text-slate-400 font-medium italic">vs bln lalu</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-all duration-500 shadow-inner">
                    <i class="fas fa-wallet text-2xl"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Chart & Recent Transactions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6">
            <h3 class="font-bold text-slate-800 mb-4">Grafik Keuangan {{ $tahun }}</h3>
            <canvas id="keuanganChart" height="200"></canvas>
            <div class="mt-4 flex justify-center gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    <span>Pendapatan</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <span>Pengeluaran</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span>Laba Bersih</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6">
            <h3 class="font-bold text-slate-800 mb-4">
                <i class="fas fa-history mr-2"></i>Transaksi Terbaru
            </h3>
            <div class="space-y-3 max-h-64 overflow-y-auto">
                @forelse($recentTransactions as $transaksi)
                <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full {{ $transaksi->jenis == 'pendapatan' ? 'bg-green-100' : 'bg-red-100' }} flex items-center justify-center">
                            <i class="fas {{ $transaksi->jenis == 'pendapatan' ? 'fa-arrow-down' : 'fa-arrow-up' }} {{ $transaksi->jenis == 'pendapatan' ? 'text-green-600' : 'text-red-600' }}"></i>
                        </div>
                        <div>
                            <p class="font-medium text-slate-800">{{ $transaksi->deskripsi }}</p>
                            <p class="text-xs text-slate-500">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }} •
                                {{ $transaksi->kategori }} •
                                <span class="capitalize">{{ $transaksi->sumber }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold {{ $transaksi->jenis == 'pendapatan' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaksi->jenis == 'pendapatan' ? '+' : '-' }} Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                @empty
                <p class="text-slate-500 text-center py-4">Belum ada transaksi</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Top Barang & Rincian Biaya: Modern & Balanced Edition -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

    <!-- Card Top Barang Terlaris -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center shadow-sm">
                <i class="fas fa-trophy text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-black text-slate-800 tracking-tight">Top Barang Terlaris</h3>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Produk Paling Sering Disewa</p>
            </div>
        </div>

        <div class="space-y-6">
            @forelse($topBarang as $index => $barang)
                @php
                    $maxTotal = $topBarang->max('total_sewa');
                    $percentage = ($maxTotal > 0) ? ($barang->total_sewa / $maxTotal) * 100 : 0;
                @endphp
                <div class="group">
                    <div class="flex justify-between items-end mb-2">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-6 h-6 rounded-lg bg-slate-50 text-slate-400 text-[10px] font-black group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                {{ $index + 1 }}
                            </span>
                            <span class="text-sm font-bold text-slate-700 group-hover:text-indigo-600 transition-colors">{{ $barang->nama_barang }}</span>
                        </div>
                        <span class="text-xs font-black text-slate-400 uppercase tracking-tighter">{{ $barang->total_sewa }}x <span class="font-bold text-[10px]">Sewa</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-500 to-blue-500 h-full rounded-full transition-all duration-1000 shadow-[0_0_8px_rgba(79,70,229,0.4)]"
                             style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-12 opacity-40">
                    <i class="fas fa-box-open text-4xl mb-3 text-slate-300"></i>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Belum ada data barang</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Card Rincian Biaya -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500">
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center shadow-sm">
                    <i class="fas fa-chart-pie text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight">Rincian Biaya</h3>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Alokasi Pengeluaran Kas</p>
                </div>
            </div>

            <!-- Button Tambah Biaya (Interactive Edition) -->
            <button onclick="openTambahBiayaModal()"
                class="group relative overflow-hidden bg-slate-800 hover:bg-rose-600 text-white text-[10px] font-black uppercase tracking-widest py-2.5 px-4 rounded-xl transition-all duration-300 transform hover:-translate-y-1 active:scale-95 shadow-lg shadow-slate-200 flex items-center gap-2">
                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                <i class="fas fa-plus-circle"></i>
                <span>Tambah</span>
            </button>
        </div>

        <div class="space-y-6">
            @php
                $kelompokBiaya = [
                    'operasional' => ['label' => 'Operasional', 'icon' => 'fa-building', 'color' => 'rose'],
                    'promosi' => ['label' => 'Promosi', 'icon' => 'fa-bullhorn', 'color' => 'violet'],
                    'inventaris' => ['label' => 'Inventaris', 'icon' => 'fa-boxes', 'color' => 'amber']
                ];
            @endphp

            @foreach($kelompokBiaya as $key => $info)
                @php
                    $total = $pengeluaranByKategori->where('sumber', $key)->sum('total');
                    $persen = $totalPengeluaran > 0 ? ($total / $totalPengeluaran) * 100 : 0;
                    $colorHex = [
                        'rose' => 'from-rose-500 to-pink-500',
                        'violet' => 'from-violet-500 to-purple-500',
                        'amber' => 'from-amber-500 to-orange-500'
                    ][$info['color']];
                @endphp
                <div class="group">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-{{ $info['color'] }}-50 text-{{ $info['color'] }}-500 flex items-center justify-center text-xs group-hover:bg-{{ $info['color'] }}-500 group-hover:text-white transition-all">
                                <i class="fas {{ $info['icon'] }}"></i>
                            </div>
                            <span class="text-sm font-bold text-slate-700">{{ $info['label'] }}</span>
                        </div>
                        <span class="text-sm font-black text-slate-800 tracking-tight">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-gradient-to-r {{ $colorHex }} h-full rounded-full transition-all duration-1000 shadow-sm"
                             style="width: {{ $persen }}%"></div>
                    </div>
                </div>
            @endforeach

            @if($totalPengeluaran > 0)
            <div class="mt-8 pt-6 border-t border-dashed border-slate-200">
                <div class="flex justify-between items-center p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Akumulasi</span>
                    <span class="text-lg font-black text-rose-600 tracking-tight">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Sidebar Form Tambah Biaya (Dinamis dari kanan) -->
<div id="modalSidebar" class="fixed inset-0 z-50 hidden">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50" onclick="closeTambahBiayaModal()"></div>

    <!-- Sidebar Content (slide from right) -->
    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-out" id="sidebarContent">
        <div class="h-full flex flex-col">
            <!-- Header -->
            <div class="flex justify-between items-center p-6 border-b border-slate-200 bg-gray-50">
                <h3 class="text-xl font-bold text-slate-800">
                    <i class="fas fa-plus-circle mr-2 text-gray-600"></i>Tambah Biaya
                </h3>
                <button onclick="closeTambahBiayaModal()" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Form -->
            <form id="formBiaya" class="flex-1 overflow-y-auto p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Jenis Biaya *</label>
                        <select name="sumber" id="sumber" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            <option value="operasional">Operasional</option>
                            <option value="promosi">Promosi</option>
                            
                            <option value="inventaris">Inventaris / Stok Barang</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Kategori *</label>
                        <input type="text" name="kategori" id="kategori" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent" placeholder="Contoh: Gaji, Listrik, Iklan, Beli Barang">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi *</label>
                        <input type="text" name="deskripsi" id="deskripsi" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent" placeholder="Keterangan detail">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Jumlah (Rp) *</label>
                        <input type="number" name="jumlah" id="jumlah" required min="0" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent" placeholder="0">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal *</label>
                        <input type="date" name="tanggal" id="tanggal" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent" value="{{ date('Y-m-d') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Referensi (Opsional)</label>
                        <input type="text" name="referensi" id="referensi" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent" placeholder="No. Invoice / Nota">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent" placeholder="Catatan tambahan..."></textarea>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 mt-6 pt-4 border-t border-slate-200">
                    <button type="submit" class="flex-1 bg-gray-700 hover:bg-gray-800 text-white font-semibold py-2.5 rounded-lg transition">
                        <i class="fas fa-save mr-1"></i>Simpan
                    </button>
                    <button type="button" onclick="closeTambahBiayaModal()" class="flex-1 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition py-2.5">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="fixed bottom-4 right-4 bg-white rounded-lg shadow-lg p-4 hidden z-50">
    <div class="flex items-center gap-3">
        <i id="toastIcon" class="text-xl"></i>
        <p id="toastMessage"></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data dari server
const monthlyDataRaw = @json($monthlyData);
const bulanLabels = monthlyDataRaw.map(item => item.bulan);
const pendapatanData = monthlyDataRaw.map(item => item.pendapatan);
const pengeluaranData = monthlyDataRaw.map(item => item.pengeluaran);
const labaData = pendapatanData.map((p, i) => p - pengeluaranData[i]);

// Chart initialization
const ctx = document.getElementById('keuanganChart').getContext('2d');
const keuanganChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: bulanLabels,
        datasets: [
            {
                label: 'Pendapatan',
                data: pendapatanData,
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            },
            {
                label: 'Pengeluaran',
                data: pengeluaranData,
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            },
            {
                label: 'Laba Bersih',
                data: labaData,
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6,
                borderDash: [5, 5]
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        interaction: { mode: 'index', intersect: false },
        plugins: {
            legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 10 } },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';
                        let value = context.raw;
                        return label + ': Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { callback: function(value) { return 'Rp ' + value.toLocaleString('id-ID'); } }
            }
        }
    }
});

// Filter handlers
document.getElementById('bulanSelect').addEventListener('change', function() {
    window.location.href = `?bulan=${this.value}&tahun=${document.getElementById('tahunSelect').value}`;
});
document.getElementById('tahunSelect').addEventListener('change', function() {
    window.location.href = `?bulan=${document.getElementById('bulanSelect').value}&tahun=${this.value}`;
});

// Filter functions
function filterByPendapatan() {
    window.location.href = `/keuangan/pendapatan?bulan=${document.getElementById('bulanSelect').value}&tahun=${document.getElementById('tahunSelect').value}`;
}

function filterByBiaya() {
    window.location.href = `/keuangan/pengeluaran?bulan=${document.getElementById('bulanSelect').value}&tahun=${document.getElementById('tahunSelect').value}`;
}

function filterByLaba() {
    window.location.href = `/keuangan/laba?bulan=${document.getElementById('bulanSelect').value}&tahun=${document.getElementById('tahunSelect').value}`;
}

// Modal Sidebar functions
function openTambahBiayaModal() {
    const modal = document.getElementById('modalSidebar');
    const sidebar = document.getElementById('sidebarContent');
    modal.classList.remove('hidden');
    setTimeout(() => {
        sidebar.classList.remove('translate-x-full');
        sidebar.classList.add('translate-x-0');
    }, 10);
}

function closeTambahBiayaModal() {
    const modal = document.getElementById('modalSidebar');
    const sidebar = document.getElementById('sidebarContent');
    sidebar.classList.remove('translate-x-0');
    sidebar.classList.add('translate-x-full');
    setTimeout(() => {
        modal.classList.add('hidden');
        document.getElementById('formBiaya').reset();
    }, 300);
}

// Form submission
document.getElementById('formBiaya').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch('/keuangan', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const result = await response.json();
        if (result.success) {
            showToast(result.message, 'success');
            closeTambahBiayaModal();
            setTimeout(() => location.reload(), 500);
        } else {
            showToast(result.message, 'error');
        }
    } catch (error) {
        showToast('Gagal menyimpan data', 'error');
    }
});

function cetakLaporan() {
    const bulan = document.getElementById('bulanSelect').value;
    const tahun = document.getElementById('tahunSelect').value;

    window.open(`/keuangan/cetak?bulan=${bulan}&tahun=${tahun}`, '_blank');
}

function showToast(message, type) {
    const toast = document.getElementById('toast');
    const icon = document.getElementById('toastIcon');
    const msg = document.getElementById('toastMessage');
    icon.className = type === 'success' ? 'fas fa-check-circle text-green-500 text-xl' : 'fas fa-exclamation-circle text-red-500 text-xl';
    msg.textContent = message;
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3000);
}
</script>

<style>
@media print {
    .no-print, button, select, .flex-1, #modalSidebar { display: none !important; }
    body { background: white; padding: 0; margin: 0; }
    .bg-gradient-to-br { background: #f3f4f6 !important; color: black !important; }
    .shadow-lg, .shadow-md { box-shadow: none !important; }
}

/* Smooth transition untuk sidebar */
#modalSidebar {
    transition: all 0.3s ease;
}
</style>
@endsection
