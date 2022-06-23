@extends('layout.site')

@section('content')
    <div class="px-5">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('img/baner1.jpg')}}" alt="Banner1">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/baner2.jpg')}}" alt="Banner2">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/baner3.jpg')}}" alt="Banner3">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/baner4.jpg')}}" alt="Banner4">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/baner5.jpg')}}" alt="Banner5">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    @if($new->count())
        <h2 class="mt-3">Новинки</h2>
        <div class="row">
        @foreach($new as $item)
            @include('catalog.part.product', ['product' => $item])
        @endforeach
        </div>
    @endif

    @if($hit->count())
        <h2 class="mt-3">Лідери продаж</h2>
        <div class="row">
            @foreach($hit as $item)
                @include('catalog.part.product', ['product' => $item])
            @endforeach
        </div>
    @endif

    @if($sale->count())
        <h2 class="mt-3">Розпродаж</h2>
        <div class="row">
            @foreach($sale as $item)
                @include('catalog.part.product', ['product' => $item])
            @endforeach
        </div>
    @endif
    </div>
@endsection
