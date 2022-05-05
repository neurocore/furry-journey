<?php

use App\Genre;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        Genre::insert([
            [ 'created_at' => $now, 'updated_at' => $now, 'name' => 'Детектив' ],
            [ 'created_at' => $now, 'updated_at' => $now, 'name' => 'Фантастика' ],
            [ 'created_at' => $now, 'updated_at' => $now, 'name' => 'Роман' ],
            [ 'created_at' => $now, 'updated_at' => $now, 'name' => 'Приключения' ],
        ]);
    }
}
