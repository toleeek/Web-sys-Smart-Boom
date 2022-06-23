@extends('layout.site', ['title' => 'Ваши заказы'])

@section('content')
    <h1>Ваші замовлення</h1>
    @if($orders->count())
        <table class="table table-bordered">
        <tr>
            <th width="2%">№</th>
            <th width="19%">Дата та час</th>
            <th width="12%">Статус</th>
            <th width="19%">Покупець</th>
            <th width="24%">Адреса пошти</th>
            <th width="22%">Номер телефона</th>
            <th width="2%"><i class="fas fa-eye"></i></th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ $statuses[$order->status] }}</td>
                <td>{{ $order->name }}</td>
                <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                <td>{{ $order->phone }}</td>
                <td>
                    <a href="{{ route('user.order.show', ['order' => $order->id]) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </table>
        {{ $orders->links() }}
    @else
        <p>Замовлень поки немає</p>
    @endif
@endsection
