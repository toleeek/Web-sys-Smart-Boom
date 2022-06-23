@extends('layout.admin', ['title' => 'Редагування бренда'])

@section('content')
    <h1>Редагування бренда</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.brand.update', ['brand' => $brand->id]) }}">
        @method('PUT')
        @include('admin.brand.part.form')
    </form>
@endsection

