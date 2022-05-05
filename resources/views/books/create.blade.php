@extends('layouts.app')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Добавить новую книгу</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('books.index') }}">Назад</a>
        </div>
    </div>
</div>
   
@include('layouts.alert')
   
<form action="{{ route('books.store') }}" method="POST">
    @csrf
  
     <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                <input type="text" name="name" class="form-control" placeholder="Название">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Год издания:</strong>
                <input type="text" name="year" class="form-control" placeholder="Год издания">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Автор:</strong>
                <select name="author_id">
                @foreach ($authors as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>    
                @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Жанры:</strong>
                <div class="input-group mb-3">

                    @foreach ($genres as $key => $value)
                    <div class="custom-control custom-checkbox col-12">
                        <input type="checkbox"
                               class="custom-control-input"
                               value="{{ $key }}"
                               name="genre_ids[]"
                               id="genre_ids_{{ $key }}"
                               >
                        <label class="custom-control-label"
                               for="genre_ids_{{ $key }}">{{ $value }}</label>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Подтвердить</button>
        </div>
    </div>
   
</form>
@endsection
