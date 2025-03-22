<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>609-22</title>
</head>
<body>
    <h1>Список категорий:</h1>
    <ul>
        @foreach ($categories as $category)
            <li><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</body>
</html>
