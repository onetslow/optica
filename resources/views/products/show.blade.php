<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product ? $product->name : 'Продукт не найден' }}</title>
</head>
<body>

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

    <p><a href="{{ route('products.index') }}">Вернуться к товарам</a></p>

</body>
</html>
