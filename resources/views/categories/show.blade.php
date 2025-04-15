@extends('layout')

@section('content')
    <div class="container mt-4">
        @if ($category)
            <h2 class="mb-4 text-center">{{ $category->name }}</h2>

            @if ($category->products->count() > 0)
                <div class="row">
                    @foreach ($category->products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="" class="card-img-top" alt="Нет изображения">
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text mb-1">
                                        <strong>Цена:</strong> {{ number_format($product->price, 2, ',', ' ') }} ₽
                                    </p>
                                    <p class="text-muted small mb-3">
                                        Категория: {{ $product->category->name ?? 'Не указана' }}
                                    </p>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary mt-auto">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">Нет товаров в этой категории.</p>
            @endif
        @else
            <h2 class="text-center">Категория не найдена</h2>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">← Назад к списку категорий</a>
        </div>
    </div>
@endsection
