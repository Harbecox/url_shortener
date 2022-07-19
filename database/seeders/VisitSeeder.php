<?php

namespace Database\Seeders;

use App\Models\Alias;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Jenssegers\Agent\Agent;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $browsers = array_slice(array_keys(Agent::getBrowsers()),0,6);
        $os = array_slice(array_keys(Agent::getPlatforms()),0,6);
        $devises = ['desktop','robot','phone'];
        $referers = [];
        for($i=0;$i<10;$i++){
            $referers[] = $faker->url();
        }

        $aliases = Alias::all();
        foreach ($aliases as $alias){
            $visits = [];
            for($i=0;$i<rand(100,1000);$i++){
                $date = $faker->dateTimeBetween("-45 days");
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
