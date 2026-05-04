@extends('layouts.app')

@section('title', 'Peminjaman - Multidaya Inti Persada')
@section('page-title', 'Data Peminjaman')
@section('peminjaman-active', 'bg-gray-100 text-gray-800 shadow-sm')

@section('main-content')
    <div class="px-4 sm:px-6 lg:px-8 py-4 sm:py-6 max-w-7xl mx-auto">

        <!-- Header Section -->
        <div class="mb-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <!-- Text Content -->
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight flex items-center gap-2">
                        Peminjaman
                    </h1>
                    <p class="text-slate-500 text-[11px] mt-1 ml-1">
                        Kelola data transaksi barang secara real-time.
                    </p>
                </div>

                <!-- Action Button: Interactive Edition -->
                <button onclick="openTambahModal()"
                    class="group relative overflow-hidden bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2.5 px-5 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95 shadow-[0_4px_12px_rgba(79,70,229,0.3)] hover:shadow-[0_8px_20px_rgba(79,70,229,0.4)] flex items-center gap-2 justify-center">

                    <!-- Efek Cahaya (Glow Effect on Hover) -->
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>

                    <i class="fas fa-plus-circle text-xs group-hover:rotate-90 transition-transform duration-300"></i>
                    <span>Tambah Data</span>
                </button>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="mb-6">
    <!-- Container abu-abu sebagai dasar -->
    <div class="inline-flex p-1 bg-slate-100 rounded-xl">

        <button onclick="switchTab('aktif')" id="tabAktifBtn"
            class="flex items-center gap-2 py-2 px-6 rounded-lg font-bold text-sm transition-all duration-300 bg-white text-indigo-600 shadow-sm border border-slate-200/50">
            <i class="fas fa-clock text-xs"></i>
            <span>Sewa Aktif</span>
            <span id="badgeAktif" class="bg-indigo-100 text-indigo-600 text-[10px] px-1.5 py-0.5 rounded-md">0</span>
        </button>

        <button onclick="switchTab('riwayat')" id="tabRiwayatBtn"
            class="flex items-center gap-2 py-2 px-6 rounded-lg font-bold text-sm transition-all duration-300 text-slate-500 hover:text-slate-700">
            <i class="fas fa-history text-xs"></i>
            <span>Riwayat Sewa</span>
            <span id="badgeRiwayat" class="bg-slate-200 text-slate-500 text-[10px] px-1.5 py-0.5 rounded-md">0</span>
        </button>

    </div>
</div>

       <!-- Filter Section Modern -->
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-5 sm:p-6 mb-8 transition-all hover:shadow-md">
    <div class="flex flex-col md:flex-row items-end gap-5">

        <!-- Search Input -->
        <div class="flex-1 w-full">
            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">
                Pencarian Data
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                </div>
                <input type="text" id="searchInput"
                    placeholder="Cari invoice, nama penyewa, atau telepon..."
                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium text-slate-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all placeholder:text-slate-400">
            </div>
        </div>

        <!-- Sort Select -->
        <div class="w-full md:w-64">
            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">
                Urutan Tampilan
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-sort-amount-down text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                </div>
                <select id="filterSort"
                    class="w-full pl-11 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all appearance-none cursor-pointer">
                    <option value="default">Terbaru (Default)</option>
                    <option value="name_asc">Nama A-Z</option>
                    <option value="name_desc">Nama Z-A</option>
                    <option value="date_asc">Tanggal Terlama</option>
                    <option value="date_desc">Tanggal Terbaru</option>
                </select>
                <!-- Custom Arrow Icon -->
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <i class="fas fa-chevron-down text-[10px] text-slate-400 group-focus-within:text-indigo-500"></i>
                </div>
            </div>
        </div>

    </div>
</div>

        {{-- <!-- Loading -->
        <div id="loadingIndicator" class="hidden fixed inset-0 bg-black/50 z-50 items-center justify-center">
            <div class="bg-white rounded-lg p-6 flex items-center gap-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-gray-700"></div>
                <span>Memuat data...</span>
            </div>
        </div> --}}

        <!-- Table List Peminjaman Modern -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden transition-all hover:shadow-md">
            <div class="overflow-x-auto text-slate-700">
                <table class="min-w-full w-full text-sm border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-6 py-4 text-left text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">ID/Invoice</th>
                            <th class="px-6 py-4 text-left text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Penyewa</th>
                            <th class="px-6 py-4 text-left text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Barang</th>
                            <th class="px-6 py-4 text-center text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Periode Sewa</th>
                            <th class="px-6 py-4 text-right text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Total Tagihan</th>
                            <th class="px-6 py-4 text-center text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Status</th>
                            <th class="px-6 py-4 text-center text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="peminjamanTableBody" class="divide-y divide-slate-50">
                        <!-- Loading State yang lebih modern -->
                        <tr>
                            <td colspan="7" class="px-6 py-24 text-center">
                                <div class="inline-flex flex-col items-center">
                                    <div class="relative flex items-center justify-center w-12 h-12 mb-4">
                                        <div class="absolute w-full h-full border-4 border-indigo-100 rounded-full"></div>
                                        <div class="absolute w-full h-full border-4 border-indigo-600 rounded-full border-t-transparent animate-spin"></div>
                                    </div>
                                    <h3 class="text-slate-800 font-bold">Sedang Mengambil Data</h3>
                                    <p class="text-slate-400 text-xs mt-1">Harap tunggu sebentar...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Container -->
        <div id="paginationContainer" class="px-6 py-5 bg-slate-50/30 border-t border-slate-100">
            <!-- Konten pagination diisi via JS -->
        </div>
    </div>

    <!-- Modal Tambah Peminjaman -->
