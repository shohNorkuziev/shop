@extends('layout.layouts')
@section('title', 'Товары')
@section('content')
@if($data->role=='admin')
    <a href="{{ route('products.create') }}" class="add-product-link" style="text-decoration: none; background-color: #4caf50; color: #fff; padding: 10px 20px; border-radius: 4px; display: inline-block; margin-bottom: 20px;">Добавить товар</a>
@endif
@if (session()->has('success'))
    <div class="success-message" style="background-color: #4caf50; color: #fff; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
        {{ session()->get('success') }}
    </div>
@endif
<div style="margin-bottom: 20px;">
    <nav class="filtr" style="display:flex;: #f2f2f2; padding: 10px; border-radius: 4px;">
        <a href="sort/1/name" style="text-decoration: none; width:150px; color: #333; margin-right: 10px;">По наименованию</a>
        <a href="sort/1/price" style="text-decoration: none; color: #333;width:150px; margin-right: 10px;">По цене</a>
        <a href="sort/1/new" style="text-decoration: none; color: #333; margin-right: 10px;width:150px;">По новизне</a>
        <select id="select_filtr" name="select_filtr" onchange="filtr()" class="select-css" style="width:150px;padding: 8px; border-radius: 4px;">
            @foreach($data->category as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
            <option value="Все" selected>Все</option>
        </select>
    </nav>
</div>

<div class="product-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
    @foreach($data->product as $prod)
    <div class="product-item" data-category="{{ $prod->category_id }}" style="background-color: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 4px; width: 200px;">
        <a href="/products/{{ $prod->id }}" style="text-decoration: none; color: #333;">
            <div style="margin-bottom: 10px;">
                <img src="{{ asset('public/'.$prod->image) }}" alt="{{ $prod->name }}" width="100%" height="auto">
            </div>
            <h2 style="margin-bottom: 5px;">{{ $prod->name }}</h2>
            <h3>{{ $prod->price }}</h3>
        </a>
    </div>
    @endforeach
</div>
@endsection
<script>
    function filtr() {
        var selectedCategory = document.getElementById("select_filtr").value;
        var productItems = document.querySelectorAll(".product-item");

        productItems.forEach(function(item) {
            var itemCategory = item.getAttribute("data-category");

            if (selectedCategory === "Все" || selectedCategory === itemCategory) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    }
</script>
