<!DOCTYPE html>
<html>
<head>
    <title>AI Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 p-10">
    <!DOCTYPE html>
<html>
<head>
    <title>AI Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<div class="max-w-6xl mx-auto p-6">
<!-- BACK BUTTON -->
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">
            Dashboard
        </a>

        <span>/</span>

        <span class="text-slate-800 font-medium">AI System</span>
    </div>

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">AI System Dashboard</h1>
        <p class="text-sm text-slate-500">Monitoring rekomendasi promo & restock berbasis ML</p>
    </div>


    <!-- BUTTONS -->
    <div class="flex gap-3 mb-6">
        <button onclick="runAI()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
            Jalankan AI Promo
        </button>

        <button onclick="runAIBarang()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
            Jalankan AI Restock
        </button>
    </div>

    <!-- STATUS -->
    <p class="text-sm text-slate-500 mb-6">
        Status Promo: <span id="status">-</span> |
        Status Restock: <span id="statusBarang">-</span>
    </p>

    <!-- GRID DASHBOARD -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- ================= PROMO CARD ================= -->
        <div class="bg-white rounded-2xl shadow p-5 hover:shadow-lg transition">

            <h2 class="font-semibold text-slate-700 mb-4">📊 Promo AI</h2>

            <div class="space-y-3 text-sm">

                <div>
                    <p class="text-slate-400">Barang</p>
                    <p class="font-bold text-lg" id="barang">-</p>
                </div>

                <div>
                    <p class="text-slate-400">Rekomendasi</p>
                    <p class="font-bold text-indigo-600" id="rekomendasi">-</p>
                </div>

                <div>
                    <p class="text-slate-400">Harga Prediksi</p>
                    <p class="font-bold" id="harga">-</p>
                </div>

                <div>
                    <p class="text-slate-400">Alasan</p>
                    <p id="alasanDiskon">-</p>
                </div>

            </div>
        </div>

        <!-- ================= RESTOCK CARD ================= -->
        <div class="bg-white rounded-2xl shadow p-5 hover:shadow-lg transition">

            <h2 class="font-semibold text-slate-700 mb-4">📦 Restock AI</h2>

            <div class="space-y-3 text-sm">

                <div>
                    <p class="text-slate-400">Barang</p>
                    <p class="font-bold text-lg" id="barangRekom">-</p>
                </div>

                <div>
                    <p class="text-slate-400">Rekomendasi</p>
                    <p class="font-bold text-emerald-600" id="rekomBarang">-</p>
                </div>

                <div>
                    <p class="text-slate-400">Confidence</p>
                    <p id="confidenceBarang">-</p>
                </div>

                <div>
                    <p class="text-slate-400">Explanation</p>
                    <p id="explainBarang">-</p>
                </div>

            </div>
        </div>

    </div>

    <!-- SECOND ROW (METRICS) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-slate-400 text-sm">Final Score</p>
            <p class="text-xl font-bold" id="finalScore">-</p>
        </div>

        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-slate-400 text-sm">Demand Score</p>
            <p class="text-xl font-bold" id="demandScore">-</p>
        </div>

        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-slate-400 text-sm">Stock Pressure</p>
            <p class="text-xl font-bold" id="stockPressure">-</p>
        </div>

    </div>

</div>
    {{-- <h2 class="font-bold mb-3">AI Restock Recommendation</h2>

    <button onclick="runAIStock()" class="bg-emerald-600 text-white px-4 py-2 rounded-lg">
        Run AI Restock
    </button>

    <div class="mt-4 text-sm space-y-1">
        <p>Status: <span id="stockStatus">-</span></p>
        <p>Barang: <span id="stockBarang">-</span></p>
        <p>Stok: <span id="stok">-</span></p>
        <p>Rekomendasi: <span id="stockRekomendasi">-</span></p>
        <p>Tambah Unit: <span id="jumlahRestock">-</span></p>
        <p>Alasan: <span id="alasan">-</span></p>
    </div> --}}

</div>

<script>
function runAI() {
    document.getElementById('status').innerText = "Loading...";

    fetch('/api/ai/auto-discount')
        .then(res => {
            if (!res.ok) throw new Error(res.status);
            return res.json();
        })
        .then(data => {

            let badge = "";

            if (data.rekomendasi === "promo_besar") {
                badge = "🔥 Promo Besar";
            } else if (data.rekomendasi === "promo_ringan/promosi") {
                badge = "⚡ Promo Ringan";
            } else {
                badge = "📦 Normal";
            }

            document.getElementById('status').innerText = data.status;
            document.getElementById('barang').innerText = data.barang;
            document.getElementById('rekomendasi').innerText = badge;
            document.getElementById('harga').innerText =
                "Rp " + Number(data.harga_prediksi).toLocaleString('id-ID');
            document.getElementById('alasanDiskon').innerText = data.alasan;

        })
        .catch(err => {
            console.log(err);
            document.getElementById('status').innerText = "ERROR";
        });

}

function runAIBarang() {
    document.getElementById('statusBarang').innerText = "Loading...";

    fetch('/api/ai/rekomendasi-barang')
        .then(async (res) => {
            const text = await res.text();
            console.log("RAW:", text);

            let data;
            try {
                data = JSON.parse(text);
            } catch {
                throw new Error("Response bukan JSON");
            }

            if (!res.ok || data.status === "error") {
                throw new Error(data.message || "API error");
            }

            return data;
        })
        .then(data => {

            document.getElementById('statusBarang').innerText = data.status;

            document.getElementById('barangRekom').innerText =
                data.barang ?? "-";

            // 🔥 FIX INI
            let rekom = data.rekomendasi ?? data.rekomendasi_barang;

            let badge = "";

            if (rekom === "RESTOCK_TINGGI") {
                badge = "🔥 Restock Tinggi";
            } else if (rekom === "RESTOCK_SEDANG") {
                badge = "⚡ Restock Sedang";
            } else {
                badge = "📦 Tidak Perlu Restock";
            }

            document.getElementById('rekomBarang').innerText = badge;

            document.getElementById('confidenceBarang').innerText =
                Number(data.confidence ?? 0).toFixed(2);

            document.getElementById('explainBarang').innerText =
                data.explanation ?? "-";

            document.getElementById('finalScore').innerText =
                Number(data.final_score ?? 0).toFixed(2);

            document.getElementById('demandScore').innerText =
                Number(data.demand_score ?? 0).toFixed(2);

            document.getElementById('stockPressure').innerText =
                Number(data.stock_pressure ?? 0).toFixed(2);

        })
        .catch(err => {
            console.log("ERROR:", err);
            document.getElementById('statusBarang').innerText = "ERROR (FETCH)";
        });
}

// function runAIStock() {
//     let id = document.getElementById('barangSelect').value;

//     if (!id) {
//         alert("Pilih barang dulu");
//         return;
//     }

//     fetch(`/ai-test/restock/${id}`)
//         .then(res => res.json())
//         .then(data => {
//             document.getElementById('stockStatus').innerText = data.status;
//             document.getElementById('stockBarang').innerText = data.barang;
//             document.getElementById('stok').innerText = data.stok;
//             document.getElementById('stockRekomendasi').innerText = data.rekomendasi;
//             document.getElementById('jumlahRestock').innerText = data.jumlah_restock;
//             document.getElementById('alasan').innerText = data.alasan;
//         })
//         .catch(err => {
//             console.log(err);
//             alert("Error AI Restock");
//         });
// }
</script>

</body>
</html>
