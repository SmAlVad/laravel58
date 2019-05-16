<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Автор не известен',
                'email' => 'author_unknown@mail.ru',
                'password' => bcrypt(Str::random(16))
            ],
            [
                'name' => 'Автор',
                'email' => 'author@mail.ru',
                'password' => bcrypt('123456')
            ]
        ];

        \DB::table('users')->insert($data);
    }
}
