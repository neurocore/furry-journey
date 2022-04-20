@extends('layouts.app')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Книги</h2>
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
    </tr>
    @endforeach
</table>
@endsection
