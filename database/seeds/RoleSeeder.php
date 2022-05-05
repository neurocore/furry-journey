<?php

use App\Role;
use Carbon\Carbon;
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
        $now = Carbon::now();
        Role::insert([
            [ 'created_at' => $now, 'updated_at' => $now, 'name' => 'author' ],
            [ 'created_at' => $now, 'updated_at' => $now, 'name' => 'admin' ],
        ]);
    }
}
