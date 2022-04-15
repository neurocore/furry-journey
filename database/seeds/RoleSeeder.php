<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        DB::table('roles')->insert([
            'name' => 'author',
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        
        DB::table('roles')->insert([
            'name' => 'admin',
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
