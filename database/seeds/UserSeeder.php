<?php

use App\User;
use Carbon\Carbon;
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

        $now = Carbon::now();
        $role_ids = DB::table('roles')->pluck('id', 'name');

        foreach ($users as $user) {

            // 1. Adding users into table

            $user_simple = $user;
            $user_simple['password'] = Hash::make('12345678');
            unset($user_simple['roles']);
            $user_saved = User::create($user_simple);

            // 2. Adding relations between users and roles

            $roles = [];
            foreach ($user['roles'] as $role) {
                $id = $role_ids[$role];
                $roles[$id] = ['created_at' => $now, 'updated_at' => $now];
            }
            $user_saved->roles()->attach($roles);
        }
    }
}
