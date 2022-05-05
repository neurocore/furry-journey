@if ($message = Session::get('message'))
    <div class="alert alert-{{ Session::get('status', 'success') }}">
        <div>{{ $message }}</div>
    </div>
@endif
