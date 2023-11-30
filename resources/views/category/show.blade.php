@extends('layout.layouts')
@section('title', 'Категории')
@section('content') 
<head>
 <style>
  .product-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

/* Стили для элемента товара */
.product-item {
    width: 30%;
    padding: 20px;
    margin: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    text-align: center;
    background-color: #fff;
    transition: transform 0.3s ease-in-out;
}

.product-item:hover {
    transform: scale(1.05);
}

.product-item h2 {
    margin: 10px 0;
    font-size: 1.2em;
    color: #333;
}

.product-item h3 {
    color: #007bff;
    font-weight: bold;
    margin-bottom: 10px;
}

.product-item a {
    text-decoration: none;
    color: #000;
    display: block;
}

.product-item img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>   
</head>

<div class="product-container">
    @foreach($data->product as $prod)
    <div class="product-item" >

        <a href="/products/{{ $prod->id }}">
            <div>
                <img src="{{ asset('public/'.$prod->image) }}" alt="{{ $prod->name }}" width="100%">
            </div>
            <h2>{{ $prod->name }}</h2>
            <h3>Цена: {{ $prod->price }} руб.</h3>
        </a>
    </div>
    @endforeach
</div>
@endsection