<div id="modalTambah" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-all duration-300"
    onclick="if(event.target===this) closeTambahModal()">

    <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[92vh] flex flex-col overflow-hidden animate-in fade-in zoom-in duration-200">
        <!-- Header -->
        <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0 z-10">
            <div>
                <h3 class="text-xl font-extrabold text-slate-800 flex items-center gap-2">
                    <span class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    Tambah Peminjaman Baru
                </h3>
                <p class="text-[11px] text-slate-400 font-medium uppercase tracking-wider mt-1">Input data penyewaan barang</p>
            </div>
            <button onclick="closeTambahModal()" class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-rose-50 hover:text-rose-500 transition-all">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="overflow-y-auto custom-scrollbar">
            <!-- Quick Action: Cek Pelanggan -->
            <div class="px-8 pt-6">
                <button onclick="openCekPelangganModal()" type="button"
                    class="group w-full border-2 border-dashed border-slate-200 bg-slate-50 hover:bg-indigo-50 hover:border-indigo-300 text-slate-500 hover:text-indigo-600 py-3.5 rounded-2xl transition-all flex items-center justify-center gap-3">
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                    <span class="text-sm font-bold">Cari Data Pelanggan Lama</span>
                </button>
                <div class="relative flex py-4 items-center">
                    <div class="flex-grow border-t border-slate-100"></div>
                    <span class="flex-shrink mx-4 text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Atau Input Manual</span>
                    <div class="flex-grow border-t border-slate-100"></div>
                </div>
            </div>

            <form id="formPeminjaman" class="px-8 pb-8">
                @csrf
                <input type="hidden" id="pelanggan_id" name="pelanggan_id">

                <!-- Section 1: Data Penyewa -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-5 text-indigo-600">
                        <i class="fas fa-user-circle"></i>
                        <span class="text-xs font-black uppercase tracking-widest">Informasi Penyewa</span>
                        <div class="h-[1px] flex-1 bg-slate-100"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Kode Peminjaman</label>
                            <input type="text" id="kode_peminjaman" class="w-full px-4 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-sm font-mono font-bold text-slate-500 cursor-not-allowed" readonly placeholder="Auto generate">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Tipe Pelanggan</label>
                            <select name="tipe_pelanggan" id="tipe_pelanggan" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-semibold">
                                <option value="perorangan">Perorangan</option>
                                <option value="perusahaan">Perusahaan</option>
                            </select>
                        </div>
                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Nama Penyewa <span class="text-rose-500">*</span></label>
                            <input type="text" name="nama_penyewa" id="nama_penyewa" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-semibold">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">No Telepon <span class="text-rose-500">*</span></label>
                            <input type="text" name="no_telepon" id="no_telepon" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-semibold">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Email (Opsional)</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-semibold">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-semibold"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Waktu & Acara -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-5 text-indigo-600">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="text-xs font-black uppercase tracking-widest">Detail Waktu & Acara</span>
                        <div class="h-[1px] flex-1 bg-slate-100"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="bg-indigo-50/50 p-4 rounded-2xl border border-indigo-100/50 grid grid-cols-2 gap-3">
                            <div class="col-span-2 text-[10px] font-black text-indigo-400 uppercase mb-1">Jadwal Pengambilan</div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 mb-1 uppercase">Tanggal</label>
                                <input type="date" name="tanggal_sewa" id="tanggal_sewa" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm font-bold focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 mb-1 uppercase">Jam</label>
                                <input type="time" name="waktu_sewa" id="waktu_sewa" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm font-bold focus:border-indigo-500">
                            </div>
                        </div>
                        <div class="bg-rose-50/50 p-4 rounded-2xl border border-rose-100/50 grid grid-cols-2 gap-3">
                            <div class="col-span-2 text-[10px] font-black text-rose-400 uppercase mb-1">Jadwal Pengembalian</div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 mb-1 uppercase">Tanggal</label>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm font-bold focus:border-rose-500">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 mb-1 uppercase">Jam</label>
                                <input type="time" name="waktu_kembali" id="waktu_kembali" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm font-bold focus:border-rose-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Nama Acara</label>
                            <input type="text" name="nama_acara" id="nama_acara" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-semibold" placeholder="Contoh: Wedding, Seminar...">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Lokasi Acara</label>
                            <input type="text" name="lokasi_acara" id="lokasi_acara" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-semibold" placeholder="Nama Gedung / Tempat">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Pilihan Barang -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-5 text-indigo-600">
                        <i class="fas fa-box-open"></i>
                        <span class="text-xs font-black uppercase tracking-widest">Daftar Barang Sewa</span>
                        <div class="h-[1px] flex-1 bg-slate-100"></div>
                    </div>

                    <div id="barangContainer" class="space-y-3 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                        <!-- Row Barang -->
                        <div class="flex gap-3 items-center barang-row animate-in slide-in-from-left-2 duration-200">
                            <div class="flex-1 relative group">
                                <select name="barang[0][id]" class="barang-select w-full pl-4 pr-10 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all appearance-none cursor-pointer">
                                    <option value="">Pilih Barang...</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                    <i class="fas fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                            <div class="w-28 relative">
                                <input type="number" name="barang[0][jumlah]" placeholder="Jml"
                                    class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all" value="1">
                                <span class="absolute -top-2 left-3 px-1 bg-white text-[9px] font-black text-slate-400 uppercase">Qty</span>
                            </div>
                            <button type="button" onclick="removeBarang(this)"
                                class="w-10 h-10 flex items-center justify-center text-rose-500 hover:bg-rose-50 rounded-xl transition-all">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <button type="button" onclick="addBarang()"
                        class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-xl text-xs font-black transition-all active:scale-95 shadow-sm shadow-indigo-100">
                        <i class="fas fa-plus"></i> TAMBAH BARANG LAIN
                    </button>
                </div>

                <!-- Section 4: Pembayaran & Keterangan -->
                <div class="mb-4 bg-slate-900 rounded-3xl p-6 text-white shadow-xl">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-2 ml-1">Potongan Diskon (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold text-sm">Rp</span>
                                <input type="number" name="diskon" id="diskon" value="0" class="w-full pl-12 pr-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-sm font-bold text-white focus:border-indigo-500 focus:ring-0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-2 ml-1">Status Pembayaran</label>
                            <select name="status_pembayaran" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-sm font-bold text-white focus:border-indigo-500 focus:ring-0">
                                <option value="belum_bayar">Belum Bayar</option>
                                <option value="dp">Down Payment (DP)</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-400 mb-2 ml-1">Keterangan Tambahan</label>
                            <textarea name="keterangan" rows="2" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-sm font-medium text-white focus:border-indigo-500 focus:ring-0" placeholder="Catatan khusus peminjaman..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 mt-8">
                    <button type="submit" class="flex-[2] bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-indigo-200 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2">
                        <i class="fas fa-check-circle"></i> SIMPAN TRANSAKSI
                    </button>
                    <button type="button" onclick="closeTambahModal()"
                        class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-4 rounded-2xl transition-all flex items-center justify-center">
                        BATAL
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Modal Edit Peminjaman -->
<div id="modalEdit" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-all duration-300"
    onclick="if(event.target===this) closeEditModal()">

    <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[92vh] flex flex-col overflow-hidden animate-in fade-in zoom-in duration-200">
        <!-- Header: Warna Aksen Amber untuk membedakan dengan Modal Tambah -->
        <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0 z-10">
            <div>
                <h3 class="text-xl font-extrabold text-slate-800 flex items-center gap-2">
                    <span class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                        <i class="fas fa-edit"></i>
                    </span>
                    Edit Data Peminjaman
                </h3>
                <p class="text-[11px] text-slate-400 font-medium uppercase tracking-wider mt-1">Perbarui informasi transaksi pelanggan</p>
            </div>
            <button onclick="closeEditModal()" class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-rose-50 hover:text-rose-500 transition-all">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="overflow-y-auto custom-scrollbar">
            <form id="formEditPeminjaman" class="px-8 py-8">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <!-- Section 1: Identitas & Penyewa -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-5 text-amber-600">
                        <i class="fas fa-id-card"></i>
                        <span class="text-xs font-black uppercase tracking-widest">Identitas & Penyewa</span>
                        <div class="h-[1px] flex-1 bg-slate-100"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Nomor Invoice (Read Only)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-amber-600">
                                    <i class="fas fa-hashtag text-xs"></i>
                                </span>
                                <input type="text" id="edit_invoice_number" class="w-full pl-10 pr-4 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-sm font-mono font-bold text-slate-600 cursor-not-allowed" readonly>
                            </div>
                        </div>
                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Nama Penyewa <span class="text-rose-500">*</span></label>
                            <input type="text" name="nama_penyewa" id="edit_nama_penyewa" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all font-semibold outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">No Telepon <span class="text-rose-500">*</span></label>
                            <input type="text" name="no_telepon" id="edit_no_telepon" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all font-semibold outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Nama Acara</label>
                            <input type="text" name="nama_acara" id="edit_nama_acara" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all font-semibold outline-none">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 mb-2 ml-1">Lokasi Acara</label>
                            <input type="text" name="lokasi_acara" id="edit_lokasi_acara" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all font-semibold outline-none">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Jadwal Pelaksanaan -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-5 text-amber-600">
                        <i class="fas fa-clock"></i>
                        <span class="text-xs font-black uppercase tracking-widest">Penjadwalan Ulang</span>
                        <div class="h-[1px] flex-1 bg-slate-100"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="bg-indigo-50/50 p-4 rounded-2xl border border-indigo-100/50 grid grid-cols-2 gap-3">
                            <div class="col-span-2 text-[10px] font-black text-indigo-400 uppercase mb-1 flex items-center gap-1">
                                <i class="fas fa-sign-out-alt"></i> Pengambilan
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 mb-1 uppercase tracking-tighter">Tanggal</label>
                                <input type="date" name="tanggal_sewa" id="edit_tanggal_sewa" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm font-bold focus:border-indigo-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 mb-1 uppercase tracking-tighter">Jam</label>
                                <input type="time" name="waktu_sewa" id="edit_waktu_sewa" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm font-bold focus:border-indigo-500 outline-none">
                            </div>
                        </div>
                        <div class="bg-rose-50/50 p-4 rounded-2xl border border-rose-100/50 grid grid-cols-2 gap-3">
                            <div class="col-span-2 text-[10px] font-black text-rose-400 uppercase mb-1 flex items-center gap-1">
                                <i class="fas fa-sign-in-alt"></i> Pengembalian
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 mb-1 uppercase tracking-tighter">Tanggal</label>
                                <input type="date" name="tanggal_kembali" id="edit_tanggal_kembali" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm font-bold focus:border-rose-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 mb-1 uppercase tracking-tighter">Jam</label>
                                <input type="time" name="waktu_kembali" id="edit_waktu_kembali" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm font-bold focus:border-rose-500 outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Daftar Barang (Dinamis) -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-5 text-amber-600">
                        <i class="fas fa-boxes"></i>
                        <span class="text-xs font-black uppercase tracking-widest">Detail Barang Sewa</span>
                        <div class="h-[1px] flex-1 bg-slate-100"></div>
                    </div>

                    <div id="editBarangContainer" class="space-y-3 bg-slate-50/50 p-4 rounded-2xl border border-slate-100 min-h-[50px]">
                        <!-- Baris barang akan di-inject ke sini oleh JS -->
                    </div>

                    <button type="button" onclick="addEditBarang()"
                        class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white rounded-xl text-xs font-black transition-all active:scale-95 shadow-sm shadow-amber-100">
                        <i class="fas fa-plus"></i> TAMBAH BARANG LAIN
                    </button>
                </div>

                <!-- Section 4: Finansial & Catatan -->
                <div class="mb-4 bg-slate-900 rounded-3xl p-6 text-white shadow-xl shadow-slate-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-2 ml-1 uppercase tracking-widest">Penyesuaian Diskon</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold text-sm">Rp</span>
                                <input type="number" name="diskon" id="edit_diskon" value="0" class="w-full pl-12 pr-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-sm font-bold text-white focus:border-amber-500 focus:ring-0 outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-2 ml-1 uppercase tracking-widest">Update Pembayaran</label>
                            <select name="status_pembayaran" id="edit_status_pembayaran" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-sm font-bold text-white focus:border-amber-500 focus:ring-0 outline-none cursor-pointer">
                                <option value="belum_bayar">Belum Bayar</option>
                                <option value="dp">Down Payment (DP)</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-400 mb-2 ml-1 uppercase tracking-widest">Catatan Internal / Keterangan</label>
                            <textarea name="keterangan" id="edit_keterangan" rows="2" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-sm font-medium text-white focus:border-amber-500 focus:ring-0 outline-none" placeholder="Masukkan catatan tambahan..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 mt-8">
                    <button type="submit" class="flex-[2] bg-amber-500 hover:bg-amber-600 text-white font-black py-4 rounded-2xl shadow-lg shadow-amber-200 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2 uppercase tracking-wider">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <button type="button" onclick="closeEditModal()"
                        class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-4 rounded-2xl transition-all flex items-center justify-center uppercase tracking-wider text-xs">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Modal Cek Pelanggan -->
    <!-- Modal Cek Pelanggan -->
