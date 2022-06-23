@extends('layout.admin', ['title' => 'Редагування товара'])

@section('content')
    <h1>Редагування товара</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.product.update', ['product' => $product->id]) }}">
        @method('PUT')
        @include('admin.product.part.form')
    </form>
@endsection
