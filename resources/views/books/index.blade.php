@extends('layouts.app')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Книги</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-success" href="{{ route('books.create') }}">Создать новую книгу</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Название</th>
        <th>Год издания</th>
        <th>Автор</th>
        <th>Жанры</th>
        <th width="400px">Действия</th>
    </tr>
    @foreach ($data as $key => $value)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ $value->year }}</td>
        <td>{{ $value->authors->name }}</td>
        <td>
            <ul>
                @foreach ($value->genres as $genre)
                    <li>{{ $genre->name }}</li>
                @endforeach
            </ul>
        </td>
        <td>
            <form action="{{ route('books.destroy', $value->id) }}" method="POST">   
                <a class="btn btn-info" href="{{ route('books.show', $value->id) }}">Показать</a>    
                <a class="btn btn-primary" href="{{ route('books.edit', $value->id) }}">Редактировать</a>   
                @csrf
                @method('DELETE')      
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>  
{!! $data->links() !!}
@endsection
