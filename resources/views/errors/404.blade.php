@extends('layout.site', ['title' => 'Сторінка не знайдена'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mt-4 mb-4">
                <div class="card-header">
                    <h1>Сторінка не знайдена(((.</h1>
                </div>
                <div class="card-body">
                    <img src="{{ asset('img/404.jpg') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
