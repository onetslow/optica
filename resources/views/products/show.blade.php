@extends('layout')

@section('content')
    @if ($product)
        <h1>{{ $product->name }}</h1>

        <p><strong>Цена:</strong> {{ number_format($product->price, 2, ',', ' ') }} ₽</p>

        @if ($product->category)
            <p><strong>Категория:</strong> {{ $product->category->name }}</p>
        @else
            <p>Нет категории</p>
        @endif

        <p><strong>Описание:</strong> {{ $product->description }}</p>

    @else
        <h1>Продукт не найден</h1>
    @endif

    <p>
        @if ($user && $user->is_admin)
            <a href="{{ route('products.index') }}">Вернуться к товарам</a>
        @elseif ($product && $product->category)
            <a href="{{ route('categories.show', ['id' => $product->category->id]) }}">
                Вернуться к категории: {{ $product->category->name }}
            </a>
        @else
            <a href="{{ url('/') }}">Вернуться на главную</a>
        @endif
    </p>

@endsection