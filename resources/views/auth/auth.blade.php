@extends('layout.layouts')
@section('title', 'Авторизация')
@section('content')

<div class="content_row">
    <div class="content_column">
        <h2>Авторизация</h2>
        @if (session()->has('success'))
            <div class="content_row" style="color: red">
                {{ session()->get('success')}}
            </div>
        @endif
        <form action="{{route('signup')}}" method="post" name="signup">
            @csrf
            <div class="form_group">
                <input type="email" name="email" placeholder="Введите email" required value="">
            </div>
            <div class="form_group">
                <input type="password" name="password" placeholder="Введите пароль" required value="">
            </div>
            <div class="form_group">
                <input type="submit" value="Войти">
            </div>
        </form>
    </div>
</div>
@endsection
