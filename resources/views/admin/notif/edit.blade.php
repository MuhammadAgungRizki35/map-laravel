<!-- @extends('layouts.admin.navbar')

@section('content')
    <h2>Edit Notifikasi</h2>
    
    <form action="{{ route('admin.notif.update', $notif->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $notif->title }}" required>
        </div>
        <div class="form-group">
            <label>Pesan</label>
            <textarea name="message" class="form-control" required>{{ $notif->message }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection -->
