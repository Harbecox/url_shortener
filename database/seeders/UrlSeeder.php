<?php

namespace Database\Seeders;

use App\Models\Alias;
use App\Models\Url;
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
        $chars = [];
        foreach( range('a', 'z') as $char) {
            $chars[] = $char;
        }
        foreach( range('0', '9') as $char) {
            $chars[] = $char;
        }
        shuffle($chars);
        for($i=0;$i<1000;$i++){
            $alias = "";
            for($j=0;$j<5;$j++){
                $index = ($i / pow(36,$j) % 36);
                $char = $chars[$index];
                $char = $faker->boolean() ? strtoupper($char) : $char;
                $alias = $char.$alias;
            }
            $url = Url::create([
                "user_id" => rand(1,10000),
            ]);
            Alias::create([
                "alias" => $alias,
                "url" => $faker->url(),
                "subject_id" => $url->id
            ]);
        }

    }
}
