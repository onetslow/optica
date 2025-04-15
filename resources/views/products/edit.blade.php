@extends('layout')

@section('content')

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div style="width: 100%; max-width: 500px;">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Пожалуйста, исправьте следующие ошибки:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif

        <h2>Редактировать товар</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Название товара</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}">
                @error('name')
                    <div class="is-invalid">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Категория</label>
                <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="is-invalid">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" id="price" name="price" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
                @error('price')
                    <div class="is-invalid">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="is-invalid">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Обновить товар</button>
        </form>

        <br>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Назад к списку товаров</a>
    </div>
    </div>
@endsection
