@extends('layouts.navbar')

@section('content')
<div class="container-fluid mt-4 ms-3">
    <h3 class="h5 pt-2">PRODUK</h3>
    <div class="row">
        @foreach($images as $image)
        <div class="col-md-3 mb-2">
            <div class="catalog-item text-center" onclick="showProductModal('{{ asset('storage/'.$image->image_path) }}', '{{ $image->description }}', 'Rp{{ number_format($image->price,0,',','.') }}')"
     style="cursor: pointer; background-color: #ffffff; padding: 10px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);">

    <img src="{{ asset('storage/'.$image->image_path) }}"
        style="width: 65%; height: 390px; object-fit: cover; border-radius: 5px;">

    <p class="mt-2 font-weight-bold" style="color: #000000;">{{ $image->description }}</p>
    <p class="text-muted">Harga: Rp{{ number_format($image->price,0,',','.') }}</p>
    {{-- <a href="#" class="btn btn-secondary btn-sm">Lihat</a> --}}
</div>


        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"style="background-color: #ffffff; color:#333">
                <h5 class="modal-title" id="productModalLabel">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" style="background-color: #ffffff; color:#333" >
                <img id="modalImage" src="" style="width: 25%; height: auto; object-fit: cover;">
                <h5 id="modalDescription" class="mt-3"></h5>
                <p id="modalPrice" class="text-muted"></p>
            </div>
            <div class="modal-footer"style="background-color: #ffffff; color:#333">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <a href="{{ route('account.memesan.index') }}" class="btn btn-primary">Pesan</a>
            </div>
        </div>
    </div>
</div>

<script>
    function showProductModal(image, description, price) {
        document.getElementById('modalImage').src = image;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('modalPrice').innerText = price;
        var productModal = new bootstrap.Modal(document.getElementById('productModal'));
        productModal.show();
    }
</script>
@endsection
