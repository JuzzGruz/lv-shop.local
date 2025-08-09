<div class="col-md-6 mb-4">
    <div class="card">
        <div class="card-header">
            <h4>{{ $product->name }}</h4>
        </div>
        <div class="card-body p-0">
            @if (isset($top))
                <div class="position-absolute">
                    <span class="badge badge-danger ml-1">Лидер продаж</span>
                </div>
            @elseif (isset($new))
                <div class="position-absolute">
                    <span class="badge badge-success ml-1">Новинка</span>
                </div>
            @endif
            <img src="{{ asset('Storage/' . $product->get_img()) }}" alt="{{ $product->name }}" class="mx-auto d-block" style='max-height: 120px; max-weight: 400px'>
        </div>
        <div class="card-footer">
            <form action="{{ route('basket.add', $product->id) }}" 
                method="post" class="d-inline add-to-basket">
              @csrf
              @if ($product->amount > 0)
                <button type="submit" class="btn btn-success">Добавить в корзину</button>
              @else
                <button type="submit" disabled class="btn btn-danger">Нет в наличии</button>
              @endif
            </form>
            <a href="{{ route('catalog.product', $product->slug) }}"
               class="btn btn-dark float-right">Перейти к товару</a>
        </div>
    </div>
</div>
