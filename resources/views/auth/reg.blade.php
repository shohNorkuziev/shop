@extends('layout.layouts')
@section('title', 'Регистрация')
@section('content')

<div class="content_row">
    <div class="content_column">
        <h2>Регистрация</h2>
        @if (session()->has('success'))
            <div class="content_row" style="color: red">
                {{ session()->get('success')}}
            </div>
        @endif
        <form action="{{route('store')}}" method="post" name="login">
            @csrf
            <div class="form_group">
                <input type="text" name="firstname" placeholder="Введите имя" required value="">
            </div>
            <div class="form_group">
                <input type="text" name="lastname" placeholder="Введите фамилию" required value="">
            </div>
            <div class="form_group">
                <input type="text" name="patronymic" placeholder="Введите Отчество" value="">
            </div>
            <div class="form_group">
                <input type="radio" name="gender" required value="М">М
                <input type="radio" name="gender" required value="Ж">Ж
            </div>
            <div class="form_group">
                <input type="email" name="email" placeholder="Введите email" required value="">
            </div>
            <div class="form_group">
                <input type="password" name="password" placeholder="Введите пароль" required value="">
            </div>
            <div class="form_group">
                <input type="password" name="password_confirmation" placeholder="Подтвердите пароль" required value="">
            </div>  
            Уже Зарегистрированы<a href="/login">Авторизуйтесь</a>
            <div class="form_group">
                <input type="submit" value="Зарегистрироваться">
            </div>
          
        </form>
    </div>
</div>
@endsection
