<?php

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
        $date = date('Y-m-d H:i:s');
        DB::table('genres')->insert([
            'name' => 'Детектив',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::table('genres')->insert([
            'name' => 'Фантастика',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::table('genres')->insert([
            'name' => 'Роман',
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
