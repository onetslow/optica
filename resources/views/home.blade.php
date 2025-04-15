@extends('layout')

@section('content')
    <div class="text-center mb-5">
        <h1 class="display-5">Добро пожаловать в Магазин Оптики</h1>
        <p class="lead">Качественные очки, линзы и аксессуары — заботимся о вашем зрении!</p>
    </div>

    <h3 class="mb-4">Популярные товары</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ $product->category->name ?? 'Без категории' }}</p>
                        <p class="fw-bold">{{ $product->price }} ₽</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection