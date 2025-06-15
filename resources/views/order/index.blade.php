@extends('layouts.navbar')

@section('content')
<div class="container d-flex justify-content-center align-items-start min-vh-100 mt-5">

@php
    $showReceipt = session('show_receipt', false);
    $showForm = !$showReceipt;
@endphp

@if($showForm)
    {{-- FORM PEMESANAN --}}
    <div class="row w-100">
    {{-- FORM PEMESANAN --}}
    <div class="col-md-6">
        <form action="{{ route('account.memesan.store') }}" method="POST" enctype="multipart/form-data" id="orderForm" class="mt-5 w-100">
            @csrf

            <div class="mb-3">
                <label for="jumlah_plastik" class="form-label">Paket Isi Plastik</label>
                <div class="custom-dropdown">
                    <select id="jumlah_plastik" name="jumlah_plastik" class="form-control custom-select" required>
                        @php $paket = 1; @endphp
                        @foreach ($hargaList as $lembar => $harga)
                            <option value="{{ $lembar }}">Paket {{ $paket++ }} - {{ $lembar }} lembar - Rp {{ number_format($harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    <span class="dropdown-icon">&#9662;</span>
                </div>
            </div>

            <div class="mb-3">
                <label for="jumlah_pcs" class="form-label">Jumlah PCS</label>
                <input type="number" class="form-control" id="jumlah_pcs" name="jumlah_pcs" required>
            </div>

            <div class="mb-3 w-75">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="text" class="form-control" id="total_harga" name="total_harga_display" readonly>
                <input type="hidden" id="total_harga_hidden" name="total_harga">
            </div>

           {{-- FILE UPLOAD --}}
<div class="mb-3">
    <label for="file_word" class="form-label">Unggah File Word</label>
    <input type="file" class="form-control" id="file_word" name="file_word" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
</div>


            <button type="submit" class="btn btn-success" id="pesanButton">Pesan</button>
        </form>
    </div>

    {{-- PREVIEW PDF --}}
  {{-- PREVIEW WORD --}}
<div class="col-md-6">
    <div class="word-preview-container border rounded p-2 shadow-sm text-center" style="height: 500px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <div id="word_preview_message">Belum ada file Word yang dipilih.</div>
        <a id="word_preview_link" href="#" target="_blank" class="btn btn-outline-primary mt-2" style="display: none;">Lihat di Tab Baru</a>
    </div>
</div>




@elseif($showReceipt)
    {{-- STRUK PEMESANAN --}}
    <div class="card w-75 shadow">
        <div class="card-body">

            <h3 class="text-center text-white"><strong>{{ Auth::user()->name }}</strong></h3>
            <p class="text-center text-white">Email: {{ Auth::user()->email }}</p>


            @if(session('success'))
                <div class="alert alert-success w-50 text-center shadow mb-3 mx-auto py-7 px-1 small">
                    {{ session('success') }}
                </div>
            @endif

            @php
    $order = $orders->last(); // Ambil order terakhir
    $hargaList = [
        0 => 14000, 4 => 16500, 6 => 18000, 8 => 19500,
        10 => 21000, 12 => 22500, 14 => 24000, 16 => 25500,
        18 => 27000, 20 => 28500, 22 => 30000, 24 => 31500,
        26 => 33000, 28 => 34500, 30 => 36000
    ];
    $hargaPerPlastik = $hargaList[$order->jumlah_plastik] ?? 0;
    $totalHarga = $hargaPerPlastik * $order->jumlah_pcs;

    $lembarKeys = array_keys($hargaList);
    $paketKe = array_search($order->jumlah_plastik, $lembarKeys) + 1;
@endphp


            <div class="receipt-wrapper d-flex justify-content-center mt-4">
                <div class="receipt-container bg-white p-3">
                    <pre class="receipt-text text-center">
                        {{-- <h2 class="text-center text-white mb-4">🧾</h2> --}}
==============================

<h3> <span class="bold">🧾 MAP PRINTING</span></h3>
  Jl. Contoh No. 123, Jakarta
  Telp: 0812-XXXX-XXXX
==============================
Nama   : {{ Auth::user()->name }}
Email  : {{ Auth::user()->email }}
------------------------------
Item         : Rapot/Ijazah
Jumlah PCS   : {{ $order->jumlah_pcs }}
Isi Plastik  : {{ $order->jumlah_plastik }} lembar
Paket        : Paket {{ $paketKe }}
Harga Satuan : Rp {{ number_format($hargaPerPlastik, 0, ',', '.') }}
------------------------------
Total Harga  : Rp {{ number_format($totalHarga, 0, ',', '.') }}
Tgl Order    : {{ $order->created_at->format('d-m-Y H:i') }}
==============================
   TERIMA KASIH ATAS PESANAN ANDA
                    </pre>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center gap-3">
                <a href="{{ route('account.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
@endif

</div>

{{-- CSS --}}
<style>
.card {
    --bs-card-bg: rgba(255, 255, 255, 0.15);
}
.custom-dropdown {
    position: relative;
    width: 100%;
    max-width: 350px;
}
.custom-select {
    appearance: none;
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ccc;
    border-radius: 25px;
    background-color: white;
    cursor: pointer;
    font-size: 16px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}
.custom-dropdown .dropdown-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 25px;
    pointer-events: none;
}
.receipt-container {
    width: 400px; /* dari 280 jadi 400 */
    border: 1px dashed #333;
    font-family: 'Courier New', Courier, monospace;
    font-size: 18px; /* dari 13px jadi 18px */
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
    padding: 20px; /* tambahkan padding yang lebih luas */
    line-height: 1.6; /* agar teks lebih mudah dibaca */
}

.receipt-text {
    white-space: pre-wrap;
    margin: 0;
    text-align: left; /* opsional: agar rata kiri seperti struk asli */
}

.btn-secondary {
    --bs-btn-bg: rgb(0 0 0 / 37%);
    --bs-btn-hover-bg: rgba(31, 38, 135, 0.37);
}


.receipt-text .bold {
    font-weight: bold;
}


</style>

{{-- Script untuk perhitungan otomatis --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const hargaList = {
            0: 14000, 4: 16500, 6: 18000,
            8: 19500, 10: 21000, 12: 22500,
            14: 24000, 16: 25500, 18: 27000,
            20: 28500, 22: 30000, 24: 31500,
            26: 33000, 28: 34500, 30: 36000
        };

        function formatRupiah(angka) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            }).format(angka);
        }

        function hitungTotal() {
            let jumlahIsi = parseInt(document.getElementById("jumlah_plastik").value) || 0;
            let jumlahPcs = parseInt(document.getElementById("jumlah_pcs").value) || 0;
            let hargaPerPlastik = hargaList[jumlahIsi] || 0;
            let totalHarga = hargaPerPlastik * jumlahPcs;

            document.getElementById("total_harga").value = formatRupiah(totalHarga);
            document.getElementById("total_harga_hidden").value = totalHarga;
        }

        document.getElementById("jumlah_plastik").addEventListener("change", hitungTotal);
        document.getElementById("jumlah_pcs").addEventListener("input", hitungTotal);
    });


    // Preview PDF
    // document.getElementById('file_pdf').addEventListener('change', function(event) {
    //     const file = event.target.files[0];
    //     const iframe = document.getElementById('pdf_preview');
    //     const placeholder = document.getElementById('pdf_placeholder');

    //     if (file && file.type === "application/pdf") {
    //         const fileURL = URL.createObjectURL(file);
    //         iframe.src = fileURL;
    //         iframe.style.display = "block";
    //         placeholder.style.display = "none";
    //     } else {
    //         iframe.src = "";
    //         iframe.style.display = "none";
    //         placeholder.style.display = "block";
    //     }
    // });


    document.getElementById('file_word').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const link = document.getElementById('word_preview_link');
    const message = document.getElementById('word_preview_message');

    if (file && (file.type === "application/msword" || file.type === "application/vnd.openxmlformats-officedocument.wordprocessingml.document")) {
        const fileURL = URL.createObjectURL(file);
        message.innerText = "File Word siap untuk dibuka.";
        link.href = fileURL;
        link.style.display = "inline-block";
    } else {
        message.innerText = "File tidak valid. Silakan unggah dokumen Word (.doc atau .docx).";
        link.style.display = "none";
        link.href = "#";
    }
});

</script>
@endsection
