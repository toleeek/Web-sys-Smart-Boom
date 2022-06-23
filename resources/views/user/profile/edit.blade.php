@extends('layout.site', ['title' => 'Редагування профілю'])

@section('content')
    <h1>Редагування профілю</h1>
    <form method="post" action="{{ route('user.profile.update', ['profile' => $profile->id]) }}">
        @method('PUT')
        @include('user.profile.part.form')
    </form>
@endsection
