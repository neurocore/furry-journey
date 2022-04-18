@extends('layouts.crud')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Жанр</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('genres.index') }}">Назад</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Имя:</strong>
            {{ $genre->name }}
        </div>
    </div>
</div>
@endsection
