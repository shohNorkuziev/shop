<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | @yield('title','home')</title>
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>
<body>
        <div class="wrapper">
            <div class="container">
                <nav class="navigation">
                    <h2>Shoh Shop</h2>
                    <ul class="up-menu">
                        <li>
                            <a href="/info">О нас</a>
                            <a href="/categories">Категории</a>
                            <a href="/catalog">Товары</a>
                            <a href="">Контакты</a>
                        </li>
                    </ul>
                    <div class="exit">
                        @if($data->role=='guest')
                    <a href="/create">Регистрация</a>
                    <a href="/login">Вход</a> 
                    @endif
                    @if($data->role=='user' or $data->role=='admin')
                     <a href="/cart/view" class="cart"><img src="{{asset('public/images/cart1.png')}}" alt=""></a>
                    <a href="/logout" class="exit">Выход</a>
                    </div>
                    @endif
                </nav>
                @if (session()->has('auths'))
            <div class="content_row" style="color: red">
                {{ session()->get('auths')}}
            </div>
        @endif
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer>
            <div class="content-row">
                <div>
                    <h4>2023, Информация</h4>
                        <a href="/info">О нас</a>
                        <a href="">Контакты</a>
                        <a href="">Каталог</a>
                </div>
            </div>
            <script src="{{ asset('public/js/js.js') }}" defer></script>
        </footer>
</body>
</html>