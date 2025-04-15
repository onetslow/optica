@extends('layout')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Все заказы</h2>

    @if(session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID заказа</th>
                <th>Пользователь</th>
                <th>Дата заказа</th>
                <th>Сумма</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>
                        {{ number_format($order->products->sum(function ($item) {
                            return $item->pivot->quantity * $item->pivot->price;
                        }), 2, ',', ' ') }} ₽
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                            Посмотреть
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
