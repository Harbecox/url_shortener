<?php

namespace Database\Seeders;

use App\Models\CheckUrlOkStatus;
use App\Models\FeedbackEmail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ///$this->call(UserSeeder::class);
        ///$this->call(UrlSeeder::class);
        ///$this->call(VisitSeeder::class);

        FeedbackEmail::create(["email" => "info@urlbit.ru"]);
        CheckUrlOkStatus::create(['check' => false]);
    }
}
