@extends('layout.admin', ['title' => 'Створення сторінки'])

@section('content')
    <h1>Створення сторінки</h1>
    <form method="post" action="{{ route('admin.page.store') }}">
        @include('admin.page.part.form')
    </form>
@endsection
