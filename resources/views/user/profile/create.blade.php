@extends('layout.site', ['title' => 'Створення профілю'])

@section('content')
    <h1>Створення профілю</h1>
    <form method="post" action="{{ route('user.profile.store') }}">
        @include('user.profile.part.form')
    </form>
@endsection
