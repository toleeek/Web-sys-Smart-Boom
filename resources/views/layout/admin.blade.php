<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token() }}">
    <title>{{ $title ?? 'Smart Boom' }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ru-RU.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg  mb-4" style="background-color: black; color: white">
        <!-- Бренд и кнопка «Гамбургер» -->
        <a class="navbar-brand" href="{{ route('admin.index') }}" style="padding-top: 10px; padding-bottom: 10px; padding-left: 7px; padding-right: 7px; border-radius: 10px; color: black; background: white"><span style="border: 2px solid black; padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px; border-bottom-left-radius: 7px; border-top-left-radius: 7px;">Smart</span><span style="color: white; background: black; padding-left: 3px; padding-right: 3px; padding-top: 5px; padding-bottom: 5px; border-bottom-right-radius: 7px; border-top-right-radius: 7px;">BOOM</span> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbar-example" aria-controls="navbar-example"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Основная часть меню (может содержать ссылки, формы и прочее) -->
        <div class="collapse navbar-collapse" id="navbar-example">
            <!-- Этот блок расположен слева -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.order.index') }}" style="color: white">Замовлення</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.user.index') }}" style="color: white">Користувачі</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.category.index') }}" style="color: white">Категорії</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.brand.index') }}" style="color: white">Бренди</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.product.index') }}" style="color: white">Товари</a>
                </li>

            </ul>

            <!--
<li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.page.index') }}">Сторінки</a>
                </li>
             -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a onclick="document.getElementById('logout-form').submit(); return false"
                       href="{{ route('user.logout') }}" class="nav-link" style="color: white">Вийти</a>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('user.logout') }}" method="post"
                  class="d-none">
                @csrf
            </form>
        </div>
    </nav>

    <div class="row">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible mt-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрити">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $message }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
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
