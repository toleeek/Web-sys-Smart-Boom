@extends('layout.admin', ['title' => 'Перегляд замовлення'])

@section('content')
    <h1>Інформація по замовленню № {{ $order->id }}</h1>

    <p>
        Статус замовлення:
        @if ($order->status == 0)
            <span class="text-danger">{{ $statuses[$order->status] }}</span>
        @elseif (in_array($order->status, [1,2,3]))
            <span class="text-success">{{ $statuses[$order->status] }}</span>
        @else
            {{ $statuses[$order->status] }}
        @endif
    </p>

    <h3 class="mb-3">Зміст замовлення</h3>
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

    <h3 class="mb-3">Данні покупця</h3>
    <p>Імя, Прізвище: {{ $order->name }}</p>
    <p>Адреса пошти: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p>Номер телефону: {{ $order->phone }}</p>
    <p>Адреса доставки: {{ $order->address }}</p>
    @isset ($order->comment)
        <p>Коментар: {{ $order->comment }}</p>
    @endisset
@endsection

