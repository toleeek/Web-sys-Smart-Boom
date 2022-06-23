@extends('layout.site', ['title' => 'Особистий кабінет'])

@section('content')
    <h1>Особистий кабінет</h1>
    <p>Вітаємо вас, {{ auth()->user()->name }}!</p>
    <p>Це особистий кабінет постійного покупця ннашого інтернет магазину.</p>
    <ul>
        <li><a href="{{ route('user.profile.index') }}">Ваші профілі</a></li>
        <li><a href="{{ route('user.order.index') }}">Ваші замовлення</a></li>
    </ul>
    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">Вийти</button>
    </form>
@endsection
