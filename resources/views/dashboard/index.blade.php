@extends('layouts.app')

@section('title', 'Multidaya Inti Persada | Dashboard')
@section('page-title', 'Dashboard Overview')
@section('dashboard-active', 'bg-gray-100 text-gray-800 shadow-sm')

@section('main-content')
<div class="px-4 sm:px-6 lg:px-8 py-6 max-w-7xl mx-auto animate-fade-in relative">

    <!-- SECTION 1: TOP STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Sewa Aktif -->
    <div class="group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
        <div class="flex items-start justify-between">
            <div class="space-y-3">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sewa Aktif</p>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight">
                    24 <span class="text-xs font-bold text-slate-400 ml-1 uppercase tracking-tighter">Items</span>
                </h2>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-500 group-hover:bg-indigo-500 group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-boxes text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Income -->
    <div class="group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
        <div class="flex items-start justify-between">
            <div class="space-y-3">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Income</p>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-emerald-600 tracking-tight">
                    Rp 12.5M
                </h2>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-wallet text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Pengeluaran -->
    <div class="group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-rose-500/10 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
        <div class="flex items-start justify-between">
            <div class="space-y-3">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pengeluaran</p>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-rose-600 tracking-tight">
                    Rp 3.2M
                </h2>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500 group-hover:bg-rose-500 group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-receipt text-2xl"></i>
            </div>
        </div>
    </div>
