@extends('layout.layouts')
@section('title', 'Admin')
@section('content')

<div class="content_row">
    <div class="content_column">
        <h2>Добавление категорию</h2>
        @if (session()->has('success'))
            <div class="content_row" style="color: red">
                {{ session()->get('success')}}
            </div>
        @endif
        <form action="{{ route('categories.store') }}" method="post">
            @csrf
            <div class="form_group">
                <input type="text" name="name" placeholder="Введите название" required value="">
            </div>
            </div>
            <div class="form_group">
                <input type="submit" value="Добавить" >
            </div>
        </form>
    </div>
</div>
@endsection
