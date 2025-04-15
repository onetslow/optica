@extends('layout')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Список категорий</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($categories as $category)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-primary mt-2">
                                Перейти к товарам
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
