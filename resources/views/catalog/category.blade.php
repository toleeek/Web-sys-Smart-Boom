@extends('layout.site', ['title' => $category->name])

@section('content')
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->content }}</p>
    <div class="row text-center">
        @foreach ($category->children as $child)
            @include('catalog.part.category', ['category' => $child])
        @endforeach
    </div>
    <div class="p-2 mb-4" style="background-color: black; color: white">

        <form method="get"
              action="{{ route('catalog.category', ['category' => $category->slug]) }}">
            @include('catalog.part.filter')
            <a href="{{ route('catalog.category', ['category' => $category->slug]) }}"
               class="btn btn-light">Скинути</a>
        </form>
    </div>
    <div class="row">
        @foreach ($products as $product)
            @include('catalog.part.product', ['product' => $product])
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
