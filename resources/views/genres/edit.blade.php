@extends('layouts.app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>{{ $title }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('genres.index') }}">Назад</a>
        </div>
    </div>
</div>

@include('layouts.errors')

<form action="{{ $action }}" method="POST">
    @csrf
    @if (!!$genre) 
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                <input type="text" name="name" value="{{ $genre ? $genre->name : '' }}" class="form-control" placeholder="Имя">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Подтвердить</button>
        </div>
    </div>

</form>
@endsection