<div id="modalCekPelanggan" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-all duration-300"
    onclick="if(event.target===this) closeCekPelangganModal()">

    <div class="bg-white rounded-[2rem] shadow-2xl max-w-2xl w-full max-h-[85vh] overflow-hidden flex flex-col animate-in fade-in zoom-in duration-200">
        <!-- Header -->
        <div class="sticky top-0 bg-white border-b border-slate-100 px-8 py-6 flex justify-between items-center z-10">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight flex items-center gap-3">
                    <span class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-search text-lg"></i>
                    </span>
                    Cek Database Pelanggan
                </h3>
                <p class="text-xs text-slate-400 font-medium mt-1 uppercase tracking-widest ml-13">Verifikasi data penyewa lama</p>
            </div>
            <button onclick="closeCekPelangganModal()" class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-rose-50 hover:text-rose-500 transition-all">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-8 overflow-y-auto custom-scrollbar">
            <!-- Search Input Section -->
            <div class="mb-8">
                <label class="block text-xs font-black text-slate-500 mb-3 ml-1 uppercase tracking-wider">Parameter Pencarian</label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" id="searchPelanggan" placeholder="Masukkan Nama atau No. WhatsApp..."
                        class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 font-semibold focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all outline-none"
                        autocomplete="off">

                    <!-- Autocomplete Dropdown -->
                    <div id="autocompleteDropdown"
                        class="hidden absolute z-20 w-full mt-2 bg-white border border-slate-100 rounded-2xl shadow-xl max-h-64 overflow-y-auto custom-scrollbar divide-y divide-slate-50">
                    </div>
                </div>
                <p class="mt-2 text-[10px] text-slate-400 ml-2 font-medium italic">*Sistem akan mencari kecocokan data secara otomatis saat Anda mengetik.</p>
            </div>

            <!-- Hasil Pencarian Card -->
            <div id="hasilCekPelanggan" class="hidden animate-in slide-in-from-bottom-4 duration-300">
                <div class="bg-gradient-to-br from-white to-slate-50 border border-slate-200 rounded-[1.5rem] p-6 shadow-sm">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex gap-4 items-center">
                            <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-xl font-bold shadow-lg shadow-indigo-200">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-slate-800 text-xl leading-none mb-1" id="hasilNama"></h4>
                                <div class="flex items-center gap-3">
                                    <span class="text-sm text-slate-500 font-medium flex items-center gap-1">
                                        <i class="fab fa-whatsapp"></i> <span id="hasilTelepon"></span>
                                    </span>
                                    <span class="text-slate-300">•</span>
                                    <span class="text-sm text-slate-500 font-medium" id="hasilEmail"></span>
                                </div>
                            </div>
                        </div>
                        <span id="hasilStatus" class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-tighter"></span>
                    </div>

                    <!-- Statistik Singkat -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-white border border-slate-100 p-4 rounded-2xl">
                            <span class="block text-[10px] font-black text-slate-400 uppercase mb-1">Total Transaksi</span>
                            <strong class="text-xl text-slate-800" id="hasilTotalTransaksi">0</strong>
                            <span class="text-[10px] text-slate-400 font-bold ml-1">KALI</span>
                        </div>
                        <div class="bg-white border border-slate-100 p-4 rounded-2xl">
                            <span class="block text-[10px] font-black text-slate-400 uppercase mb-1">Total Nilai</span>
                            <strong class="text-xl text-indigo-600" id="hasilTotalNilai">Rp 0</strong>
                        </div>
                    </div>

                    <!-- Riwayat Section -->
                    <div id="riwayatContainer" class="space-y-3">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="h-[1px] flex-1 bg-slate-100"></div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Riwayat Terakhir</p>
                            <div class="h-[1px] flex-1 bg-slate-100"></div>
                        </div>
                        <div id="riwayatList" class="space-y-2 max-h-44 overflow-y-auto pr-2 custom-scrollbar"></div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex gap-3">
                        <button onclick="useExistingCustomer()"
                            class="group flex-[2] bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl transition-all shadow-lg shadow-indigo-100 flex items-center justify-center gap-2 active:scale-95">
                            <i class="fas fa-check-circle group-hover:scale-110 transition-transform"></i>
                            GUNAKAN DATA PELANGGAN
                        </button>
                        <button onclick="openNewCustomerForm()"
                            class="flex-1 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 font-black py-4 rounded-2xl transition-all flex items-center justify-center gap-2 text-xs active:scale-95">
                            <i class="fas fa-plus text-[10px]"></i> BARU
                        </button>
                    </div>
                </div>
            </div>

            <!-- Not Found State -->
            <div id="pelangganNotFound" class="hidden py-12 text-center animate-in fade-in duration-500">
                <div class="relative inline-block mb-6">
                    <div class="w-24 h-24 bg-slate-50 rounded-[2.5rem] flex items-center justify-center mx-auto">
                        <i class="fas fa-user-slash text-4xl text-slate-200"></i>
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-white border-4 border-white rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-question text-[10px] text-slate-400"></i>
                    </div>
                </div>
                <h4 class="text-xl font-black text-slate-800 mb-2 tracking-tight">Pelanggan Tidak Ditemukan</h4>
                <p class="text-slate-400 text-sm mb-8 max-w-[280px] mx-auto font-medium leading-relaxed">
                    Data tidak ada dalam database kami. Silakan periksa kembali atau daftar sebagai pelanggan baru.
                </p>

                <div id="suggestionsContainer" class="mb-6 flex flex-wrap justify-center gap-2"></div>

                <button onclick="openNewCustomerForm()"
                    class="inline-flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-black text-sm transition-all shadow-xl shadow-indigo-100 active:scale-95">
                    <i class="fas fa-user-plus"></i> DAFTARKAN PELANGGAN BARU
                </button>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Detail -->
<div id="modalDetail" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-all duration-300"
    onclick="if(event.target===this) closeDetailModal()">

    <div class="bg-white rounded-[2rem] shadow-2xl max-w-3xl w-full max-h-[85vh] overflow-hidden flex flex-col animate-in fade-in zoom-in duration-200">
        <!-- Header: Clean & Structured -->
        <div class="sticky top-0 bg-white/80 backdrop-blur-md border-b border-slate-100 px-8 py-5 flex justify-between items-center z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-invoice text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight">Detail Peminjaman</h3>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Informasi lengkap transaksi</p>
                </div>
            </div>

            <button onclick="closeDetailModal()"
                class="w-10 h-10 flex items-center justify-center rounded-2xl text-slate-400 hover:bg-rose-50 hover:text-rose-500 transition-all active:scale-90">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Content Area -->
        <div id="detailContent" class="p-8 overflow-y-auto custom-scrollbar bg-slate-50/30">
            <!-- Isi detailContent akan di-inject lewat JavaScript -->
            <!-- Pastikan data yang di-inject menggunakan utility class Tailwind agar serasi -->
        </div>

        <!-- Footer: Optional Action (Biasanya bagus untuk tombol cetak/tutup) -->
        <div class="p-6 border-t border-slate-100 bg-white flex justify-end gap-3">
            <button onclick="closeDetailModal()"
                class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl text-sm transition-all active:scale-95">
                Tutup Window
            </button>
        </div>
    </div>
