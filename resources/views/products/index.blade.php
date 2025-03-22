<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>609-22</title>
</head>
<body>
    <h1>Список товаров</h1>

    <table>
        <thead>
            <tr>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена (₽)</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        <a href="{{ url('/products/' . $product->id) }}">{{ $product->name }}</a>
                    </td>
                    <td>
                        {{ $product->category ? $product->category->name : 'Без категории' }}
                    </td>
                    <td>
                        {{ number_format($product->price, 2, ',', ' ') }}
                    </td>
                    <td class="actions">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-edit">Редактировать</a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Удалить товар?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('products.create') }}" class="btn-create">Добавить новый товар</a>

</body>
</html>
