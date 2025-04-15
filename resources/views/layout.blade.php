<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>609-22</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ms-5" href="{{ url('/') }}">
            <img src="{{ asset('images/Gr.png') }}" alt="Логотип" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item me-5">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Главная</a>
                </li>
                <div class="btn-group me-5">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Категории
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('categories.index') }}">Все категории</a></li>
                        <li><a class="dropdown-item" href="{{ route('categories.show', ['id' => 1]) }}">Очки для зрения</a></li>
                        <li><a class="dropdown-item" href="{{ route('categories.show', ['id' => 2]) }}">Солнцезащитные очки</a></li>
                        <li><a class="dropdown-item" href="{{ route('categories.show', ['id' => 3]) }}">Контактные линзы</a></li>   
                        <li><a class="dropdown-item" href="{{ route('categories.show', ['id' => 4]) }}">Акссесуары</a></li>
                    </ul>
                </div>
                @can('manage-products')
                    <li class="nav-item me-5">
                        <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ url('products') }}">Товары</a>
                    </li>
                @endcan
                <li class="nav-item me-5">
                    <a class="nav-link {{ Request::is('orders*') ? 'active' : '' }}" href="{{ url('orders') }}">Заказы</a>
                </li>  
            </ul>
            
            <ul class="navbar-nav ms-auto me-5"> 
                @auth
                    <li class="nav-item d-flex align-items-center">
                        <span class="me-2">{{ auth()->user()->name }}</span>
                        <a>
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                        <a class="nav-link" href="{{ url('logout') }}">Выйти</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}">Войти</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
    </div>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
