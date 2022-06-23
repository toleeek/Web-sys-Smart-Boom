@extends('layout.admin')

@section('content')
    <h1>Панель керування</h1>
    <p>Привіт, {{ auth()->user()->name }}</p>
    <p>Тут ви зможете керувати інтернет магазином.</p>
    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Вийти</button>
    </form>
@endsection
