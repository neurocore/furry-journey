<?php

use App\Book;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = DB::table('users')->pluck('id', 'name');
        $genre_ids = DB::table('genres')->pluck('id', 'name');

        $books_flat = [
            ['Убийство на улице Морг', 'Эдгар Аллан По', ['Детектив'], 1841],
            ['Рассказы о Шерлоке Холмсе', 'Артур Конан Дойл', ['Детектив', 'Приключения'], 1887],
            ['Основание', 'Айзек Азимов', ['Фантастика'], 1966],
            ['Конец вечности', 'Айзек Азимов', ['Фантастика'], 1972],
            ['Двухсотлетний человек', 'Айзек Азимов', ['Фантастика'], 1976],
            ['Солярис', 'Станислав Лем', ['Фантастика'], 1987],
            ['Три мушкетера', 'А. Дюма', ['Роман'], 1844],
            ['Граф Монте-Кристо', 'А. Дюма', ['Роман', 'Приключения'], 1846],
            ['Отверженные', 'В. Гюго', ['Роман'], 1862],
            ['Железный король', 'Морис Дрюон', ['Роман'], 1955],
        ];

        $books = collect($books_flat)->map(function($book) use ($user_ids, $genre_ids) {
            $now = Carbon::now();
            $genres = [];
            foreach ($book[2] as $genre) {
                $id = $genre_ids[$genre];
                $genres[$id] = ['created_at' => $now, 'updated_at' => $now];
            }

            return [
                'name' => $book[0],
                'author_id' => $user_ids[ $book[1] ],
                'year' => $book[3],
                'genres' => $genres,
            ];
        })->toArray();

        foreach ($books as $book) {

            // 1. Adding books into table

            $book_simple = $book;
            unset($book_simple['genres']);
            $book_saved = Book::create($book_simple);

            // 2. Building relations between books and genres

            $book_saved->genres()->attach($book['genres']);
        }
    }
}
