@extends('layout')

@section('content')

@if($order)
    <div class="container mt-4">
        <h1 class="mb-3">Заказ №{{ $order->id }}</h1>
        <p><strong>Дата заказа:</strong> {{ $order->order_date }}</p>

        <h3 class="mt-4">Товары:</h3>
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Цена за единицу</th>
                    <th>Сумма</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->pivot->quantity }}</td>
                        <td>{{ number_format($item->pivot->price, 2, ',', ' ') }} ₽</td>
                        <td>{{ number_format($item->pivot->price * $item->pivot->quantity, 2, ',', ' ') }} ₽</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-4">Итого: {{ number_format($total, 2, ',', ' ') }} ₽</h2>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Назад</a>
    </div>
@else
    <div class="container mt-4">
        <h1 class="text-danger">Неверный ID заказа</h1>
    </div>
@endif

@endsection
