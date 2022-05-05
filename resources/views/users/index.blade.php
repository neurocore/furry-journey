@extends('layouts.app')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Авторы</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-success" href="{{ route('users.create') }}">Создать нового автора</a>
        </div>
    </div>
</div>

@include('layouts.alert')

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Имя</th>
        <th>Книг</th>
        <th>Почта</th>
        <th width="400px">Действия</th>
    </tr>
    @foreach ($data as $key => $value)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ $value->books_count }}</td>
        <td>{{ $value->email }}</td>
        <td>
            <form action="{{ route('users.destroy', $value->id) }}" method="POST">   
                <a class="btn btn-info" href="{{ route('users.show', $value->id) }}">Показать</a>    
                <a class="btn btn-primary" href="{{ route('users.edit', $value->id) }}">Редактировать</a>   
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
