@extends('layout')

@section('content')

    <div class="container mt-4">

        <h3 class="mb-4">Список товаров</h3>

        <div class="mb-3 text-end">
            <a href="{{ route('products.create') }}" class="btn btn-success">Добавить новый товар</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Цена (₽)</th>
                        <th class="text-center">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <a href="{{ url('/products/' . $product->id) }}" class="text-decoration-none">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>
                                {{ $product->category ? $product->category->name : 'Без категории' }}
                            </td>
                            <td>
                                {{ number_format($product->price, 2, ',', ' ') }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary me-2">Редактировать</a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить товар?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {{ $products->links() }}
        </div>
    </div>
@endsection