</div>

    <!-- Modal Form Pengembalian -->
<div id="modalPengembalian" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-all duration-300"
    onclick="if(event.target===this) closePengembalianModal()">

    <div class="bg-white rounded-[2rem] shadow-2xl max-w-lg w-full max-h-[92vh] flex flex-col overflow-hidden animate-in fade-in zoom-in duration-200">
        <!-- Header -->
        <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0 z-10">
            <div>
                <h3 class="text-xl font-extrabold text-slate-800 flex items-center gap-2">
                    <span class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                        <i class="fas fa-undo-alt"></i>
                    </span>
                    Proses Pengembalian
                </h3>
                <p class="text-[11px] text-slate-400 font-medium uppercase tracking-wider mt-1">Verifikasi kondisi barang kembali</p>
            </div>
            <button onclick="closePengembalianModal()" class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-rose-50 hover:text-rose-500 transition-all">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="overflow-y-auto custom-scrollbar">
            <form id="formPengembalian" class="p-8" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="pengembalianId" name="id">

                <!-- Upload Section -->
                <div class="mb-6">
                    <label class="block text-xs font-black text-slate-500 mb-3 ml-1 uppercase tracking-widest">Bukti Foto Barang</label>
                    <div class="relative group">
                        <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center cursor-pointer group-hover:border-emerald-400 group-hover:bg-emerald-50/30 transition-all duration-300"
                            id="dropzonePengembalian">
                            <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-camera text-xl text-slate-400 group-hover:text-emerald-500"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-600">Klik atau Drag Foto</p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase font-semibold">Format: JPG, PNG (Maks 2MB)</p>
                            <input type="file" name="foto_pengembalian" id="fotoPengembalian" accept="image/*" class="hidden">
                        </div>
                    </div>

                    <!-- Image Preview -->
                    <div id="previewPengembalian" class="hidden mt-4 animate-in fade-in slide-in-from-top-2">
                        <div class="relative inline-block w-full">
                            <img id="previewImgPengembalian" class="w-full h-40 object-cover rounded-2xl border-4 border-white shadow-md">
                            <div class="absolute top-2 right-2 px-3 py-1 bg-emerald-500 text-white text-[10px] font-black rounded-lg uppercase">Preview</div>
                        </div>
                    </div>
                </div>

                <!-- Kondisi Section -->
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-black text-slate-500 mb-2 ml-1 uppercase tracking-widest">Kondisi Fisik Barang</label>
                        <div class="relative">
                            <select name="kondisi_barang" id="kondisiBarang"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all appearance-none cursor-pointer"
                                onchange="toggleKerusakan()">
                                <option value="baik">Baik, Tidak ada masalah</option>
                                <option value="kurang_baik">Kurang Baik, Ada sedikit masalah</option>
                                <option value="rusak">Rusak, Perlu perbaikan</option>
                            </select>
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Section: Kerusakan (Akan muncul via JS toggleKerusakan) -->
                    <div id="kerusakanSection" class="hidden animate-in slide-in-from-top-2 duration-300">
                        <label class="block text-xs font-black text-rose-500 mb-2 ml-1 uppercase tracking-widest">Detail Kerusakan</label>
                        <textarea name="kerusakan" id="kerusakan" rows="2"
                            class="w-full px-4 py-3 bg-rose-50/30 border border-rose-100 rounded-xl text-sm font-medium focus:ring-4 focus:ring-rose-500/10 focus:border-rose-400 transition-all outline-none"
                            placeholder="Jelaskan bagian mana yang rusak..."></textarea>
                    </div>

                    <!-- Hidden Section: Denda -->
                    <div id="dendaSection" class="hidden animate-in slide-in-from-top-2 duration-300">
                        <label class="block text-xs font-black text-rose-500 mb-2 ml-1 uppercase tracking-widest">Biaya Denda / Perbaikan</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-rose-500 font-bold text-sm">Rp</span>
                            <input type="number" name="biaya_kerusakan" id="biayaKerusakan"
                                class="w-full pl-12 pr-4 py-3 bg-rose-50/30 border border-rose-100 rounded-xl text-sm font-black text-rose-600 focus:ring-0 outline-none"
                                placeholder="0">
                        </div>
                        <div class="flex items-center gap-2 mt-2 ml-1">
                            <i class="fas fa-info-circle text-[10px] text-slate-400"></i>
                            <p class="text-[10px] text-slate-500 font-bold italic">Denda keterlambatan sistem: Rp 50.000/hari</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-500 mb-2 ml-1 uppercase tracking-widest">Catatan Tambahan</label>
                        <textarea name="catatan_pengembalian" id="catatanPengembalian" rows="2"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none"
                            placeholder="Catatan opsional..."></textarea>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 mt-10">
                    <button type="submit"
                        class="flex-[2] bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-emerald-200 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2 uppercase tracking-wider">
                         Konfirmasi Selesai
                    </button>
                    <button type="button" onclick="closePengembalianModal()"
                        class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-4 rounded-2xl transition-all flex items-center justify-center uppercase tracking-wider text-xs">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalDeleteConfirm" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>

    <div class="relative bg-white w-full max-w-sm rounded-[2rem] shadow-2xl overflow-hidden transform transition-all animate-in fade-in zoom-in duration-200">
        <div class="p-8 text-center">
            <div class="w-20 h-20 bg-rose-50 text-rose-500 rounded-3xl flex items-center justify-center mx-auto mb-6 transform rotate-3">
                <i class="fas fa-trash-alt text-3xl"></i>
            </div>

            <h3 class="text-2xl font-black text-slate-800 tracking-tight mb-2">Hapus Data?</h3>
            <p class="text-sm text-slate-500 leading-relaxed">
                Tindakan ini akan menghapus data peminjaman secara permanen. Data yang sudah dihapus tidak dapat dipulihkan kembali.
            </p>
        </div>

        <div class="flex p-6 pt-0 gap-3">
            <button onclick="closeDeleteModal()"
                class="flex-1 px-4 py-3 text-xs font-bold text-slate-400 bg-slate-50 hover:bg-slate-100 rounded-2xl transition-all uppercase tracking-widest">
                Batal
            </button>
            <button id="confirmDeleteBtn"
                class="flex-[1.5] px-4 py-3 text-xs font-black text-white bg-rose-500 hover:bg-rose-600 rounded-2xl shadow-lg shadow-rose-200 transition-all transform active:scale-95 uppercase tracking-widest">
                Ya, Hapus Data
            </button>
        </div>
    </div>
