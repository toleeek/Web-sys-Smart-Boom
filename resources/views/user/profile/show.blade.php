@extends('layout.site', ['title' => 'Інформація профілю'])

@section('content')
    <h1>Інформація профілю</h1>

    <p><strong>Назва профілю:</strong> {{ $profile->title }}</p>
    <p><strong>Імя, Прізвище:</strong> {{ $profile->name }}</p>
    <p>
        <strong>Адреса пошти:</strong>
        <a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a>
    </p>
    <p><strong>Номер телефону:</strong> {{ $profile->phone }}</p>
    <p><strong>Адреса доставки:</strong> {{ $profile->address }}</p>
    @isset ($profile->comment)
        <p><strong>Коментар:</strong> {{ $profile->comment }}</p>
    @endisset

    <a href="{{ route('user.profile.edit', ['profile' => $profile->id]) }}"
       class="btn btn-success">
        Редагувати профіль
    </a>
    <form method="post" class="d-inline" onsubmit="return confirm('Видалити цей профіль?')"
          action="{{ route('user.profile.destroy', ['profile' => $profile->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Видалити профіль
        </button>
    </form>
@endsection
