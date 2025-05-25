@extends('layouts.admin.navbar')

@section('content')
<div class="container">
    <h3>Detail Gambar</h3>
    <img src="{{ asset('storage/' . $image->image_path) }}" width="100" alt="Gambar">
    <p><strong>Deskripsi:</strong> {{ $image->description }}</p>
    <a href="{{ route('admin.images.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
