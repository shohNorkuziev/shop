@extends('layout.layouts')
@section('title', 'Категории')
@section('content') 
@if (session()->has('success'))
    <div class="success-message">
        {{ session()->get('success') }}
    </div>
@endif
<div class="content_row"> 
    @if($data->role=='admin')
    <a href="{{ route('categories.create') }}" class="add-category-link">Добавить</a>
 @endif
   
   
    <table class="table-categories">
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th>Действие</th>
        </tr>
    @foreach($data->category as $cat)
    <div class="category-item">
        <tr>
            <td>{{ $cat->id }}</td>
           <td><a href="{{ route('categories.show', $cat->id) }}" class="asd">{{ $cat->name }}</a></td>
            <td>
                <a href="{{ route('categories.edit', $cat->id) }}" class="edit-btn">Ред.</a>
                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Удалить</button>
                </form>
            </td>
        </tr>
    </div>
    @endforeach 
    </table>
</div>
@endsection
