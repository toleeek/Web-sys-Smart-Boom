@extends('layout.site', ['title' => 'Всі елементи'])

@section('content')
    <h1>Все елементи</h1>
    <a href="{{ route('item.create') }}" class="btn btn-success mb-4">
        Створити елемент
    </a>
    <table class="table table-bordered">
    <tr>
        <th>Назва</th>
        <th>Часовий пояс</th>
        <th>Слоган</th>
        <th>Опис</th>
        <th>Створений</th>
        <th>Змінений</th>
        <th><i class="fas fa-eye"></i></th>
        <th><i class="fas fa-edit"></i></th>
        <th><i class="fas fa-trash-alt"></i></th>
    </tr>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->timezone }}</td>
            <td>{{ $item->slug }}</td>
            <td>{{ $item->content }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->updated_at }}</td>
            <td>
                <a href="{{ route('item.show', ['item' => $item->id]) }}">
                    <i class="far fa-eye"></i>
                </a>
            </td>
            <td>
                <a href="{{ route('item.edit', ['item' => $item->id]) }}">
                    <i class="far fa-edit"></i>
                </a>
            </td>
            <td>
                <form action="{{ route('item.destroy', ['item' => $item->id]) }}"
                      method="post" onsubmit="return confirm('Видалити цей елемент?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                        <i class="far fa-trash-alt text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
@endsection
