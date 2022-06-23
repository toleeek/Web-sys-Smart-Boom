@extends('layout.site', ['title' => 'Поиск по каталогу'])

@section('content')
    <h1>Пошук по каталогу</h1>
    <p>Що шукаємо?: {{ $search ?? 'пусто' }}</p>
    @if (count($products))
        <div class="row">
            @foreach ($products as $product)
                @include('catalog.part.product', ['product' => $product])
            @endforeach
        </div>
        {{ $products->links() }}
    @else
        <p>По вашому запиту нічого не знайдено(((</p>
    @endif
@endsection
