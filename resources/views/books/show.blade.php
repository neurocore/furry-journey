@extends('layouts.app')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Книга</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('books.index') }}">Назад</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Название:</strong>
            {{ $book->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Год:</strong>
            {{ $book->year }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Автор:</strong>
            {{ $book->authors->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Жанры:</strong>
            <ul>
                @foreach ($book->genres as $genre)
                    <li>{{ $genre->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
