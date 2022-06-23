@extends('layout.admin', ['title' => 'Створення нового бренда'])

@section('content')
    <h1>Створення нового бренда</h1>
    <form method="post" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.brand.part.form')
    </form>
@endsection
