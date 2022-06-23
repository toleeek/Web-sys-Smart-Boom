@extends('layout.admin', ['title' => 'Створення категорії'])

@section('content')
    <h1>Створення нової категорії</h1>
    <form method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.category.part.form')
    </form>
@endsection
