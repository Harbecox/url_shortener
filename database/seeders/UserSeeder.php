<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            "name" => "Admin",
            "password" => "admin1234",
            "email" => "admin@gmail.com",
            "role" => "admin"
        ]);

        User::create([
            "name" => "test",
            "password" => "test1234",
            "email" => "test@gmail.com"
        ]);

        User::factory(10)->create();
    }
}
