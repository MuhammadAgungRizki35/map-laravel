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
        <div class="alert alert-dark">
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
                            <li><strong>Total Harga:</strong> Rp {{ number_format(($order->jumlah_pcs * ([0 => 14000, 4 => 16500, 6 => 18000, 8 => 19500, 10 => 21000, 12 => 22500, 14 => 24000, 16 => 25500, 18 => 27000, 20 => 28500, 22 => 30000, 24 => 31500, 26 => 33000, 28 => 34500, 30 => 36000][$order->jumlah_plastik] ?? 0)), 2, ',', '.') }}</li>
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
            @foreach ($notifications as $notif)
                <tr>
                    <td>{{ $notif->title }}</td>
                    <td>{{ $notif->message }}</td>
                    <td>
                        <a href="{{ route('admin.notif.show', $notif->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('admin.notif.edit', $notif->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('admin.notif.destroy', $notif->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus notifikasi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
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
            let jumlahIsi = parseInt(document.getElementById("jumlah_plastik").value) || 0;
            let jumlahPcs = parseInt(document.getElementById("jumlah_pcs").value) || 0;
            let hargaPerPlastik = hargaList[jumlahIsi] || 0;
            let totalHarga = hargaPerPlastik * jumlahPcs;
            document.getElementById("total_harga").value = formatRupiah(totalHarga);
        }

        document.getElementById("jumlah_plastik").addEventListener("change", hitungTotal);
        document.getElementById("jumlah_pcs").addEventListener("input", hitungTotal);
    });
</script>


@endsection