</div>

    <!-- SECTION 2: MAIN CONTENT (Calendar & Reminder) -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 items-start">
        <div class="lg:col-span-3 bg-white rounded-2xl border border-slate-100 shadow-sm p-4 relative overflow-hidden">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 id="monthTitle" class="text-base font-black text-slate-800">Mei 2026</h3>
                    <p class="text-[11px] text-slate-400 font-bold uppercase tracking-tighter">Live Schedule</p>
                </div>
                <div class="flex gap-1">
                    <button onclick="changeMonth(-1)" class="w-7 h-7 rounded-full bg-slate-50 hover:bg-slate-200 flex items-center justify-center text-slate-600 transition-all"><i class="fas fa-chevron-left text-[11px]"></i></button>
                    <button onclick="changeMonth(1)" class="w-7 h-7 rounded-full bg-slate-50 hover:bg-slate-200 flex items-center justify-center text-slate-600 transition-all"><i class="fas fa-chevron-right text-[11px]"></i></button>
                </div>
            </div>

            <div class="grid grid-cols-7 gap-px text-center mb-1">
                <div class="text-[9px] font-black text-slate-300 uppercase">Min</div>
                <div class="text-[9px] font-black text-slate-300 uppercase">Sen</div>
                <div class="text-[9px] font-black text-slate-300 uppercase">Sel</div>
                <div class="text-[9px] font-black text-slate-300 uppercase">Rab</div>
                <div class="text-[9px] font-black text-slate-300 uppercase">Kam</div>
                <div class="text-[9px] font-black text-slate-300 uppercase">Jum</div>
                <div class="text-[9px] font-black text-slate-300 uppercase">Sab</div>
            </div>

            <div id="calendarGrid" class="grid grid-cols-7 gap-1.5"></div>

            <!-- POPUP DETAIL KALENDER (UPDATED) -->
            <div id="schedulePopup" class="hidden absolute inset-0 z-20 bg-white/98 backdrop-blur-md p-6 flex flex-col animate-fade-in shadow-2xl">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h4 class="font-black text-lg text-slate-800 uppercase leading-none">Detail Acara</h4>
                        <p id="popupDateLabel" class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mt-1"></p>
                    </div>
                    <button onclick="closePopup()" class="w-8 h-8 rounded-full ...">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>

                <div id="popupContent" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- JS akan mengisi ini -->
                </div>

                {{-- <div class="mt-auto pt-6 flex gap-3">
                    <button class="flex-1 py-3 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-800 transition-all">Edit Jadwal</button>
                    <button class="w-12 py-3 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center hover:bg-emerald-200 transition-all"><i class="fab fa-whatsapp"></i></button>
                </div> --}}
            </div>
            <div class="flex gap-3 mt-1">

            <!-- Indikator -->
            <div class="flex items-center gap-1.5">
                <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">Pengantaran</span>
            </div>
            <!-- Indikator Kuning/Amber -->
            <div class="flex items-center gap-1.5">
                <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">Pengembalian</span>
            </div>
        </div>
        </div>
        <!-- Kolom Reminder (Span 1) -->
        <div style="background-color: #4d7cbf;" class="rounded-2xl p-4 shadow-lg relative overflow-hidden flex flex-col h-full">
            <h3 class="text-slate-900 font-black text-[12px] mb-3 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-red-600 rounded-full animate-pulse"></span>
                Pengingat H-1
            </h3>
            <div class="space-y-2">
                <div class="bg-white/30 p-2.5 rounded-xl border border-white/20 backdrop-blur-sm">
                    <span class="text-[11px] font-black text-slate-800 uppercase tracking-tighter block mb-0.5">Kembali • 09:00</span>
                    <p class="text-slate-900 font-black text-[11px]">John Doe</p>
                    <p class="text-slate-800 text-[11px] leading-tight truncate">Sony A7III + Lensa</p>
                </div>
                <div class="bg-white/30 p-2.5 rounded-xl border border-white/20 backdrop-blur-sm">
                    <span class="text-[11px] font-black text-slate-800 uppercase tracking-tighter block mb-0.5">Sewa • 13:00</span>
                    <p class="text-slate-900 font-black text-[11px]">PT. Maju Bersama</p>
                    <p class="text-slate-800 text-[11px] leading-tight truncate">Sound System Set A</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 3: ANALYTICS & AI -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mt-6">
        <!-- Grafik -->
        <div class="lg:col-span-3 bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <h3 class="text-base font-black text-slate-800 uppercase tracking-wider">Analisis Penyewaan</h3>
                <div class="inline-flex p-1 bg-slate-50 rounded-xl">
                    <button onclick="updateChartRange('mingguan')" id="btnMingguan" class="px-4 py-1.5 rounded-lg text-[10px] font-black uppercase bg-white shadow-sm text-indigo-600">Mingguan</button>
                    <button onclick="updateChartRange('tahunan')" id="btnTahunan" class="px-4 py-1.5 rounded-lg text-[10px] font-black uppercase text-slate-400">Tahunan</button>
                </div>

            </div>
            <div class="relative h-[300px]"><canvas id="salesChart"></canvas></div>
            <div class="flex flex-wrap gap-3 mt-2">
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-1 bg-[#a855f7] rounded-full"></span>
                <span class="text-[9px] font-black text-slate-400 uppercase">Screen</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-1 bg-[#3b82f6] rounded-full"></span>
                <span class="text-[9px] font-black text-slate-400 uppercase">Proyektor</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-1 bg-[#10b981] rounded-full"></span>
                <span class="text-[9px] font-black text-slate-400 uppercase">TV</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-1 bg-[#f59e0b] rounded-full"></span>
                <span class="text-[9px] font-black text-slate-400 uppercase">Kabel</span>
            </div>
        </div>
        </div>


        <!-- AI Cards -->
        <div class="lg:col-span-1 flex flex-col gap-4">
            <div class="bg-indigo-600 rounded-3xl p-5 shadow-xl text-white flex-1 border-4 border-white">
                <h4 class="text-[10px] font-black uppercase tracking-widest mb-4 opacity-80">Optimasi Profit (AI)</h4>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4">
                    <h5 class="text-base font-black mb-3 leading-tight">Layar Screen 2x2m <br><span class="text-[10px] opacity-60">Demand Turun 15%</span></h5>
                    <button onclick="openAIDiscountForm()" class="w-full bg-white text-indigo-600 py-2.5 rounded-xl text-[10px] font-black uppercase hover:bg-indigo-50 transition-all">Atur Promo</button>
                </div>
            </div>

            <div class="bg-emerald-600 rounded-3xl p-5 shadow-xl text-white flex-1 border-4 border-white">
                <h4 class="text-[10px] font-black uppercase tracking-widest mb-4 opacity-80">Analisis Stok (AI)</h4>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4">
                    <h5 class="text-base font-black mb-1">Epson EB-X500</h5>
                    <p class="text-[10px] mb-3 opacity-80 font-medium">Potensi rugi <span class="font-bold">Rp 2.4jt/bln</span></p>
                    <button onclick="openAIRestockModal()" class="w-full bg-emerald-400 text-white py-2.5 rounded-xl text-[10px] font-black uppercase hover:bg-emerald-500 transition-all border border-emerald-300">Tambah Unit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FORM DISKON AI (PERBAIKAN SESUAI PERMINTAAN) -->
    <div id="aiDiscountModal" class="fixed inset-0 z-[110] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeAIDiscountForm()"></div>
        <div class="relative bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden animate-slide-up">
            <div class="bg-indigo-600 p-6 text-white text-center">
                <h3 class="font-black text-sm uppercase tracking-widest">Penjadwalan Promo AI</h3>
                <p id="displayItemName" class="text-[10px] opacity-70 uppercase font-bold mt-1">Layar Screen 2x2m</p>
            </div>

            <div class="p-6 space-y-4">
                <!-- Nama Barang (Read Only) -->
                <div>
                    <label class="text-[9px] font-black text-slate-400 mb-1 block uppercase">Nama Barang</label>
                    <input type="text" id="promoItemName" value="Layar Screen 2x2m" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-[12px] font-bold outline-none" readonly>
                </div>

                <!-- Input Tanggal -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-[9px] font-black text-slate-400 mb-1 block uppercase">Mulai</label>
                        <input type="date" id="promoStart" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-[12px] font-bold outline-none">
                    </div>
                    <div>
                        <label class="text-[9px] font-black text-slate-400 mb-1 block uppercase">Selesai</label>
                        <input type="date" id="promoEnd" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-[12px] font-bold outline-none">
                    </div>
                </div>

                <!-- Input Persentase Diskon -->
                <div>
                    <label class="text-[9px] font-black text-slate-400 mb-1 block uppercase">Jumlah Diskon (%)</label>
                    <div class="relative">
                        <input type="number" id="discountInput" oninput="calculateDiscount()" placeholder="0" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-[12px] font-bold outline-none">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 font-black text-slate-400">%</span>
                    </div>
                </div>

                <!-- Area Kalkulasi Otomatis -->
                <div class="bg-slate-50 p-4 rounded-2xl border border-dashed border-slate-200 space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-black text-slate-400 uppercase">Harga Normal</span>
                        <span class="text-xs font-black text-slate-400 line-through">Rp 150.000</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-black text-indigo-600 uppercase block">Harga Promo</span>
                            <p id="saveAmount" class="text-[9px] font-bold text-emerald-500 uppercase">Hemat Rp 0</p>
                        </div>
                        <div class="text-right">
                            <span id="finalPrice" class="text-lg font-black text-indigo-600">Rp 150.000</span>
                        </div>
                    </div>
                </div>

                <button onclick="applyDiscount()" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl text-[11px] uppercase tracking-widest shadow-xl active:scale-95 transition-all">Terapkan Strategi</button>
            </div>
        </div>
    </div>

    <!-- MODAL FORM RESTOCK AI -->
    <div id="aiRestockModal" class="fixed inset-0 z-[110] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeAIRestockModal()"></div>
        <div class="relative bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden animate-slide-up">
            <div class="bg-emerald-600 p-6 text-white text-center">
                <h3 class="font-black text-sm uppercase tracking-widest">Pengadaan Unit Baru</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="bg-emerald-50 p-4 rounded-2xl flex items-center gap-4">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-emerald-600 shadow-sm"><i class="fas fa-plus-circle"></i></div>
                    <div>
                        <p class="text-[10px] font-black text-emerald-600 uppercase">Saran Jumlah</p>
                        <p class="text-sm font-black text-slate-800">+3 Unit Epson EB-X500</p>
                    </div>
                </div>
                <div>
                    <label class="text-[9px] font-black text-slate-400 mb-1.5 block uppercase tracking-widest">Analisis Alasan (AI)</label>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 italic text-xs text-slate-600 leading-relaxed">
                        "Terjadi penolakan order sebanyak <span class="font-black text-rose-500">12 kali</span> dalam 30 hari terakhir akibat stok kosong pada akhir pekan. Menambah 3 unit akan mengamankan potensi revenue <span class="font-black text-emerald-600">Rp 2.400.000/bulan</span>."
                    </div>
                </div>
                <button onclick="confirmRestock()" class="w-full bg-slate-900 text-white font-black py-4 rounded-2xl text-[11px] uppercase tracking-widest shadow-xl active:scale-95 transition-all">Konfirmasi Pengadaan</button>
            </div>
        </div>
    </div>


    <!-- FLOATING WHATSAPP -->
    <div class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-[100] flex flex-col items-end w-[calc(100%-2rem)] sm:w-auto">
        <div id="waFormCard" class="hidden mb-4 w-full sm:w-80 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.2)] rounded-[2rem] border border-slate-100 overflow-hidden animate-slide-up flex flex-col max-h-[75vh] sm:max-h-none">
            <div class="bg-emerald-500 p-5 text-white shrink-0">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-lg"><i class="fab fa-whatsapp text-lg"></i></div>
                        <div>
                            <h3 class="font-bold text-sm leading-none">WhatsApp Blast</h3>
                            <p class="text-[10px] opacity-80 mt-1">Kirim pengingat cepat</p>
                        </div>
                    </div>
                    <button onclick="toggleWAForm()" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-black/10 transition-all"><i class="fas fa-times text-xs"></i></button>
                </div>
            </div>
            <div class="p-5 overflow-y-auto custom-scrollbar">
                <form class="space-y-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 mb-1.5 block uppercase tracking-widest">Nomor WhatsApp</label>
                        <div class="relative group">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400">+62</span>
                            <input type="number" id="waNumber" placeholder="812345678" class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none font-bold text-slate-700 transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 mb-1.5 block uppercase tracking-widest">Pilih Template</label>
                        <div class="relative">
                            <select id="waType" onchange="updateWATemplate()" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none cursor-pointer font-bold text-slate-700 appearance-none transition-all">
                                <option value="custom">✍️ Pesan Custom</option>
                                <option value="pengingat">🔔 Pengingat Sewa (H-1)</option>
                                <option value="pengembalian">📦 Pengembalian (H-1)</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-[10px] pointer-events-none"></i>
                        </div>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 mb-1.5 block uppercase tracking-widest">Isi Pesan</label>
                        <textarea id="waText" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none resize-none font-medium text-slate-600 leading-relaxed transition-all" placeholder="Tulis pesan..."></textarea>
                    </div>
                    <button type="button" onclick="sendToWhatsApp()" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-black py-3.5 rounded-xl text-[11px] shadow-lg shadow-emerald-100 active:scale-95 transition-all flex items-center justify-center gap-2 uppercase tracking-widest mt-2">
                        <i class="fab fa-whatsapp text-base"></i>
                        <span>Kirim Sekarang</span>
                    </button>
                </form>
            </div>
        </div>
        <button onclick="toggleWAForm()" class="bg-emerald-500 text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-90 transition-all border-4 border-white">
            <i class="fab fa-whatsapp text-2xl"></i>
        </button>
    </div>
    <!-- SECTION 4: ACTIVITY & TOP PRODUCTS -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

        <!-- Riwayat Aktivitas Terbaru -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Riwayat Aktivitas Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-[11px] uppercase tracking-wider border-b border-slate-50">
                            <th class="pb-4 font-black">Waktu</th>
                            <th class="pb-4 font-black">Jenis Aktivitas</th>
                            <th class="pb-4 font-black">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="text-[12px]">
                        <tr class="border-b border-slate-50">
                            <td class="py-4 text-slate-500 font-medium">10.32</td>
                            <td class="py-4 text-indigo-600 font-bold">Transaksi Penyewaan</td>
                            <td class="py-4 text-slate-600">PB274 - TV LG 2024 disewa oleh Carissa Fathinah</td>
                        </tr>
                        <tr class="border-b border-slate-50">
                            <td class="py-4 text-slate-500 font-medium">08.10</td>
                            <td class="py-4 text-rose-500 font-bold">Pengeluaran</td>
                            <td class="py-4 text-slate-600">Pembelian kabel</td>
                        </tr>
                        <tr class="border-b border-slate-50">
                            <td class="py-4 text-slate-500 font-medium">10.32</td>
                            <td class="py-4 text-emerald-600 font-bold">Pengembalian</td>
                            <td class="py-4 text-slate-600">PB270 - Epson EB-S300 dikembalikan</td>
                        </tr>
                        <tr>
                            <td class="py-4 text-slate-500 font-medium">10.32</td>
                            <td class="py-4 text-amber-600 font-bold">Edit Penyewaan</td>
                            <td class="py-4 text-slate-600">Update tanggal kembali</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Top Products</h3>
            <div class="space-y-6">
                <!-- Header -->
                <div class="grid grid-cols-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 pb-2">
                    <div class="col-span-1">#</div>
                    <div class="col-span-2">Name</div>
                    <div class="col-span-2">Popularity</div>
                    <div class="col-span-1 text-right">Sales</div>
                </div>

                <!-- Item 1 -->
                <div class="grid grid-cols-6 items-center gap-2">
                    <div class="text-[11px] font-bold text-slate-400">01</div>
                    <div class="col-span-2 text-[11px] font-bold text-slate-700 truncate">LG Smart TV 2024</div>
                    <div class="col-span-2">
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-amber-500 h-full rounded-full" style="width: 46%"></div>
                        </div>
                    </div>
                    <div class="col-span-1 text-right">
                        <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-2 py-1 rounded-lg border border-amber-100">46%</span>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="grid grid-cols-6 items-center gap-2">
                    <div class="text-[11px] font-bold text-slate-400">02</div>
                    <div class="col-span-2 text-[11px] font-bold text-slate-700 truncate">Epson EB-X500</div>
                    <div class="col-span-2">
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-emerald-500 h-full rounded-full" style="width: 17%"></div>
                        </div>
                    </div>
                    <div class="col-span-1 text-right">
                        <span class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg border border-emerald-100">17%</span>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="grid grid-cols-6 items-center gap-2">
                    <div class="text-[11px] font-bold text-slate-400">03</div>
                    <div class="col-span-2 text-[11px] font-bold text-slate-700 truncate">Sound System A</div>
                    <div class="col-span-2">
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-indigo-500 h-full rounded-full" style="width: 19%"></div>
                        </div>
                    </div>
                    <div class="col-span-1 text-right">
                        <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg border border-indigo-100">19%</span>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="grid grid-cols-6 items-center gap-2">
                    <div class="text-[11px] font-bold text-slate-400">04</div>
                    <div class="col-span-2 text-[11px] font-bold text-slate-700 truncate">Kabel HDMI 20m</div>
                    <div class="col-span-2">
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-fuchsia-500 h-full rounded-full" style="width: 29%"></div>
                        </div>
                    </div>
                    <div class="col-span-1 text-right">
                        <span class="text-[10px] font-black text-fuchsia-600 bg-fuchsia-50 px-2 py-1 rounded-lg border border-fuchsia-100">29%</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // --- 1. DATA & GLOBAL VARIABLES ---
    // Saya tambahkan basePrice agar fungsi calculateDiscount() bisa jalan
    const basePrice = 150000;
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    const schedulesData = {
        "5-4-2026": {
            type: 'antar',
            name: 'Andi Wijaya (PT. Kreatif Digital)',
            address: 'Grand Ballroom Hotel Aston, Bogor',
            time: '08:30 WIB',
            category: 'Kamera & Lensa',
            brand: 'Sony A7IV + FE 24-70mm GM'
        },
        "12-4-2026": {
            type: 'kembali',
            name: 'Siska Putri (Wedding Organizer)',
            address: 'Gedung Bale Binarum, Bogor',
            time: '14:00 WIB',
            category: 'Sound System',
            brand: 'Yamaha DBR12 + Mixer MG12XU'
        }
    };

    // --- 2. CALENDAR LOGIC ---
    function generateCalendar(month, year) {
        const grid = document.getElementById('calendarGrid');
        const title = document.getElementById('monthTitle');
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        grid.innerHTML = '';
        title.innerText = `${monthNames[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) grid.innerHTML += `<div></div>`;
        for (let day = 1; day <= daysInMonth; day++) {
            const dateKey = `${day}-${month}-${year}`;
            const schedule = schedulesData[dateKey];
            let markHtml = schedule ? `<div class="w-2 h-2 ${schedule.type === 'antar' ? 'bg-indigo-500' : 'bg-amber-500'} rounded-full mt-0.5"></div>` : '';
            const isToday = day === new Date().getDate() && month === new Date().getMonth() ? 'bg-slate-900 text-white shadow-lg' : 'bg-slate-50 text-slate-600 hover:bg-slate-100';
            grid.innerHTML += `<div onclick="showDetail('${dateKey}')" class="h-10 flex flex-col items-center justify-center rounded-xl cursor-pointer transition-all ${isToday} font-bold text-[10px]">${day}${markHtml}</div>`;
        }
    }

    function showDetail(key) {
        const data = schedulesData[key]; if(!data) return;
        const popup = document.getElementById('schedulePopup');
        const content = document.getElementById('popupContent');



        content.innerHTML = `
            <div class="space-y-4">
                <div class="bg-indigo-50 p-4 rounded-2xl border border-slate-100">
                    <p class="text-[9px] font-black text-slate-400 uppercase mb-1">Nama Penyewa / Instansi</p>
                    <p class="text-sm font-black text-slate-800">${data.name}</p>
                </div>
                <div class="bg-indigo-50 p-4 rounded-2xl border border-slate-100">
                    <p class="text-[9px] font-black text-slate-400 uppercase mb-1">Lokasi Acara</p>
                    <p class="text-xs font-bold text-slate-700 leading-relaxed">${data.address}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-indigo-50 p-4 rounded-2xl border border-indigo-100">
                    <p class="text-[9px] font-black text-indigo-400 uppercase mb-1">Kategori Barang</p>
                    <p class="text-sm font-black text-indigo-800">${data.category}</p>
                </div>
                <div class="bg-indigo-50 p-4 rounded-2xl border border-slate-100">
                    <p class="text-[9px] font-black text-slate-400 uppercase mb-1">Waktu Pelaksanaan</p>
                    <p class="text-sm font-black text-indigo-600">${data.time}</p>
                </div>
            </div>
        `;
        popup.classList.remove('hidden');
    }

    function closePopup() {
        document.getElementById('schedulePopup').classList.add('hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") closePopup();
    });

    // --- 3. CHART LOGIC ---
    let salesChart;
    const chartData = {
        mingguan: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [
                { label: 'Screen', data: [12, 19, 15, 8, 22, 30, 25], borderColor: '#a855f7', fill: true, tension: 0.4 },
                { label: 'Proyektor', data: [25, 20, 30, 22, 40, 45, 50], borderColor: '#3b82f6', fill: true, tension: 0.4 },
                { label: 'TV', data: [15, 10, 18, 12, 20, 25, 22], borderColor: '#10b981', fill: true, tension: 0.4 },
                { label: 'Kabel', data: [5, 8, 4, 10, 6, 12, 15], borderColor: '#f59e0b', fill: true, tension: 0.4 }
            ]
        },
        tahunan: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [
                { label: 'Screen', data: [120, 150, 180, 140, 200, 250], borderColor: '#a855f7', fill: true, tension: 0.4 },
                { label: 'Proyektor', data: [200, 250, 220, 300, 400, 450], borderColor: '#3b82f6', fill: true, tension: 0.4 }
            ]
        }
    };

    function initChart() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        salesChart = new Chart(ctx, {
            type: 'line',
            data: chartData.mingguan,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true }, x: { grid: { display: false } } }
            }
        });
    }

    function updateChartRange(range) {
        salesChart.data = chartData[range];
        salesChart.update();
        const isM = range === 'mingguan';
        document.getElementById('btnMingguan').className = isM ? 'px-4 py-1.5 rounded-lg text-[10px] font-black uppercase transition-all bg-white shadow-sm text-indigo-600' : 'px-4 py-1.5 rounded-lg text-[10px] font-black uppercase transition-all text-slate-400 hover:text-slate-600';
        document.getElementById('btnTahunan').className = !isM ? 'px-4 py-1.5 rounded-lg text-[10px] font-black uppercase transition-all bg-white shadow-sm text-indigo-600' : 'px-4 py-1.5 rounded-lg text-[10px] font-black uppercase transition-all text-slate-400 hover:text-slate-600';
    }

    // --- 4. WA & AI DISCOUNT & RESTOCK TOOLS ---
    function toggleWAForm() { document.getElementById('waFormCard').classList.toggle('hidden'); }

    function updateWATemplate() {
        const templates = { pengingat: "Halo, ini pengingat sewa besok...", pengembalian: "Halo, ini pengingat pengembalian besok..." };
        document.getElementById('waText').value = templates[document.getElementById('waType').value] || "";
    }

    function sendToWhatsApp() {
        let num = document.getElementById('waNumber').value;
        let text = document.getElementById('waText').value;
        if(!num) return alert("Isi nomor!");
        window.open(`https://api.whatsapp.com/send?phone=62${num}&text=${encodeURIComponent(text)}`, '_blank');
    }

    function openAIDiscountForm() { document.getElementById('aiDiscountModal').classList.remove('hidden'); }
    function closeAIDiscountForm() { document.getElementById('aiDiscountModal').classList.add('hidden'); }

    function calculateDiscount() {
        const input = document.getElementById('discountInput');
        const finalPriceEl = document.getElementById('finalPrice');
        const saveAmountEl = document.getElementById('saveAmount');
        let percent = parseFloat(input.value) || 0;

        if(percent > 100) percent = 100;
        if(percent < 0) percent = 0;

        const discountValue = (percent / 100) * basePrice;
        const total = basePrice - discountValue;

        finalPriceEl.innerText = "Rp " + total.toLocaleString('id-ID');
        saveAmountEl.innerText = "Hemat Rp " + discountValue.toLocaleString('id-ID');
    }

    function applyDiscount() {
        const start = document.getElementById('promoStart').value;
        const end = document.getElementById('promoEnd').value;
        const disc = document.getElementById('discountInput').value;
        if(!start || !end || !disc) return alert("Lengkapi semua data!");
        alert(`Strategi Diskon AI ${disc}% Berhasil Diterapkan!`);
        closeAIDiscountForm();
    }

    function openAIRestockModal() { document.getElementById('aiRestockModal').classList.remove('hidden'); }
    function closeAIRestockModal() { document.getElementById('aiRestockModal').classList.add('hidden'); }
    function confirmRestock() { alert("Berhasil dimasukkan ke daftar pengadaan!"); closeAIRestockModal(); }

    // --- 5. INITIALIZE (Hanya satu window.onload agar tidak bentrok) ---
    window.onload = () => {
        generateCalendar(currentMonth, currentYear);
        initChart();
    };
</script>
@endsection
