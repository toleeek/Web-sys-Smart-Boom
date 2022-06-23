@extends('layout.site', ['title' => 'Редагування елемента'])

@section('content')
    <h1>Редагування елемента</h1>
    <form method="post" action="{{ route('item.update', ['item' => $item->id]) }}">
        @method('PUT')
        @include('item.part.form')
    </form>
@endsection

