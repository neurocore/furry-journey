@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Упс!</strong> Ваши данные содержат ошибки<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
