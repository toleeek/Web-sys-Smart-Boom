@extends('layout.site', ['title' => 'Ваші профілі'])

@section('content')
    <h1>Ваші профілі</h1>

    <a href="{{ route('user.profile.create') }}" class="btn btn-success mb-4">
        Створити профіль
    </a>

    @if (count($profiles))
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th width="22%">Назва</th>
                <th width="22%">Імя, Прізвище</th>
                <th width="22%">Адреса пошти</th>
                <th width="22%">Номер телефону</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach($profiles as $profile)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('user.profile.show', ['profile' => $profile->id]) }}">
                            {{ $profile->title }}
                        </a>
                    </td>
                    <td>{{ $profile->name }}</td>
                    <td><a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a></td>
                    <td>{{ $profile->phone }}</td>
                    <td>
                        <a href="{{ route('user.profile.edit', ['profile' => $profile->id]) }}">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('user.profile.destroy', ['profile' => $profile->id]) }}"
                              method="post" onsubmit="return confirm('Видалити цей профіль?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $profiles->links() }}
    @endif
@endsection
