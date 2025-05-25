@extends('layouts.navbar')

@section('content')
<div class="container d-flex justify-content-center align-items-start min-vh-100 mt-5">

@php
    $showForm = !$orders->count(); // Tampilkan form jika belum ada pemesanan
@endphp

@if($showForm)
    {{-- FORM PEMESANAN --}}
    <form action="{{ route('account.memesan.store') }}" method="POST" enctype="multipart/form-data" id="orderForm" class="mt-5 w-100">
        @csrf

        <div class="mb-3">
            <label for="jumlah_plastik" class="form-label">Paket Isi Plastik</label>
            <div class="custom-dropdown">
                <select id="jumlah_plastik" name="jumlah_plastik" class="form-control custom-select" required>
                    @foreach ($hargaList as $lembar => $harga)
                        <option value="{{ $lembar }}">{{ $lembar }} lembar - Rp {{ number_format($harga, 0, ',', '.') }}</option>
                    @endforeach
                </select>
                <span class="dropdown-icon">&#9662;</span>
            </div>
        </div>

        <div class="mb-3">
            <label for="jumlah_pcs" class="form-label">Jumlah PCS</label>
            <input type="number" class="form-control" id="jumlah_pcs" name="jumlah_pcs" required>
        </div>

        <div class="mb-3 w-50">
            <label for="total_harga" class="form-label">Total Harga</label>
            <input type="text" class="form-control" id="total_harga" name="total_harga_display" readonly>
            <input type="hidden" id="total_harga_hidden" name="total_harga">
        </div>

        <div class="mb-3">
            <label for="file_pdf" class="form-label">Unggah File PDF</label>
            <input type="file" class="form-control" id="file_pdf" name="file_pdf" accept="application/pdf" required>
        </div>

        <button type="submit" class="btn btn-success" id="pesanButton">Pesan</button>
    </form>
@else
    {{-- STRUK PEMESANAN TERAKHIR --}}
    <div class="card w-65 shadow">
        <div class="card-body">

            {{-- 🔢 1: Judul dan Info Pengguna --}}
          <h4 class="text-center text-white"><strong>{{ Auth::user()->name }}</strong></h4>
<p class="text-center text-white">Email: {{ Auth::user()->email }}</p>



            {{-- 🔢 1.1: Tanggal Pemesanan --}}

            {{-- 🔢 2: Alert Sukses --}}
            @if(session('success'))
                <div class="alert alert-success w-75 text-center shadow mb-4 mx-auto">
                    {{ session('success') }}
                </div>
            @endif

            {{-- 🔢 3: Struk Pemesanan --}}
            @php
                $order = $orders->last(); // ambil order terakhir
                $hargaPerPlastik = $hargaList[$order->jumlah_plastik] ?? 0;
                $totalHarga = $hargaPerPlastik * $order->jumlah_pcs;
            @endphp

           <div class="receipt-wrapper d-flex justify-content-center mt-4">
    <div class="receipt-container bg-white p-3">
        <pre class="receipt-text text-center">
==============================
       TOKO PLASTIK ABC
  Jl. Contoh No. 123, Jakarta
  Telp: 0812-XXXX-XXXX
==============================
Nama   : {{ Auth::user()->name }}
Email  : {{ Auth::user()->email }}
------------------------------
Item         : Rapot/Ijazah
Jumlah PCS   : {{ $order->jumlah_pcs }}
Isi Plastik  : {{ $order->jumlah_plastik }} lembar
Harga Satuan : Rp {{ number_format($hargaPerPlastik, 0, ',', '.') }}
------------------------------
Total Harga  : Rp {{ number_format($totalHarga, 0, ',', '.') }}
Tgl Order    : {{ $order->created_at->format('d-m-Y H:i') }}
==============================
   TERIMA KASIH ATAS PESANAN ANDA
        </pre>
    </div>
</div>



            {{-- 🔢 4: Tombol --}}
            <div class="mt-4 d-flex justify-content-center gap-3">
                <a href="{{ route('account.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
@endif

</div>

{{-- CSS Dropdown --}}
<style>


.card{
    --bs-card-bg: rgba(255, 255, 255, 0.15);
}


    .custom-dropdown {
        position: relative;
        width: 100%;
        max-width: 350px;
    }

    .custom-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
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
        width: 360px;
        border: 1px dashed #333;
        font-family: 'Courier New', Courier, monospace;
        font-size: 14px;
    }

    .receipt-text {
        white-space: pre-wrap;
        margin: 0;
    }

        .receipt-wrapper {
        width: 100%;
    }

    .receipt-container {
        width: 280px; /* sesuai ukuran struk biasa */
        border: 1px dashed #333;
        font-family: 'Courier New', Courier, monospace;
        font-size: 13px;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    .receipt-text {
        white-space: pre-wrap;
        margin: 0;
    }


    .btn-secondary {
        --bs-btn-bg: rgb(0 0 0 / 37%);
        --bs-btn-hover-bg: rgba(31, 38, 135, 0.37);
    }


</style>

{{-- Script Harga Otomatis --}}
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
</script>
@endsection
