@extends('layout.site', ['title' => 'Просмотр заказа'])

@section('content')
    <h1>Інформація по замовленню № {{ $order->id }}</h1>

    <p>Статус замовлення: {{ $statuses[$order->status] }}</p>

    <h3 class="mb-3">Склад замовлення</h3>
    <table class="table table-bordered">
        <tr>
            <th>№</th>
            <th>Назва</th>
            <th>Ціна</th>
            <th>К-сть</th>
            <th>Вартість</th>
        </tr>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ number_format($item->price, 2, '.', '') }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->cost, 2, '.', '') }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="4" class="text-right">Всього</th>
            <th>{{ number_format($order->amount, 2, '.', '') }}</th>
        </tr>
    </table>

    <h3 class="mb-3">Інформація покупця</h3>
    <p>Імя, Прізвище: {{ $order->name }}</p>
    <p>Адреса пошти: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p>Номер телефона: {{ $order->phone }}</p>
    <p>Адреса доставки: {{ $order->address }}</p>
    @isset ($order->comment)
        <p>Коментар: {{ $order->comment }}</p>
    @endisset
@endsection


