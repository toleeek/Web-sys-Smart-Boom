@extends('layout.site', ['title' => 'Замовлення оформлене!'])

@section('content')
    <h1>Замовлення оформлене!</h1>

    <p>Ваше замовлення успішно оформлений. Наш менеджер скоро звяжеться з вами для уточнення деталей.</p>

    <h2>Ваше замовлення</h2>
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

    <h2>Ваші данні</h2>
    <p>Імя, Прізвище: {{ $order->name }}</p>
    <p>Адреса пошти: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p>Номер телефону: {{ $order->phone }}</p>
    <p>Адреса доставки: {{ $order->address }}</p>
    @isset ($order->comment)
        <p>Коментар: {{ $order->comment }}</p>
    @endisset
@endsection
