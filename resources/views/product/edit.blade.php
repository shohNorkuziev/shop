@extends('layout.layouts')
@section('title', 'Admin')
@section('content')

<div class="content_row">
    <div class="content_column">
        <h2>Изменение товара</h2>
       
        <form action="{{ route('products.update',$pro) }}" method="post"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form_group">
                <input type="text" name="name" placeholder="Введите название" required value="{{$pro->name}}">
            </div>
            <div class="form_group">
                <input type="number" name="price" placeholder="Введите cтоимость" required value="{{$pro->price}}">
            </div>
            <div class="form_group">
                <input type="text" name="description" placeholder="Введите описание" value="{{$pro->description}}">
            </div>
            
            <div class="form_group">
                <input type="number" name="qty" placeholder="Введите количество" required value="{{$pro->qty}}">
            </div>
            <div class="form_group">
                <select name="category_id" id="">
                    <option disabled selected>Выберите Категорию</option>
                    @foreach($category as $categ)
                    <option value="{{$categ->id}}">{{$categ->name}}</option>
                    @endforeach
                </select>
                <div class="form_group">
                    <input type="file" name="image" placeholder="Вставьте картинку">
                </div>
            </div>
            <div class="form_group">
                <input type="submit" value="Изменить">
            </div>
        </form>
    </div>
</div>
@endsection
