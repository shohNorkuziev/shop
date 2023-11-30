@extends('layout.layouts')
@section('title', 'Товар')
@section('content')
  @if (session()->has('success'))
    <div class="content_row" style="color: red">
        {{ session()->get('success')}}
    </div>
@endif
<div class="content_row">
  
    <div class="product-itemm">
        <div>
            <img src="{{asset('public/'.$data->image)}}" alt="{{$data->name}}" width="100px" height="100px">
        </div>
        <h2>{{ $data->name }}</h2>
        <h3>{{ $data->price }}</h3>
    </div>
    <div class="text-contactt">
        <h3>Описание:</h3>
        <hr>
        <p>Категория: {{ $data->category }}</p>
        <p>Характеристики: {{ $data->description }}</p>
        <a href="#" onclick="history.back()">Назад</a>
        <br><br>
        <a href="{{ route('products.edit', $data->id) }}" class="edit-btnn">Редактировать</a>
        <form action="{{ route('cart') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $data->id }}">
            <input type="submit" value="Добавить в корзину"  class="edit-btnn">
        </form>
        <form action="{{ route('products.destroy', $data->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btnn">Удалить</button>
        </form>
    </div>
</div>
@endsection
