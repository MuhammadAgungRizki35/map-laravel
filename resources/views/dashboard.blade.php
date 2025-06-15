@extends('layouts.navbar')

@section('content')
<div class="container-fluid mt-4 ms-3">
    <h3 class="h5 pt-2">PRODUK</h3>
    <div class="row">
        @foreach($images as $image)
        <div class="col-6 col-md-3 mb-4">
           <div class="catalog-item" onclick="showProductModal('{{ asset('storage/'.$image->image_path) }}', '{{ $image->description }}', 'Rp 14.000,00')"
     style="cursor: pointer; background-color: #fff; padding: 12px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.15); transition: transform 0.2s ease-in-out;">
    <img src="{{ asset('storage/'.$image->image_path) }}"
        class="w-100" style="height: 180px; object-fit: cover; border-radius: 10px;">

   @php
    $words = explode(' ', strip_tags($image->description));
    $shortDescription = implode(' ', array_slice($words, 0, 7)) . (count($words) > 7 ? '...' : '');
@endphp
<div class="mt-2 text-start" style="color: #000000; font-size: 13px;">
    {{ $shortDescription }}
</div>


   <div class="mt-1 fw-bold text-dark" style="font-size: 14px;">
    Rp 14.000,00
</div>


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
        document.getElementById('modalDescription').innerHTML = description.replace(/ - /g, '<br>');
        document.getElementById('modalPrice').innerText = price;
        var productModal = new bootstrap.Modal(document.getElementById('productModal'));
        productModal.show();
    }
</script>
@endsection
