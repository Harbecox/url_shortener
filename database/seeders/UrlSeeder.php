<?php

namespace Database\Seeders;

use App\Models\Alias;
use App\Models\Url;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $user = User::query()->select(['id'])->where("name", "test")->first();

        for ($i = 0; $i < rand(10, 100); $i++) {
            $alias = Alias::createUnique();
            $url = Url::create([
                "user_id" => $user->id,
                "created_at" => $faker->dateTimeBetween("-45 days")
            ]);
            Alias::create([
                "alias" => $alias,
                "url" => $faker->url(),
                "subject_id" => $url->id,
                "created_at" => $faker->dateTimeBetween("-45 days")
            ]);
        }

    }
}
