@extends('layout.admin', ['title' => 'Перегляд бренда'])

@section('content')
    <h1>Перегляд бренда</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Назва:</strong> {{ $brand->name }}</p>
            <p><strong>Слоган:</strong> {{ $brand->slug }}</p>
            <p><strong>Короткий опис</strong></p>
            @isset($brand->content)
                <p>{{ $brand->content }}</p>
            @else
                <p>Опису немає</p>
            @endisset
        </div>
        <div class="col-md-6">
            @php
                if ($brand->image) {
                    // $url = url('storage/catalog/brand/source/' . $brand->image);
                    $url = Storage::disk('public')->url('catalog/brand/image/' . $brand->image);
                } else {
                    // $url = Storage::disk('public')->url('catalog/brand/image/' . $brand->image);
                    $url = Storage::disk('public')->url('catalog/brand/image/default.jpg');
                }
            @endphp
            <img src="{{ $url }}" alt="" class="img-fluid">
        </div>
    </div>
    <a href="{{ route('admin.brand.edit', ['brand' => $brand->id]) }}"
       class="btn btn-success">
        Редагувати бренд
    </a>
    <form method="post" class="d-inline" onsubmit="return confirm('Видалити цей бренд?')"
          action="{{ route('admin.brand.destroy', ['brand' => $brand->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Видалити бренд
        </button>
    </form>
@endsection

