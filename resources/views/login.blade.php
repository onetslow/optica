@extends('layout')

@section('content')
        @error('error')
            <div class="text-danger mt-3">
                {{ $message }}
            </div>
        @enderror
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4" style="max-width: 400px; width: 100%;">
    @if(!$user)
        <h2>Вход в систему</h2>
        <form method="POST" action="{{ url('auth') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    @endif
    </div>
</div>
@endsection