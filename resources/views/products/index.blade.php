<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>609-22</title>
</head>
<body>
    <h1>Список товаров</h1>
    <ul>
        @foreach ($products as $product)
            <li><a href="{{ url('/products/' . $product->id) }}">{{ $product->name }}</a></li>
        @endforeach
    </ul>
</body>
</html>
