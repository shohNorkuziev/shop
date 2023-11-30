@extends('layout.layouts')
@section('title', 'Корзина')
@section('content')
@if($cart)
<div class="cart-actions">
    <form action="{{ route('cart.clear') }}" method="get">
        @csrf
        <button type="submit" class="btn btn-clear">Очистить корзину</button>
    </form>

    <form action="{{ route('cart.checkout') }}" method="get">
        @csrf
        <button type="submit" class="btn btn-checkout">Завершить покупку</button>
    </form>
</div>
    <div class="cart-container">
        @foreach($cart as $productId => $item)
            <div class="cart-item">
                <a href="/products/{{ $item['id'] }}" class="product-link">
                    <div class="product-image">
                        <img src="{{ asset('public/'.$item['image']) }}" alt="{{ $item['name'] }}" width="100px" height="100px">
                    </div>
                    <div class="product-details">
                        <h2>{{ $item['name'] }}</h2>
                        <h3>{{ $item['price'] }}</h3>
                    </div>
                </a>
            </div>
        @endforeach

        
    </div>
@else
    <h1>Корзина пуста</h1>
@endif
@endsection
