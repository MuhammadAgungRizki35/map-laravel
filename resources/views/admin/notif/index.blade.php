@extends('layouts.admin.navbar')

@section('content')
<div class="container">
    <h2>Daftar Notifikasi</h2>

    {{-- Menampilkan pesan sukses jika ada --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Menampilkan semua pengguna yang telah melakukan pemesanan --}}
    @if($orders->isNotEmpty())
        <div class="alert alert-secondary">
            <h5>Daftar Pengguna yang Telah Melakukan Pemesanan:</h5>
            @foreach($orders as $order)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $order->user->name }}</h5>
                        <p class="card-text"><strong>Email:</strong> {{ $order->user->email }}</p>
                        <h6>Detail Pemesanan:</h6>
                        <ul>
                            <li><strong>Jumlah PCS:</strong> {{ $order->jumlah_pcs }}</li>
                            <li><strong>Jumlah Plastik:</strong> {{ $order->jumlah_plastik }}</li>
                            <li><strong>Total Harga:</strong>
                                Rp {{ number_format(($order->jumlah_pcs * ([0 => 14000, 4 => 16500, 6 => 18000, 8 => 19500, 10 => 21000, 12 => 22500, 14 => 24000, 16 => 25500, 18 => 27000, 20 => 28500, 22 => 30000, 24 => 31500, 26 => 33000, 28 => 34500, 30 => 36000][$order->jumlah_plastik] ?? 0)), 2, ',', '.') }}
                            </li>
                            @if($order->file_word)
                                <li><strong>File:</strong>
                                    <a href="{{ asset('storage/' . $order->file_word) }}" target="_blank" class="btn btn-sm btn-dark">
                                        Lihat File Word
                                    </a>
                                </li>
                            @else
                                <li><strong>File:</strong> Tidak ada file diunggah</li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Belum ada pemesanan yang dilakukan.</div>
    @endif

    {{-- Tabel Notifikasi --}}
    <table class="table table-striped">
        <tbody>
            @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $order->user->name }}</h5>
                    <p class="card-text"><strong>Email:</strong> {{ $order->user->email }}</p>
                    <h6>Detail Pemesanan:</h6>
                    <ul>
                        <li><strong>Jumlah PCS:</strong> {{ $order->jumlah_pcs }}</li>
                        <li><strong>Jumlah Plastik:</strong> {{ $order->jumlah_plastik }}</li>
                        <li><strong>Total Harga:</strong>
                            Rp {{ number_format(($order->jumlah_pcs * ([0 => 14000, 4 => 16500, 6 => 18000, 8 => 19500, 10 => 21000, 12 => 22500, 14 => 24000, 16 => 25500, 18 => 27000, 20 => 28500, 22 => 30000, 24 => 31500, 26 => 33000, 28 => 34500, 30 => 36000][$order->jumlah_plastik] ?? 0)), 2, ',', '.') }}
                        </li>
                        @if($order->file_word)
                            <li><strong>File:</strong>
                                <a href="{{ asset('storage/' . $order->file_word) }}" target="_blank" class="btn btn-sm btn-dark">
                                    Lihat File Word
                                </a>
                            </li>
                        @else
                            <li><strong>File:</strong> Tidak ada file diunggah</li>
                        @endif
                    </ul>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

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
            let jumlahIsi = parseInt(document.getElementById("jumlah_plastik")?.value || 0);
            let jumlahPcs = parseInt(document.getElementById("jumlah_pcs")?.value || 0);
            let hargaPerPlastik = hargaList[jumlahIsi] || 0;
            let totalHarga = hargaPerPlastik * jumlahPcs;
            if (document.getElementById("total_harga")) {
                document.getElementById("total_harga").value = formatRupiah(totalHarga);
            }
        }

        if (document.getElementById("jumlah_plastik")) {
            document.getElementById("jumlah_plastik").addEventListener("change", hitungTotal);
        }

        if (document.getElementById("jumlah_pcs")) {
            document.getElementById("jumlah_pcs").addEventListener("input", hitungTotal);
        }
    });
</script>
@endsection
