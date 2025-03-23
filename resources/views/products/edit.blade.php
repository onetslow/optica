<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование товара</title>
    <style>
        .is-invalid { color: red; } 
    </style>
</head>
<body>

<div class="container">
    <h2>Редактировать товар</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Название --}}
        <div class="mb-3">
            <label for="name">Название товара</label><br>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $product->name) }}"
                class="@error('name') is-invalid @enderror"
            >
            @error('name')
                <div class="is-invalid">{{ $message }}</div>
            @enderror
        </div>

        {{-- Категория --}}
        <div class="mb-3">
            <label for="category_id">Категория</label><br>
            <select
                id="category_id"
                name="category_id"
                class="@error('category_id') is-invalid @enderror"
            >
                <option value="" style="display:none;">Выберите категорию</option>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="is-invalid">{{ $message }}</div>
            @enderror
        </div>

        {{-- Цена --}}
        <div class="mb-3">
            <label for="price">Цена</label><br>
            <input
                type="number"
                id="price"
                name="price"
                step="0.01"
                value="{{ old('price', $product->price) }}"
                class="@error('price') is-invalid @enderror"
            >
            @error('price')
                <div class="is-invalid">{{ $message }}</div>
            @enderror
        </div>

        {{-- Описание --}}
        <div class="mb-3">
            <label for="description">Описание</label><br>
            <textarea
                id="description"
                name="description"
                class="@error('description') is-invalid @enderror"
            >{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="is-invalid">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-primary">Обновить</button>
    </form>

    <br>
    <a href="{{ route('products.index') }}">Назад к списку товаров</a>
</div>

</body>
</html>
