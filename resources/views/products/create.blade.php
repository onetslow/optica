<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать товар</title>
    <style>
        .is-invalid { color: red; }
        .form-group { margin-bottom: 10px; }
    </style>
</head>
<body>

    <h2>Добавление товара</h2>

    <form method="POST" action="{{ url('products') }}">
        @csrf
        
        {{-- Название товара (Text) --}}
        <div class="form-group">
            <label>Наименование:</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="is-invalid">{{ $message }}</div>
            @enderror
        </div>

        {{-- Категория (Select) --}}
        <div class="form-group">
            <label>Категория:</label><br>
            <select name="category_id">
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

        {{-- Цена (Number) --}}
        <div class="form-group">
            <label>Цена:</label><br>
            <input type="number" name="price" step="0.01" value="{{ old('price') }}">
            @error('price')
                <div class="is-invalid">{{ $message }}</div>
            @enderror
        </div>

        {{-- Описание (Textarea) --}}
        <div class="form-group">
            <label>Описание:</label><br>
            <textarea name="description">{{ old('description') }}</textarea>
            @error('description')
                <div class="is-invalid">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Создать товар</button>

    </form>

</body>
</html>
