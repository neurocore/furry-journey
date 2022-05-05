@extends('layouts.app')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Добавить новый жанр</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('genres.index') }}">Назад</a>
        </div>
    </div>
</div>
   
@include('layouts.alert')
   
<form action="{{ route('genres.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                <input type="text" name="name" class="form-control" placeholder="Название">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Подтвердить</button>
        </div>
    </div>
   
</form>
@endsection
