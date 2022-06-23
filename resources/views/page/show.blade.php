@extends('layout.site', ['title' => $page->name])

@section('content')
    <div class="card">
        <div class="card-header" style="background-color: black; color: white">
            <h1>{{ $page->name }}</h1>
        </div>
        <div class="card-body">
            {!! $page->content  !!}
        </div>
        <div class="card-footer" style="background-color: black; color: white">

        </div>
    </div>
@endsection
