<div class="col-md-3 mb-3">
    <div class="card list-item">
        <div class="card-header" style="background-color: black; color: white; border-top-left-radius: 7px; border-top-right-radius: 7px">

            <h3 class="mb-0">{{ $product->name }}</h3>
        </div>
        <div class="card-body p-0 position-relative">
            <div class="position-absolute text-center">
                @if($product->new)
                    <span class="badge badge-info text-white ml-1">Новинка</span>
                @endif
                @if($product->hit)
                    <span class="badge badge-danger ml-1">Лідер продаж</span>
                @endif
                @if($product->sale)
                    <span class="badge badge-success ml-1">Розпродаж</span>
                @endif
            </div>

            @if ($product->image)
                @php($url = url('storage/catalog/product/thumb/' . $product->image))
                <a href="{{ route('catalog.product', ['product' => $product->slug]) }}">
                   <img src="{{ $url }}" class="img-fluid" alt="">
                </a>
            @else
                <a href="{{ route('catalog.product', ['product' => $product->slug]) }}">
                    <img src="https://via.placeholder.com/300x150" class="img-fluid" alt="">
                </a>
            @endif



            <div class="card-header d-flex flex-row-reverse" style="background-color: black; color: white; border-bottom-left-radius: 7px; border-bottom-right-radius: 7px">
                <h3 style="font-size: 30px">{{ $product->price }} грн.</h3>



            </div>

        </div>

    </div>
</div>
