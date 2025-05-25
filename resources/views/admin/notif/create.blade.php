<!-- @extends('layouts.admin.navbar')

@section('content')
    <h2>Tambah Notifikasi</h2>
    
    <form action="{{ route('admin.notif.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Pesan</label>
            <textarea name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection -->
