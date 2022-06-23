@extends('layout.admin', ['title' => 'Редагування категорії'])

@section('content')
    <h1>Редагування категорії</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.category.update', ['category' => $category->id]) }}">
        @method('PUT')
        @include('admin.category.part.form')
    </form>
@endsection
