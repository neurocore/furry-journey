<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('12345678');
        $users = [
            [
                'name' => 'Админ',
                'email' => 'admin@gmail.com',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Эдгар Аллан По',
                'email' => 'EdAlPo@gmail.com',
                'roles' => ['author'],
            ],
            [
                'name' => 'Артур Конан Дойл',
                'email' => 'Konan@gmail.com',
                'roles' => ['author', 'admin'],
            ],
            [
                'name' => 'Айзек Азимов',
                'email' => 'Azimov@gmail.com',
                'roles' => ['author'],
            ],
            [
                'name' => 'Станислав Лем',
                'email' => 'Lem@gmail.com',
                'roles' => ['author'],
            ],
            [
                'name' => 'А. Дюма',
                'email' => 'ADumas@gmail.com',
                'roles' => ['author'],
            ],
            [
                'name' => 'В. Гюго',
                'email' => 'Hugo@gmail.com',
                'roles' => ['author'],
            ],
            [
                'name' => 'Морис Дрюон',
                'email' => 'MDruon@gmail.com',
                'roles' => ['author'],
            ],
        ];

        // 1. Adding users into table

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $password,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // 2. Gathering ids of users and roles

        $user_ids = DB::table('users')->pluck('id', 'name');
        $role_ids = DB::table('roles')->pluck('id', 'name');

        // 3. Adding relations between users and roles

        foreach ($users as $user) {
            foreach ($user['roles'] as $role) {
                DB::table('user_role')->insert([
                    'user_id' => $user_ids[ $user['name'] ],
                    'role_id' => $role_ids[ $role ],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
