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

        <h2>Добавление товара</h2>

        <form method="POST" action="{{ url('products') }}">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Наименование:</label>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="is-invalid">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="category_id">Категория:</label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">-- выберите категорию --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="is-invalid">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="price">Цена:</label>
                <input type="number" id="price" class="form-control @error('price') is-invalid @enderror" name="price" step="0.01" value="{{ old('price') }}">
                @error('price')
                    <div class="is-invalid">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="description">Описание:</label>
                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="is-invalid">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Создать товар</button>
        </form>
    </div>
    </div>
@endsection