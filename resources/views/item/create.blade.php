@extends('layout.site', ['title' => 'Створення нового елемента'])

@section('content')
    <h1>Створення нового елемента</h1>
    <form method="post" action="{{ route('item.store') }}">
        @csrf
        @include('item.part.form')
    </form>
@endsection
