<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заказ</title>
</head>
<body>

@if($order)
    <h1>Заказ №{{ $order->id }}</h1>
    <p>Дата заказа: {{ $order->order_date }}</p>

    <h3>Товары:</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Название</th>
            <th>Количество</th>
            <th>Цена за единицу</th>
            <th>Сумма</th>
        </tr>

        @foreach ($order->products as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->pivot->quantity }}</td>
                <td>{{ number_format($item->pivot->price, 2, ',', ' ') }} ₽</td>
                <td>{{ number_format($item->pivot->price * $item->pivot->quantity, 2, ',', ' ') }} ₽</td>
            </tr>
        @endforeach
    </table>

    <h2>Итого: {{ number_format($total, 2, ',', ' ') }} ₽</h2>

    <br>

    <button onclick="history.back()">Назад</button>
@else
    <h1>Неверный ID заказа</h1>
@endif

</body>
</html>
