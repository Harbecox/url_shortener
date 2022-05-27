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
        $browsers = array_keys(Agent::getBrowsers());
        $os = array_keys(Agent::getPlatforms());
        $devises = ['desktop','robot','phone'];

        $faker = Factory::create();
        $aliases = Alias::all();
        foreach ($aliases as $alias){
            $visits = [];
            for($i=0;$i<rand(10,1000);$i++){
                $date = $faker->dateTimeBetween("-3 days");
                $visits[] = [
                    "country_code" => $faker->countryCode(),
                    "ip" => $faker->ipv4(),
                    "referer" => $faker->url(),
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
