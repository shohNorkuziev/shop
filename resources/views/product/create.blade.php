@extends('layout.layouts')
@section('title', 'Admin')
@section('content')

<div class="content_row" style="margin: 20px; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    <div class="content_column" style="background-color: #f9f9f9; padding: 20px; border-radius: 8px;">
        <h2 style="color: #333; text-align: center;">Добавление товара</h2>
        @if (session()->has('success'))
            <div class="content_row" style="color: red; margin-top: 10px;">
                {{ session()->get('success')}}
            </div>
        @endif
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" style="margin-top: 20px;">
            @csrf
            <div class="form_group" style="margin-bottom: 15px;">
                <input type="text" name="name" placeholder="Введите название" required value="" style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="form_group" style="margin-bottom: 15px;">
                <input type="number" name="price" placeholder="Введите стоимость" required value="" style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="form_group" style="margin-bottom: 15px;">
                <input type="text" name="description" placeholder="Введите описание" value="" style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="form_group" style="margin-bottom: 15px;">
                <input type="number" name="qty" placeholder="Введите количество" required value="" style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="form_group" style="margin-bottom: 15px;">
                <select name="category_id" id="" style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
                    <option disabled selected>Выберите категорию</option>
                    @foreach($category as $categ)
                    <option value="{{$categ->id}}">{{$categ->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form_group" style="margin-bottom: 15px;">
                <input type="file" name="image" placeholder="Вставьте картинку" required value="" style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="form_group" style="text-align: center;">
                <input type="submit" value="Добавить" style="background-color: #4caf50; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
            </div>
        </form>
    </div>
</div>

@endsection