</div>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-4 right-4 bg-white rounded-lg shadow-lg p-3 hidden z-50">
        <div class="flex items-center gap-2"><i id="toastIcon" class="text-lg"></i>
            <p id="toastMessage" class="text-sm"></p>
        </div>
    </div>

    <style>
        /* Animasi Entry */
        .animate-in {
            animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }
        /* Style tambahan untuk autocomplete items agar terlihat modern */
        #autocompleteDropdown div {
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
        }
        #autocompleteDropdown div:hover {
            background-color: #f8fafc;
            color: #4f46e5;
            padding-left: 25px;
        }

        .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>

    <script>
        // ==================== VARIABLES ====================
        let currentTab = 'aktif';
        let currentPage = 1;
        let currentFilters = {
            sort: 'default',
            search: '',
            pelanggan: 'all'
        };
        let barangList = [];
        let isLoading = false;
        let searchTimeout;
        let currentSearchValue = '';

        // ==================== HELPER FUNCTIONS ====================
        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        function formatDate(date) {
            return new Date(date).toLocaleDateString('id-ID');
        }

        function formatShortDate(date) {
            return new Date(date).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: '2-digit'
            });
        }

        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function getStatusBadge(status) {
        // Definisi Class Tailwind untuk masing-masing status
        const config = {
            aktif: {
                container: 'bg-emerald-50 text-emerald-600 border-emerald-100',
                dot: 'bg-emerald-500',
                ping: 'bg-emerald-400',
                icon: '', // Menggunakan dot animation
                text: 'Disewa'
            },
            selesai: {
                container: 'bg-slate-100 text-slate-600 border-slate-200',
                dot: 'hidden',
                ping: 'hidden',
                icon: '<i class="fas fa-check-circle text-[10px]"></i>',
                text: 'Selesai'
            },
            terlambat: {
                container: 'bg-rose-50 text-rose-600 border-rose-100 animate-pulse',
                dot: 'bg-rose-500',
                ping: 'bg-rose-400',
                icon: '<i class="fas fa-exclamation-triangle text-[10px]"></i>',
                text: 'Terlambat'
            }
        };

        // Ambil config berdasarkan status, default ke 'aktif' jika tidak ditemukan
        const s = config[status] || config.aktif;

        return `
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border text-[10px] font-black uppercase tracking-widest transition-all duration-300 hover:shadow-sm ${s.container}">
                <span class="relative flex h-2 w-2 ${status === 'selesai' ? 'hidden' : ''}">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full ${s.ping} opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 ${s.dot}"></span>
                </span>
                ${s.icon}
                <span class="leading-none">${s.text}</span>
            </span>
        `;
    }

        function showToast(msg, type) {
            const t = document.getElementById('toast');
            if (!t) {
                alert(msg);
                return;
            }
            document.getElementById('toastMessage').textContent = msg;
            t.classList.remove('hidden');
            setTimeout(() => t.classList.add('hidden'), 3000);
        }

        // ==================== BARANG FUNCTIONS ====================
        async function loadBarang() {
            try {
                const response = await fetch('/api/barang-tersedia');
                if (!response.ok) throw new Error('Network error');
                const result = await response.json();
                barangList = result;
                populateBarangSelects();
                if (barangList.length === 0) showToast('Barang tidak tersedia', 'warning');
            } catch (error) {
                console.error('Error loading barang:', error);
                showToast('Gagal memuat data barang', 'error');
            }
        }

        function populateBarangSelects() {
            document.querySelectorAll('.barang-select, #editBarangContainer .barang-select').forEach(select => {
                if (!select) return;
                const currentValue = select.value;
                select.innerHTML = '<option value="">Pilih Barang</option>';
                barangList.forEach(barang => {
                    if (barang.tersedia > 0) {
                        const option = document.createElement('option');
                        option.value = barang.id;
                        option.textContent =
                            `${barang.kode_barang} - ${barang.nama_barang} (${formatRupiah(barang.harga_sewa)}) - Tersedia: ${barang.tersedia}`;
                        select.appendChild(option);
                    }
                });
                if (currentValue) select.value = currentValue;
            });
        }

        function addBarang() {
            const container = document.getElementById('barangContainer');
            const index = container.children.length;
            const newRow = document.createElement('div');
            newRow.className = 'flex gap-2 items-center barang-row';
            newRow.innerHTML = `
        <select name="barang[${index}][id]" class="barang-select flex-1 px-3 py-2 border rounded-lg"><option value="">Pilih Barang</option></select>
        <input type="number" name="barang[${index}][jumlah]" placeholder="Jml" class="w-20 px-3 py-2 border rounded-lg" value="1">
        <button type="button" onclick="removeBarang(this)" class="text-red-500"><i class="fas fa-trash"></i></button>
    `;
            container.appendChild(newRow);
            populateBarangSelects();
        }

        function removeBarang(btn) {
            if (document.querySelectorAll('.barang-row').length > 1) btn.closest('.barang-row').remove();
        }

        // ==================== FETCH DATA ====================
        async function fetchData() {
            if (isLoading) return;
            isLoading = true;
            const loadingIndicator = document.getElementById('loadingIndicator');
            if (loadingIndicator) loadingIndicator.classList.remove('hidden');
            try {
                const params = new URLSearchParams({
                    page: currentPage,
                    status: currentTab,
                    sort: currentFilters.sort,
                    search: currentFilters.search,
                    pelanggan: currentFilters.pelanggan
                });
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 15000);
                const response = await fetch(`/peminjaman?${params}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    signal: controller.signal
                });
                clearTimeout(timeoutId);
                const result = await response.json();
                renderTable(result.data);
                renderPagination(result.pagination);
                updateBadges();
            } catch (error) {
                if (error.name === 'AbortError') showToast('Request timeout, silakan coba lagi', 'error');
                else {
                    console.error('Error:', error);
                    showToast('Gagal memuat data', 'error');
                }
            } finally {
                if (loadingIndicator) loadingIndicator.classList.add('hidden');
                isLoading = false;
            }
        }

        async function updateBadges() {
            try {
                const aktifRes = await fetch('/peminjaman?status=aktif&per_page=1', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const aktifResult = await aktifRes.json();
                const riwayatRes = await fetch('/peminjaman?status=riwayat&per_page=1', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const riwayatResult = await riwayatRes.json();
                document.getElementById('badgeAktif').textContent = aktifResult.pagination?.total || 0;
                document.getElementById('badgeRiwayat').textContent = riwayatResult.pagination?.total || 0;
            } catch (e) {
                console.error(e);
            }
        }

        // ==================== RENDER TABLE ====================
        function renderTable(data) {
            const tbody = document.getElementById('peminjamanTableBody');
            if (!tbody) return;
            if (!data || data.length === 0) {
                tbody.innerHTML =
                    '<tr><td colspan="8" class="px-6 py-12 text-center"><i class="fas fa-inbox text-4xl text-slate-300 mb-2 block"></i>Belum ada</td></tr>';
                return;
            }
            tbody.innerHTML = data.map(item => {
                const barangListStr = item.details?.map(d => d.nama_barang).join(', ') || '-';
                const isAktif = item.status_pengembalian === 'aktif';
                return `<tr class="hover:bg-gray-50 transition border-b border-slate-100">
            <td class="px-3 py-2.5 text-xs font-mono font-semibold">${escapeHtml(item.invoice_number)}</td>
            <td class="px-3 py-2.5 text-sm font-medium">${escapeHtml(item.nama_penyewa)}</td>
            <td class="px-3 py-2.5 text-xs text-slate-600 barang-list max-w-[200px] truncate" title="${escapeHtml(barangListStr)}">${escapeHtml(barangListStr.substring(0, 40))}${barangListStr.length > 40 ? '...' : ''}</td>
            <td class="px-3 py-2.5 text-xs">${formatShortDate(item.tanggal_sewa)}</td>
            <td class="px-3 py-2.5 text-xs">${formatShortDate(item.tanggal_kembali)}</td>
            <td class="px-3 py-2.5 text-xs font-semibold text-right">${formatRupiah(item.grand_total)}</td>
            <td class="px-3 py-2.5 text-center">${getStatusBadge(item.status_pengembalian)}</td>
            <td class="px-3 py-2.5 text-center">
                <div class="flex items-center justify-center gap-1.5 flex-wrap">
                    <button onclick="viewDetail(${item.id})" class="text-blue-600 hover:text-blue-800 p-1" title="Detail"><i class="fas fa-eye text-sm"></i></button>
                    ${isAktif ? `<button onclick="openEditModal(${item.id})" class="text-orange-600 hover:text-orange-800 p-1" title="Edit"><i class="fas fa-edit text-sm"></i></button>` : ''}
                    <button onclick="printInvoice(${item.id})" class="text-gray-600 hover:text-gray-800 p-1" title="Invoice"><i class="fas fa-print text-sm"></i></button>
                    ${isAktif ? `
                            <button onclick="openPengembalianModal(${item.id})" class="text-green-600 hover:text-green-800 p-1" title="Pengembalian"><i class="fas fa-undo-alt text-sm"></i></button>
                            <button onclick="sendPengirimanNotif(${item.id})" class="text-purple-600 hover:text-purple-800 p-1" title="Kirim WhatsApp"><i class="fab fa-whatsapp text-sm"></i></button>
                            <button onclick="sendPengingatNotif(${item.id})" class="text-yellow-600 hover:text-yellow-800 p-1" title="Pengingat"><i class="fas fa-bell text-sm"></i></button>
                        ` : ''}
                    <button onclick="deleteData(${item.id})" class="text-red-600 hover:text-red-800 p-1" title="Hapus"><i class="fas fa-trash text-sm"></i></button>
                </div>
            </td>
        </tr>`;
            }).join('');
        }

        function renderPagination(pagination) {
            const container = document.getElementById('paginationContainer');
            if (!container) return;
            if (!pagination || pagination.last_page <= 1) {
                container.innerHTML = '';
                return;
            }
            let html = '<div class="flex justify-center gap-1">';
            const current = pagination.current_page;
            const last = pagination.last_page;
            let start = Math.max(1, current - 2);
            let end = Math.min(last, current + 2);
            if (start > 1) {
                html += `<button onclick="changePage(1)" class="px-3 py-1 text-sm rounded-lg border">1</button>`;
                if (start > 2) html += `<span class="px-2">...</span>`;
            }
            for (let i = start; i <= end; i++) html +=
                `<button onclick="changePage(${i})" class="px-3 py-1 text-sm rounded-lg ${i === current ? 'bg-gray-700 text-white' : 'border hover:bg-gray-100'}">${i}</button>`;
            if (end < last) {
                if (end < last - 1) html += `<span class="px-2">...</span>`;
                html +=
                `<button onclick="changePage(${last})" class="px-3 py-1 text-sm rounded-lg border">${last}</button>`;
            }
            html += '</div>';
            container.innerHTML = html;
        }

        function changePage(page) {
            currentPage = page;
            fetchData();
        }

        // ==================== CRUD FUNCTIONS ====================
        function openTambahModal() {
            document.getElementById('modalTambah').classList.remove('hidden');
            document.getElementById('modalTambah').classList.add('flex');
        }

        function closeTambahModal() {
            document.getElementById('modalTambah').classList.add('hidden');
            document.getElementById('modalTambah').classList.remove('flex');
            document.getElementById('formPeminjaman')?.reset();
        }

        function printInvoice(id) {
            window.open(`/peminjaman/${id}/invoice`, '_blank');
        }

        async function viewDetail(id) {
            try {
                const response = await fetch(`/peminjaman/${id}`);
                const result = await response.json();
                if (result.success) {
                    const data = result.data;
                    const detailsHtml = data.details.map(d =>
                        `<tr class="border-b"><td class="py-1.5 text-sm">${escapeHtml(d.nama_barang)}</td><td class="py-1.5 text-center text-sm">${d.jumlah}</td><td class="py-1.5 text-right text-sm">${formatRupiah(d.harga_sewa)}</td><td class="py-1.5 text-right text-sm font-semibold">${formatRupiah(d.subtotal)}</td></tr>`
                        ).join('');
                    document.getElementById('detailContent').innerHTML = `
                <div class="grid grid-cols-3 gap-3 mb-4 pb-3 border-b">
                    <div><p class="text-xs text-slate-500">Invoice</p><p class="font-mono font-semibold text-sm">${data.invoice_number}</p></div>
                    <div><p class="text-xs text-slate-500">Status</p>${getStatusBadge(data.status_pengembalian)}</div>
                    <div><p class="text-xs text-slate-500">Penyewa</p><p class="font-semibold text-sm">${escapeHtml(data.nama_penyewa)}</p></div>
                    <div><p class="text-xs text-slate-500">Telepon</p><p class="text-sm">${escapeHtml(data.no_telepon)}</p></div>
                    <div><p class="text-xs text-slate-500">Tanggal Sewa</p><p class="text-sm">${formatDate(data.tanggal_sewa)} | ${data.waktu_sewa}</p></div>
                    <div><p class="text-xs text-slate-500">Tanggal Kembali</p><p class="text-sm">${formatDate(data.tanggal_kembali)} | ${data.waktu_kembali}</p></div>
                </div>
                <div class="mb-3"><p class="font-semibold text-sm mb-2">Detail Barang</p><div class="overflow-x-auto"><table class="w-full text-sm"><thead><tr class="bg-gray-50"><th class="px-2 py-1 text-left">Barang</th><th class="px-2 py-1 text-center w-16">Jml</th><th class="px-2 py-1 text-right w-28">Harga</th><th class="px-2 py-1 text-right w-28">Subtotal</th></tr></thead><tbody>${detailsHtml}</tbody><tfoot><tr class="border-t"><td colspan="3" class="px-2 py-2 text-right font-bold">TOTAL</td><td class="px-2 py-2 text-right font-bold">${formatRupiah(data.grand_total)}</td></tr></tfoot></table></div></div>
            `;
                    document.getElementById('modalDetail').classList.remove('hidden');
                    document.getElementById('modalDetail').classList.add('flex');
                }
            } catch (error) {
                showToast('Gagal mengambil detail', 'error');
            }
        }

        function closeDetailModal() {
            document.getElementById('modalDetail').classList.add('hidden');
            document.getElementById('modalDetail').classList.remove('flex');
        }

        // Variable global untuk menyimpan ID yang akan dihapus
let currentDeleteId = null;

// 1. Fungsi Utama (Trigger Modal)
function deleteData(id) {
    currentDeleteId = id;
    const modal = document.getElementById('modalDeleteConfirm');

    // Tampilkan Modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // Tambahkan Event Listener ke tombol konfirmasi di dalam modal
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    confirmBtn.onclick = async function() {
        await executeDelete();
    };
}

// 2. Fungsi Eksekusi (Logic Fetch)
async function executeDelete() {
    if (!currentDeleteId) return;

    const btn = document.getElementById('confirmDeleteBtn');
    const originalContent = btn.innerHTML;

    // UI Feedback: Loading state
    btn.disabled = true;
    btn.innerHTML = `<i class="fas fa-circle-notch fa-spin mr-2"></i> Menghapus...`;

    try {
        const response = await fetch(`/peminjaman/${currentDeleteId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (result.success) {
            showToast(result.message || 'Data berhasil dihapus', 'success');
            fetchData(); // Refresh tabel Anda
            closeDeleteModal();
        } else {
            showToast(result.message || 'Gagal menghapus data', 'error');
        }
    } catch (error) {
        showToast('Gagal menghubungi server', 'error');
    } finally {
        // Kembalikan tombol ke keadaan semula
        btn.disabled = false;
        btn.innerHTML = originalContent;
    }
}

// 3. Fungsi Tutup Modal
function closeDeleteModal() {
    const modal = document.getElementById('modalDeleteConfirm');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    currentDeleteId = null;
}

        // ==================== EDIT FUNCTIONS ====================
        async function openEditModal(id) {
            try {
                const response = await fetch(`/peminjaman/${id}`);
                const result = await response.json();
                if (result.success) {
                    const data = result.data;
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_invoice_number').value = data.invoice_number;
                    document.getElementById('edit_nama_penyewa').value = data.nama_penyewa;
                    document.getElementById('edit_no_telepon').value = data.no_telepon;
                    document.getElementById('edit_nama_acara').value = data.nama_acara || '';
                    document.getElementById('edit_lokasi_acara').value = data.lokasi_acara || '';
                    document.getElementById('edit_tanggal_sewa').value = data.tanggal_sewa;
                    document.getElementById('edit_tanggal_kembali').value = data.tanggal_kembali;
                    document.getElementById('edit_waktu_sewa').value = data.waktu_sewa;
                    document.getElementById('edit_waktu_kembali').value = data.waktu_kembali;
                    document.getElementById('edit_diskon').value = data.diskon;
                    document.getElementById('edit_status_pembayaran').value = data.status_pembayaran;
                    document.getElementById('edit_keterangan').value = data.keterangan || '';
                    const container = document.getElementById('editBarangContainer');
                    container.innerHTML = '';
                    data.details.forEach((detail) => {
                        addEditBarangRow(detail.barang_id, detail.jumlah);
                    });
                    document.getElementById('modalEdit').classList.remove('hidden');
                    document.getElementById('modalEdit').classList.add('flex');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Gagal mengambil data', 'error');
            }
        }

        function closeEditModal() {
            document.getElementById('modalEdit').classList.add('hidden');
            document.getElementById('modalEdit').classList.remove('flex');
        }

        function addEditBarang() {
            addEditBarangRow(null, 1);
        }

        function addEditBarangRow(selectedId = null, jumlah = 1) {
            const container = document.getElementById('editBarangContainer');
            const index = container.children.length;
            const newRow = document.createElement('div');
            newRow.className = 'flex gap-2 items-center barang-row mb-2';
            newRow.innerHTML =
                `<select name="barang[${index}][id]" class="barang-select flex-1 px-3 py-2 border rounded-lg"><option value="">Pilih Barang</option></select><input type="number" name="barang[${index}][jumlah]" placeholder="Jml" class="w-20 px-3 py-2 border rounded-lg" value="${jumlah}"><button type="button" onclick="removeEditBarang(this)" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>`;
            container.appendChild(newRow);
            populateBarangSelects();
            if (selectedId) {
                const select = newRow.querySelector('.barang-select');
                select.value = selectedId;
            }
        }

        function removeEditBarang(btn) {
            if (document.querySelectorAll('#editBarangContainer .barang-row').length > 1) btn.closest('.barang-row')
            .remove();
            else showToast('Minimal harus ada satu barang', 'warning');
        }

        document.getElementById('formEditPeminjaman')?.addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = document.getElementById('edit_id').value;
            const barang = [];
            document.querySelectorAll('#editBarangContainer .barang-row').forEach((row) => {
                const barangId = row.querySelector('[name*="[id]"]')?.value;
                const jumlah = row.querySelector('[name*="[jumlah]"]')?.value;
                if (barangId && jumlah) barang.push({
                    id: parseInt(barangId),
                    jumlah: parseInt(jumlah)
                });
            });
            if (barang.length === 0) {
                showToast('Pilih minimal satu barang', 'error');
                return;
            }
            const data = {
                nama_penyewa: document.getElementById('edit_nama_penyewa').value,
                no_telepon: document.getElementById('edit_no_telepon').value,
                customer_whatsapp: document.getElementById('edit_no_telepon').value,
                nama_acara: document.getElementById('edit_nama_acara').value,
                lokasi_acara: document.getElementById('edit_lokasi_acara').value,
                tanggal_sewa: document.getElementById('edit_tanggal_sewa').value,
                tanggal_kembali: document.getElementById('edit_tanggal_kembali').value,
                waktu_sewa: document.getElementById('edit_waktu_sewa').value,
                waktu_kembali: document.getElementById('edit_waktu_kembali').value,
                diskon: document.getElementById('edit_diskon').value,
                status_pembayaran: document.getElementById('edit_status_pembayaran').value,
                keterangan: document.getElementById('edit_keterangan').value,
                barang: barang
            };
            try {
                const response = await fetch(`/peminjaman/${id}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (result.success) {
                    showToast(result.message, 'success');
                    closeEditModal();
                    fetchData();
                } else {
                    showToast(result.message, 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Gagal mengupdate data', 'error');
            }
        });

        // ==================== PENGEMBALIAN FUNCTIONS ====================
        function openPengembalianModal(id) {
            document.getElementById('pengembalianId').value = id;
            document.getElementById('modalPengembalian').classList.remove('hidden');
            document.getElementById('modalPengembalian').classList.add('flex');
            resetPengembalianForm();
        }

        function closePengembalianModal() {
            document.getElementById('modalPengembalian').classList.add('hidden');
            document.getElementById('modalPengembalian').classList.remove('flex');
            resetPengembalianForm();
        }

        function resetPengembalianForm() {
            document.getElementById('formPengembalian').reset();
            document.getElementById('kerusakanSection').classList.add('hidden');
            document.getElementById('dendaSection').classList.add('hidden');
            document.getElementById('previewPengembalian').classList.add('hidden');
            document.getElementById('dropzonePengembalian').classList.remove('hidden');
        }

        function toggleKerusakan() {
            const kondisi = document.getElementById('kondisiBarang').value;
            if (kondisi === 'rusak') {
                document.getElementById('kerusakanSection').classList.remove('hidden');
                document.getElementById('dendaSection').classList.remove('hidden');
            } else if (kondisi === 'kurang_baik') {
                document.getElementById('kerusakanSection').classList.remove('hidden');
                document.getElementById('dendaSection').classList.add('hidden');
            } else {
                document.getElementById('kerusakanSection').classList.add('hidden');
                document.getElementById('dendaSection').classList.add('hidden');
            }
        }
        document.getElementById('formPengembalian')?.addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = document.getElementById('pengembalianId').value;
            const formData = new FormData(e.target);
            try {
                const response = await fetch(`/peminjaman/${id}/pengembalian`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });
                const result = await response.json();
                if (result.success) {
                    showToast(result.message, 'success');
                    closePengembalianModal();
                    fetchData();
                } else {
                    showToast(result.message, 'error');
                }
            } catch (error) {
                showToast('Gagal memproses', 'error');
            }
        });

        // ==================== WHATSAPP FUNCTIONS ====================
        async function sendPengirimanNotif(id) {
            if (confirm('Kirim notifikasi pengiriman ke pelanggan?')) {
                try {
                    const response = await fetch(`/peminjaman/${id}/send-pengiriman`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });
                    const result = await response.json();
                    if (result.success) showToast(result.message, 'success');
                    else showToast(result.message, 'error');
                } catch (error) {
                    console.error('Error:', error);
                    showToast('Gagal mengirim notifikasi', 'error');
                }
            }
        }
        async function sendPengingatNotif(id) {
            if (confirm('Kirim pengingat pengembalian ke pelanggan?')) {
                try {
                    const response = await fetch(`/peminjaman/${id}/send-pengingat`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });
                    const result = await response.json();
                    if (result.success) showToast(result.message, 'success');
                    else showToast(result.message, 'error');
                } catch (error) {
                    console.error('Error:', error);
                    showToast('Gagal mengirim pengingat', 'error');
                }
            }
        }

        // ==================== FORM SUBMISSIONS ====================
        document.getElementById('formPeminjaman')?.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = {
                nama_penyewa: formData.get('nama_penyewa'),
                no_telepon: formData.get('no_telepon'),
                customer_whatsapp: formData.get('no_telepon'),
                email: formData.get('email'),
                alamat: formData.get('alamat'),
                tipe_pelanggan: formData.get('tipe_pelanggan'),
                nama_acara: formData.get('nama_acara'),
                lokasi_acara: formData.get('lokasi_acara'),
                tanggal_sewa: formData.get('tanggal_sewa'),
                tanggal_kembali: formData.get('tanggal_kembali'),
                waktu_sewa: formData.get('waktu_sewa'),
                waktu_kembali: formData.get('waktu_kembali'),
                diskon: formData.get('diskon'),
                status_pembayaran: formData.get('status_pembayaran'),
                keterangan: formData.get('keterangan'),
                pelanggan_id: formData.get('pelanggan_id'),
                barang: []
            };
            document.querySelectorAll('#barangContainer .barang-row').forEach(row => {
                const id = row.querySelector('[name*="[id]"]')?.value;
                const jumlah = row.querySelector('[name*="[jumlah]"]')?.value;
                if (id && jumlah) data.barang.push({
                    id: parseInt(id),
                    jumlah: parseInt(jumlah)
                });
            });
            if (data.barang.length === 0) {
                showToast('Pilih minimal satu barang', 'error');
                return;
            }
            try {
                const response = await fetch('/peminjaman', {
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
                    closeTambahModal();
                    fetchData();
                } else {
                    showToast(result.message, 'error');
                }
            } catch (error) {
                showToast('Gagal menyimpan', 'error');
            }
        });

        // ==================== EVENT LISTENERS ====================
        document.getElementById('filterSort')?.addEventListener('change', (e) => {
            currentFilters.sort = e.target.value;
            currentPage = 1;
            fetchData();
        });
        document.getElementById('searchInput')?.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                currentFilters.search = e.target.value;
                currentPage = 1;
                fetchData();
            }, 500);
        });

       function switchTab(tab) {
    currentTab = tab;
    currentPage = 1;

    const aktifBtn = document.getElementById('tabAktifBtn');
    const riwayatBtn = document.getElementById('tabRiwayatBtn');

    // Daftar class untuk tampilan "Aktif" (Putih, Indigo, Shadow)
    const activeClasses = ['bg-white', 'text-indigo-600', 'shadow-sm', 'border-slate-200/50'];
    // Daftar class untuk tampilan "Tidak Aktif" (Transparan, Abu-abu)
    const inactiveClasses = ['text-slate-500'];

    if (tab === 'aktif') {
        // 1. Berikan gaya aktif ke tombol Aktif
        aktifBtn?.classList.add(...activeClasses);
        aktifBtn?.classList.remove(...inactiveClasses);

        // 2. Hapus gaya aktif dari tombol Riwayat
        riwayatBtn?.classList.remove(...activeClasses);
        riwayatBtn?.classList.add(...inactiveClasses);
    } else {
        // 1. Berikan gaya aktif ke tombol Riwayat
        riwayatBtn?.classList.add(...activeClasses);
        riwayatBtn?.classList.remove(...inactiveClasses);

        // 2. Hapus gaya aktif dari tombol Aktif
        aktifBtn?.classList.remove(...activeClasses);
        aktifBtn?.classList.add(...inactiveClasses);
    }

    fetchData();
}

        // ==================== DROPZONE FUNCTIONS ====================
        const dropzone = document.getElementById('dropzonePengembalian');
        const fileInput = document.getElementById('fotoPengembalian');
        const preview = document.getElementById('previewPengembalian');
        const previewImg = document.getElementById('previewImgPengembalian');
        if (dropzone && fileInput) {
            dropzone.addEventListener('click', () => fileInput.click());
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('border-gray-500', 'bg-gray-50');
            });
            dropzone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('border-gray-500', 'bg-gray-50');
            });
            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('border-gray-500', 'bg-gray-50');
                const files = e.dataTransfer.files;
                if (files && files.length > 0) {
                    const file = files[0];
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    const changeEvent = new Event('change', {
                        bubbles: true
                    });
                    fileInput.dispatchEvent(changeEvent);
                    previewImage(file);
                }
            });
        }
        fileInput?.addEventListener('change', (e) => {
            if (e.target.files && e.target.files.length > 0) previewImage(e.target.files[0]);
            else {
                preview?.classList.add('hidden');
                dropzone?.classList.remove('hidden');
                if (previewImg) previewImg.src = '';
            }
        });

        function previewImage(file) {
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                if (previewImg) previewImg.src = e.target.result;
                if (preview) preview.classList.remove('hidden');
                if (dropzone) dropzone.classList.add('hidden');
            };
            reader.onerror = function() {
                console.error('Failed to load image');
                showToast('Gagal memuat gambar', 'error');
            };
            reader.readAsDataURL(file);
        }

        // ==================== CEK PELANGGAN FUNCTIONS ====================
        function openCekPelangganModal() {
            document.getElementById('modalCekPelanggan').classList.remove('hidden');
            document.getElementById('modalCekPelanggan').classList.add('flex');
            document.getElementById('searchPelanggan').value = '';
            document.getElementById('hasilCekPelanggan').classList.add('hidden');
            document.getElementById('pelangganNotFound').classList.add('hidden');
            document.getElementById('autocompleteDropdown').classList.add('hidden');
        }

        function closeCekPelangganModal() {
            document.getElementById('modalCekPelanggan').classList.add('hidden');
            document.getElementById('modalCekPelanggan').classList.remove('flex');
        }
        document.getElementById('searchPelanggan')?.addEventListener('input', function(e) {
            const keyword = e.target.value;
            clearTimeout(searchTimeout);
            if (keyword.length < 2) {
                document.getElementById('autocompleteDropdown').classList.add('hidden');
                return;
            }
            searchTimeout = setTimeout(() => searchPelangganAutocomplete(keyword), 300);
        });
        document.getElementById('searchPelanggan')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const keyword = this.value;
                if (keyword.length >= 2) searchPelanggan(keyword);
            }
        });
        async function searchPelangganAutocomplete(keyword) {
            try {
                const response = await fetch(`/peminjaman/pelanggan-list?search=${encodeURIComponent(keyword)}`);
                const result = await response.json();
                const dropdown = document.getElementById('autocompleteDropdown');
                if (result.data && result.data.length > 0) {
                    dropdown.innerHTML = result.data.map(p =>
                        `<div onclick="selectPelangganSuggestion(${p.id}, '${escapeHtml(p.nama)}', '${escapeHtml(p.no_telepon)}')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer border-b border-slate-100 last:border-0"><div class="font-medium">${escapeHtml(p.nama)}</div><div class="text-xs text-slate-500">${escapeHtml(p.no_telepon)}</div></div>`
                        ).join('');
                    dropdown.classList.remove('hidden');
                } else {
                    dropdown.classList.add('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }

        function selectPelangganSuggestion(id, nama, telepon) {
            document.getElementById('searchPelanggan').value = nama;
            document.getElementById('autocompleteDropdown').classList.add('hidden');
            searchPelanggan(nama);
        }
        async function searchPelanggan(keyword) {
            try {
                const response = await fetch('/peminjaman/cek-pelanggan', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        keyword: keyword
                    })
                });
                const result = await response.json();
                if (result.exists) {
                    document.getElementById('hasilNama').textContent = result.data.nama;
                    document.getElementById('hasilTelepon').textContent = result.data.no_telepon;
                    document.getElementById('hasilEmail').textContent = result.data.email || '-';
                    document.getElementById('hasilTotalTransaksi').textContent = result.total_transaksi;
                    document.getElementById('hasilTotalNilai').textContent = formatRupiah(result.total_nilai);
                    const statusSpan = document.getElementById('hasilStatus');
                    if (result.data.status === 'aktif') {
                        statusSpan.textContent = 'Aktif';
                        statusSpan.className =
                            'px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700';
                    } else {
                        statusSpan.textContent = 'Nonaktif';
                        statusSpan.className = 'px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700';
                    }
                    const riwayatList = document.getElementById('riwayatList');
                    if (result.riwayat && result.riwayat.length > 0) riwayatList.innerHTML = result.riwayat.map(r =>
                        `<div class="bg-white rounded-lg p-2 border border-slate-200"><div class="flex justify-between items-center"><span class="font-mono text-xs">${r.invoice_number}</span><span class="text-xs ${r.status_pengembalian === 'aktif' ? 'text-green-600' : 'text-gray-500'}">${r.status_pengembalian === 'aktif' ? '🟢 Aktif' : '✅ Selesai'}</span></div><div class="text-xs text-slate-500 mt-1">Tanggal: ${formatDate(r.tanggal_sewa)} - ${formatDate(r.tanggal_kembali)}</div><div class="text-xs font-semibold mt-1">Total: ${formatRupiah(r.grand_total)}</div></div>`
                        ).join('');
                    else riwayatList.innerHTML = '<p class="text-xs text-slate-500">Belum ada riwayat peminjaman</p>';
                    window.selectedCustomer = result.data;
                    document.getElementById('hasilCekPelanggan').classList.remove('hidden');
                    document.getElementById('pelangganNotFound').classList.add('hidden');
                } else {
                    document.getElementById('hasilCekPelanggan').classList.add('hidden');
                    document.getElementById('pelangganNotFound').classList.remove('hidden');
                    const suggestionsContainer = document.getElementById('suggestionsContainer');
                    if (result.suggestions && result.suggestions.length > 0) suggestionsContainer.innerHTML =
                        `<p class="text-sm text-slate-600 mb-2">Pelanggan dengan nama mirip:</p>${result.suggestions.map(s => `<div onclick="selectPelangganSuggestion(${s.id}, '${escapeHtml(s.nama)}', '${escapeHtml(s.no_telepon)}')" class="p-2 bg-gray-100 rounded-lg mb-2 cursor-pointer hover:bg-gray-200"><div class="font-medium">${escapeHtml(s.nama)}</div><div class="text-xs text-slate-500">${escapeHtml(s.no_telepon)}</div></div>`).join('')}`;
                    else suggestionsContainer.innerHTML = '';
                    window.selectedCustomer = null;
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Gagal mengecek pelanggan', 'error');
            }
        }

        function useExistingCustomer() {
            if (window.selectedCustomer) {
                document.getElementById('pelanggan_id').value = window.selectedCustomer.id;
                document.getElementById('nama_penyewa').value = window.selectedCustomer.nama;
                document.getElementById('no_telepon').value = window.selectedCustomer.no_telepon;
                document.getElementById('email').value = window.selectedCustomer.email || '';
                document.getElementById('alamat').value = window.selectedCustomer.alamat || '';
                document.getElementById('tipe_pelanggan').value = window.selectedCustomer.tipe || 'perorangan';
                closeCekPelangganModal();
                showToast('Data pelanggan berhasil diisi', 'success');
            }
        }

        function openNewCustomerForm() {
            closeCekPelangganModal();
            document.getElementById('pelanggan_id').value = '';
            document.getElementById('nama_penyewa').value = '';
            document.getElementById('no_telepon').value = document.getElementById('searchPelanggan').value || '';
            document.getElementById('email').value = '';
            document.getElementById('alamat').value = '';
            document.getElementById('tipe_pelanggan').value = 'perorangan';
        }
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('autocompleteDropdown');
            const searchInput = document.getElementById('searchPelanggan');
            if (dropdown && !dropdown.contains(e.target) && e.target !== searchInput) dropdown.classList.add(
                'hidden');
        });

        // ==================== INITIALIZE ====================
        document.addEventListener('DOMContentLoaded', function() {
            loadBarang();
            fetchData();
        });
    </script>
@endsection
