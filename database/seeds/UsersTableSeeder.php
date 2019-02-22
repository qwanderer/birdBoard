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
        factory("App\User")->create([
            'name' => "admin",
            'email' => "admin1@mail.ru",
            'password' => bcrypt("admin1"),
        ]);
    }
}
