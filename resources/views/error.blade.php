@extends('layout')

@section('content')
    <div class="alert alert-danger">
        {{ $message ?? 'Произошла ошибка' }}
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Назад</a>
@endsection
