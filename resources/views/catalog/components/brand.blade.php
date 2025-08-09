<div class="col-md-4 mb-4">
    <div class="card list-item">
        <div class="card-header px-1">
            <h3 class="mb-0">{{ $brand->name }}</h3>
        </div>
        <div class="card-body p-0">
            <img src="{{ asset('Storage/' . $brand->get_img()) }}" alt="{{ $brand->name }}" class="mx-auto d-block" style='max-height: 120px; max-weight: 400px'>
        </div>
        <div class="card-footer px-1">
            <a href="{{ route('catalog.brand', $brand->slug) }}"
               class="btn btn-dark">Товары бренда</a>
        </div>
    </div>
</div>