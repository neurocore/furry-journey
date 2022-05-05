@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (Auth::user()->hasRole('admin'))

            <div class="card">
                <div class="card-header">Административная панель</div>

                <div class="card-body">
                    @include('layouts.alert')

                    Вы успешно зашли!
                </div>
            </div>

            @else

            <div class="card">
                <div class="card-header">Панель автора</div>

                <div class="card-body">
                    @include('layouts.alert')

                    Вы успешно зашли!
                </div>
            </div>

            @endif
            
        </div>
    </div>
</div>
@endsection
