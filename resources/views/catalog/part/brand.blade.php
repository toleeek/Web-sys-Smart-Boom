<div class="col-md-2 mb-3">
    <div class="card list-item" style="background-color: black; color: white; border-top-left-radius: 7px; border-top-right-radius: 7px">
        <div class="card-header">
            <h3 class="mb-0">{{ $brand->name }}</h3>
        </div>
        <div class="card-body p-0 text-center">
            @if ($brand->image)
                @php($url = url('storage/catalog/brand/thumb/' . $brand->image))
                <a href="{{ route('catalog.brand', ['brand' => $brand->slug]) }}">
                    <img src="{{ $url }}" class="img-fluid" alt="">
                </a>
            @else
                <a href="{{ route('catalog.brand', ['brand' => $brand->slug]) }}">
                    <img src="https://via.placeholder.com/300x150" class="img-fluid" alt="">
                </a>
            @endif
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('catalog.brand', ['brand' => $brand->slug]) }}"
               class="btn btn-light">Товари бренда</a>
        </div>
    </div>
</div>
