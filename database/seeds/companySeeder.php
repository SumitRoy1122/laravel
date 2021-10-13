<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
class companySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=100;$i++)
        {
              $factory->define(App\company::class, function (Faker $faker) {
                return [
                    'name' => $faker->name,
                    'email' => $faker->unique()->safeEmail
                ];
            });
        }
        
    }
}
