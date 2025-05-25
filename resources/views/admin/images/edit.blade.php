@extends('layouts.admin.navbar')

@section('content')
<div class="container">
    <h3>Edit Gambar</h3>
    <form action="{{ route('admin.images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control">
            <br>
            <img src="{{ asset('storage/' . $image->image_path) }}" width="100" alt="Gambar">
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description', $image->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
