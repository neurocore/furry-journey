<?php

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

        $books = [
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

        foreach ($books as $book) {

            // 1. Adding books into table

            $id = DB::table('books')->insertGetId([
                'name' => $book[0],
                'author_id' => $user_ids[ $book[1] ],
                'year' => $book[3],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            // 2. Building relations between books and genres
            
            foreach ($book[2] as $genre) {
                DB::table('book_genres')->insert([
                    'book_id' => $id,
                    'genre_id' => $genre_ids[ $genre ],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
