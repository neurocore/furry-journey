@extends('layouts.app')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Жанры</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-success" href="{{ route('genres.create') }}">Создать новый жанр</a>
        </div>
    </div>
</div>

@include('layouts.alert')

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Название</th>
        <th width="400px">Действия</th>
    </tr>
    @foreach ($data as $key => $value)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $value->name }}</td>
        <td>
            <form action="{{ route('genres.destroy', $value->id) }}" method="POST">   
                <a class="btn btn-info" href="{{ route('genres.show', $value->id) }}">Показать</a>    
                <a class="btn btn-primary" href="{{ route('genres.edit', $value->id) }}">Редактировать</a>   
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
