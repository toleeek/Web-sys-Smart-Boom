<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Smart-BOOM' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/site.js') }}"></script>
</head>
<body>
<div class="container-fluid ">
    <nav class="navbar navbar-expand-lg mb-4" style="background-color: black">

        <a class="navbar-brand" href="{{ route('index') }}" style="padding-top: 10px; padding-bottom: 10px; padding-left: 7px; padding-right: 7px; border-radius: 10px; color: black; background: white"><span style="border: 2px solid black; padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px; border-bottom-left-radius: 7px; border-top-left-radius: 7px;">Smart</span><span style="color: white; background: black; padding-left: 3px; padding-right: 3px; padding-top: 5px; padding-bottom: 5px; border-bottom-right-radius: 7px; border-top-right-radius: 7px;">BOOM</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbar-example" aria-controls="navbar-example"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Основная часть меню (может содержать ссылки, формы и прочее) -->
        <div class="collapse navbar-collapse" id="navbar-example">
            <!-- Этот блок расположен слева -->
            <ul class="navbar-nav mr-auto" style="color: white">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalog.index') }}" style="color: white">Каталог</a>
                </li>
                @include('layout.part.pages')
            </ul>

            <!-- Этот блок расположен посередине -->
            <form action="{{ route('catalog.search') }}" class="form-inline my-1 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="query"
                       placeholder="Пошук по каталогу" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0"
                        type="submit">Пошук</button>
            </form>

            <!-- Этот блок расположен справа -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" id="top-basket">
                    <a class="nav-link @if ($positions) text-success @endif"
                       href="{{ route('basket.index') }}" style="color: white">
                        Корзина
                        @if ($positions) ({{ $positions }}) @endif
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.login') }}" style="color: white">Ввійти</a>
                    </li>
                    @if (Route::has('user.register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.register') }}" style="color: white">Реєстрація</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}" style="color: white">Особистий кабінет</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-2">
            @include('layout.part.roots')
            @include('layout.part.brands')
        </div>
        <div class="col-md-10">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible mt-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрити">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $message }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible mt-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрити">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
