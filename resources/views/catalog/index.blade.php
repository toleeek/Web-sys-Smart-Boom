@extends('layout.site', ['title' => 'Каталог товаров'])

@section('content')
    <h1>Каталог товарів</h1>

    <p>В данному каталозі представленні всі товари їх категорії та бренди магазину <b>Smart BOOM</b></p>

    <h2 class="mb-4">Розділи каталога</h2>
    <div class="row">
        @foreach ($roots as $root)
            @include('catalog.part.category', ['category' => $root])
        @endforeach
    </div>

    <h2 class="mb-4">Популярні бренди</h2>
    <div class="row">
        @foreach ($brands as $brand)
            @include('catalog.part.brand', ['brand' => $brand])
        @endforeach
    </div>
@endsection


