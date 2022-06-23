@extends('layout.admin', ['title' => 'Всі категорії каталога'])

@section('content')
    <h1>Всі категорії</h1>
    <a href="{{ route('admin.category.create') }}" class="btn btn-success mb-4">
        Створити категорію
    </a>
    <table class="table table-bordered">
        <tr>
            <th width="30%">Назва</th>
            <th width="65%">Опис</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>
        @include('admin.category.part.tree', ['level' => -1, 'parent' => 0])
    </table>
@endsection
