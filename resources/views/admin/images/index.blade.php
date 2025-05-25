@extends('layouts.admin.navbar')

@section('content')
<div class="container shadow p-3 mb-5 bg-body rounded">
    <a href="{{ route('admin.images.create') }}" class="btn btn-dark mb-3">Tambah Gambar</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $key => $image)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                    <img src="{{ asset('storage/' . $image->image_path) }}" width="100" alt="Gambar">

                </td>
                <td>{{ $image->description }}</td>
                <td>
                    <a href="{{ route('admin.images.show', $image->id) }}" class="btn btn-dark">Lihat</a>
                    <a href="{{ route('admin.images.edit', $image->id) }}" class="btn btn-dark">Edit</a>
                    <form action="{{ route('admin.images.destroy', $image->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-dark" onclick="return confirm('Hapus gambar ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
