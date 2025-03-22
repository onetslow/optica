<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if ($category)
            {{ $category->name }}
        @else
            Категория не найдена
        @endif
    </title>
</head>
<body>

    @if ($category)
        <h1>{{ $category->name }}</h1>

        @if ($category->products->count() > 0)
            <ul>
                @foreach ($category->products as $product)
                    <li>
                        <h3>{{ $product->name }}</h3>
                        <p><strong>Цена:</strong> {{ number_format($product->price, 2, ',', ' ') }} ₽</p>

                        @if ($product->category)
                            <p><strong>Категория:</strong> {{ $product->category->name }}</p>
                        @else
                            <p>Нет категории</p>
                        @endif
                    </li>
                    
                    <hr>
                @endforeach
            </ul>
        @else
            <p>Нет товаров в этой категории</p>
        @endif

    @else
        <h1>Категория не найдена</h1>
    @endif

    <p><a href="{{ route('categories.index') }}">Назад</a></p>

</body>
</html>
