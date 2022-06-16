<?php

namespace Database\Seeders;

use App\Models\Alias;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Jenssegers\Agent\Agent;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = 10001;
        $aliases = User::find($user_id)->urls;

        $faker = Factory::create();

        $browsers = array_slice(array_keys(Agent::getBrowsers()),0,6);
        shuffle($browsers);

        $os = array_slice(array_keys(Agent::getPlatforms()),0,6);
        shuffle($os);

        $devises = ['desktop','robot','phone'];
        $referers = [];
        for($i=0;$i<10;$i++){
            $referers[] = $faker->url();
        }

        foreach ($aliases as $alias){
            $visits = [];
            for($i=0;$i<rand(10,1000);$i++){
                $date = $faker->dateTimeBetween("-3 days");
                $visits[] = [
                    "country_code" => $faker->countryCode(),
                    "ip" => $faker->ipv4(),
                    "referer" => $faker->randomElement($referers),
                    "browser" => $faker->randomElement($browsers),
                    "os" => $faker->randomElement($os),
                    "device" => $faker->randomElement($devises),
                    "created_at" => $date,
                    "updated_at" => $date,
                ];
            }
            $alias->visits()->createMany($visits);
        }
    }
}
