<div class="col-md-6 mb-4">
    <div class="card">
        <div class="card-header">
            <h3>{{ $category->name }}</h3>
        </div>
        <div class="card-body p-0">
            <img src="{{ asset('Storage/' . $category->get_img()) }}" alt="{{ $category->name }}" class="mx-auto d-block" style='max-height: 120px; max-weight: 400px'>
        </div>
        <div class="card-footer">
            <a href="{{ route('catalog.category', $category->slug) }}"
               class="btn btn-dark">Перейти в раздел</a>
        </div>
    </div>
</div>
