@extends('layouts.app')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Жанры</h2>
        </div>
    </div>
</div>

@include('layouts.alert')

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Название</th>
    </tr>
    @foreach ($data as $key => $value)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $value->name }}</td>
    </tr>
    @endforeach
</table>
@endsection
