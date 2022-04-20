@if (Auth::user()->hasRole('admin'))

<div class="row">
    <h2>CRUD</h2>
    <div class="list-group list-group-flush">
        <a href="{{ route('users.index')  }}"
           class="list-group-item list-group-item-action">Авторы</a>
        <a href="{{ route('genres.index') }}"
           class="list-group-item list-group-item-action">Жанры</a>
        <a href="{{ route('books.index')  }}"
           class="list-group-item list-group-item-action">Книги</a>
    </div>
</div>

@else

<div class="row">
    <h2>Списки</h2>
    <div class="list-group list-group-flush">
        <a href="{{ route('author.users')  }}"
           class="list-group-item list-group-item-action">Авторы</a>
        <a href="{{ route('author.genres') }}"
           class="list-group-item list-group-item-action">Жанры</a>
        <a href="{{ route('author.books')  }}"
           class="list-group-item list-group-item-action">Книги</a>
    </div>
</div>

@endif

